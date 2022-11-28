<?php

namespace App\Modules\Tareas\Controllers;

use App\Controllers\BaseController;
use App\Modules\Proyectos\Controllers\Proyectos;
use App\Modules\Proyectos\Controllers\Users;
use App\Modules\Tareas\Models\Tareas_model;
use CodeIgniter\Files\File;

class Tareas extends BaseController
{
    function __construct()
    {
        $this->ionAuth    = new \IonAuth\Libraries\IonAuth();
        $this->Tareas_model = model('App\Modules\Tareas\Models\Tareas_model');
        $this->Asistencias_model = model('App\Modules\Asistencias\Models\Asistencias_model');
        $this->Proyectos_model = model('App\Modules\Proyectos\Models\Proyectos_model');
        $this->Worklog_model = model('App\Modules\Worklog\Models\Worklog_model');
        $this->Users_model = model('App\Modules\Users\Models\Users_model');
        helper(['formatos', 'form']);
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        session()->set(array('tareas.q' => ''));
        return redirect()->to(current_url() . '/view');
    }

    public function acciones($tarea_id)
    {
        $user_id = $this->ionAuth->user()->row()->id;
        $row = $this->Tareas_model->get_all_activas($user_id);
        if ($_POST['accion'] == 0 && count($row) == 0) {
            $data = array(
                'estado' => 1,
            );
            $data2 = array(
                'tarea_id' => $tarea_id,
                'usuario_id' => $user_id,
                'fechainicio' => date('Y-m-d H:i:s'),
            );
            $this->Worklog_model->insert($data2);
            $tarea = $this->Tareas_model->get_by_id($tarea_id);
            if ($tarea->fechacomienzo == 0) {
                $data3 = array(
                    'fechacomienzo' => date('Y-m-d H:i:s'),
                );
                $this->Tareas_model->where('tarea_id', $tarea_id)->set($data3)->update();
            }
            $this->Tareas_model->where('tarea_id', $tarea_id)->set($data)->update();
        } else if ($_POST['accion'] == 1) {
            $data = array(
                'estado' => 0,
            );
            $data2 = array(
                'fechacierre' => date('Y-m-d H:i:s'),
            );
            $this->Worklog_model->where('tarea_id', $tarea_id)->orderby('worklog_id', 'DESC')->limit(1)->set($data2)->update();
            $this->Tareas_model->where('tarea_id', $tarea_id)->set($data)->update();
            $horas = $this->Worklog_model->calculahoras($tarea_id);
            log_message("error", "horas: " . $horas->diferencia / 60);
            $data3 = array(
                'horasreales' => $horas->diferencia / 60,
            );
            $this->Tareas_model->where('tarea_id', $tarea_id)->set($data3)->update();
        } else if ($_POST['accion'] == 2) {
            $data = array(
                'estado' => 2,
            );
            $data2 = array(
                'fechacierre' => date('Y-m-d H:i:s'),
            );
            if (count($row) != 0) {
            $this->Worklog_model->where('tarea_id', $tarea_id)->orderby('worklog_id', 'DESC')->limit(1)->set($data2)->update();
            }
            $this->Tareas_model->where('tarea_id', $tarea_id)->set($data)->update();
            $horas = $this->Worklog_model->calculahoras($tarea_id);
            log_message("error", "horas: " . $horas->diferencia / 60);
            $data3 = array(
                'horasreales' => $horas->diferencia / 60,
                'fecharealcierre' => date('Y-m-d H:i:s'),
            );
            $this->Tareas_model->where('tarea_id', $tarea_id)->set($data3)->update();
        }
        return redirect()->to(site_url('tareas/view'));
    }
    public function view($modal = 0, $quien = '1')
    {
        $tab = $this->request->getGet('tab') ? $this->request->getGet('tab') : '';
        $page = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
        $pagelength = $modal ? 10 : 50;

        if (intval($page) <= 0) {
            $page = 1;
        }
        if (count($_POST) > 0)
            session()->set(array('tareas.q' => $this->request->getPost('q')));

        $q = session()->get('tareas.q');
        session()->set(array('tareas.q' => null));

        $filter_get = urldecode($this->request->getGet('filter'));
        if ($filter_get == '') {
            $filter_get = urldecode($this->request->getPost('filter'));
        }
        $filter = array();
        if ($filter_get != '') {
            $filter_arr = explode(':', $filter_get);
            if (count($filter_arr) == 2) {
                $filter = $filter_arr;
            }
            $filter_get = '&filter=' . urlencode($filter_get);
        }

        $title = urldecode($this->request->getGet('title'));
        if ($title == '') {
            $title = urldecode($this->request->getPost('title'));
        }
        if ($title != '') {
            $custom_title = '&title=' . $title;
        } else {
            $custom_title = '';
        }

        $ob = urldecode($this->request->getGet('ob'));
        $nr = urldecode($this->request->getGet('nr'));

        if ($ob != '') {
            $orddir = substr($ob, 0, 1);
            $ordencampo = substr($ob, 1);
            switch ($orddir) {
                case 'a':
                    $ordendir = 'ASC';
                    break;
                case 'd':
                    $ordendir = 'DESC';
                    break;
            }
            session()->set(array('tareas.od' => $ordendir, 'tareas.oc' => $ordencampo));
        }

        $oc = session()->get('tareas.oc');
        $od = session()->get('tareas.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            session()->set(array('tareas.nr' => $nr));
        }

        $nr = session()->get('tareas.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = $pagelength;
            session()->set(array('tareas.nr' => $pagelength));
        }


        $start = $config['per_page'] * ($page - 1);
        $user_id = $this->ionAuth->user()->row()->id;
        $group_id = $this->Tareas_model->get_group_id($user_id);
        if (count($group_id) == 1 && $quien != 2) {
            $config['total_rows'] = $this->Tareas_model->total_rows($q, $tab, $filter, $user_id);
            $tareas = $this->Tareas_model->get_limit_data($config['per_page'], $start, $q, $tab, $oc, $od, $filter, $user_id);
        } else if ((count($group_id) == 2 && $quien != 1) || $q != null) {
            $config['total_rows'] = $this->Tareas_model->total_rows($q, $tab, $filter, null);
            $tareas = $this->Tareas_model->get_limit_data($config['per_page'], $start, $q, $tab, $oc, $od, $filter, null);
        } else if (count($group_id) == 2 && $quien == 1 && $q == '') {
            $config['total_rows'] = $this->Tareas_model->total_rows($q, $tab, $filter, $user_id);
            $tareas = $this->Tareas_model->get_limit_data($config['per_page'], $start, $q, $tab, $oc, $od, $filter, $user_id);
        }

        $pager = \Config\Services::pager();
        $ultima_asistencia = $this->Asistencias_model->get_last_asistencia($user_id, date('Y-m-d'));
        if ($ultima_asistencia == null || $ultima_asistencia->asistenciatipo_id == 1 || $ultima_asistencia->asistenciatipo_id == 3) {
            $fichado = false;
        } else {
            $fichado = true;
        }
        if ($modal == false && $quien == null && $q == null) {
            $accion = site_url('tareas/view/0/1');
        } else if ($modal != false && $quien == null && $q == null) {
            $accion = site_url('tareas/view/0/1');
        } else {
            $accion = site_url('tareas/view/' . $modal . '/' . $quien);
        }
        $data = array(
            'quien' => $quien,
            'group_id' => $group_id,
            'accion' => $accion,
            'fichado' => $fichado,
            'tareas_data' => $tareas,
            'q' => $q,
            'tab' => $tab,
            'pagination' => $pager->makeLinks($page, $config['per_page'], $config['total_rows']),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'filter' => $filter_get,
            'custom_title' => $custom_title,
            'orden_campo' => isset($oc) ? $oc : '',
            'orden_dir' => isset($oc) ? $od : '',
        );
        $data['titulo'] = 'tareas';
        $data['element'] = $title;
        if (session()->get('message')) {
            $data['message'] = session()->get('message');
            session()->remove('message');
        }

        $data['main'] = 'App\Modules\Tareas\Views\tareas_list';
        $modal_view = 'App\Modules\Tareas\Views\tareas_list_modal';
        return view(($modal) ? $modal_view : 'template', $data);
    }

    public function read($id, $modal = false)
    {
        $row = $this->Tareas_model->get_by_id($id);
        if ($row) {
            $data = array(
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'tarea_id' => $row->tarea_id,
                    'proyecto_id' => $row->proyecto_id,
                    'proyecto_titulo' => $row->proyecto_titulo,
                    'usuario_nombre' => $row->operador,
                    'usuario_id' => $row->usuario_id,
                    'usuariosadicionales' => $row->usuariosadicionales,
                    'titulo' => $row->titulo,
                    'descripcion' => $row->descripcion,
                    'fechaobjetivo' => $row->fechaobjetivo,
                    'fechaestimada' => $row->fechaestimada,
                    'horasestimadas' => $row->horasestimadas,
                    'fechacomienzo' => $row->fechacomienzo,
                    'fecharealcierre' => $row->fecharealcierre,
                    'horasreales' => $row->horasreales,
                    'estado' => $row->estado,
                    'texto_estado' => $row->texto_estado,
                )
            );
            $data['main'] = 'App\Modules\Tareas\Views\tareas_read';
            $modal_view = 'App\Modules\Tareas\Views\tareas_read_modal';

            $data['titulo'] = 'tareas';
            $data['subtitulo'] = 'Ver Tareas';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('tareas'));
        }
    }


    public function create($modal = false)
    {
        $user_id = $this->ionAuth->user()->row()->id;
        $group_id = $this->Tareas_model->get_group_id($user_id);
        $proyectos = $this->Proyectos_model->get_all();
        if (count($group_id) == 1) {
            $usuarios = $this->Users_model->get_all($user_id);
        } else {
            $usuarios = $this->Users_model->get_all();
        }
        $data = array(
            'button' => 'Añadir',
            'fun' => 'create',
            'action' => site_url('tareas/create_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
            'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
            'data_fields' => array(
                'proyecto_id' => set_value('proyecto_id'),
                'fechahoracreacion' => set_value('fechahoracreacion'),
                'usuario_id' => set_value('usuario_id'),
                'usuariosadicionales' => set_value('usuariosadicionales'),
                'titulo' => set_value('titulo'),
                'descripcion' => set_value('descripcion'),
                'fechaobjetivo' => set_value('fechaobjetivo'),
                'fechaestimada' => set_value('fechaestimada'),
                'horasestimadas' => set_value('horasestimadas'),
                'fechacomienzo' => set_value('fechacomienzo'),
                'fecharealcierre' => set_value('fecharealcierre'),
                'horasreales' => set_value('horasreales'),
                'tarea_id' => set_value('tarea_id'),
            ),
            'listado_proyectos' => $proyectos,
            'listado_usuarios' => $usuarios
        );
        if (session()->get('message')) {
            $data['message'] = session()->get('message');
            session()->remove('message');
        }
        $data['main'] = 'App\Modules\Tareas\Views\tareas_form';
        $modal_view = 'App\Modules\Tareas\Views\tareas_form_modal';

        $data['titulo'] = 'tareas';
        $data['subtitulo'] = 'Añadir Tareas';
        $data['modal'] = $modal;
        return view(($modal) ? $modal_view : 'template', $data);
    }


    public function create_action($from = false)
    {
        $rules = $this->_rules('create');

        if ($this->validate($rules) == FALSE) {
            session()->set('message', $this->validator->listErrors());
            log_message("error", "Error al crear tarea: " . $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $data = array();
            $data['proyecto_id'] = $this->request->getPost('proyecto_id');
            $data['fechahoracreacion'] = date_create()->format('Y-m-d H:i:s.u');
            $data['usuario_id'] = $this->request->getPost('usuario_id');
            $data['usuariosadicionales'] = $this->request->getPost('usuariosadicionales');
            $data['titulo'] = $this->request->getPost('titulo');
            $data['descripcion'] = $this->request->getPost('descripcion');
            $data['fechaobjetivo'] = $this->request->getPost('fechaobjetivo');
            $data['fechaestimada'] = $this->request->getPost('fechaestimada');
            $data['horasestimadas'] = $this->request->getPost('horasestimadas');
            $data['fechacomienzo'] = $this->request->getPost('fechacomienzo');
            $data['fecharealcierre'] = $this->request->getPost('fecharealcierre');
            $data['horasreales'] = 0;
            $this->eventBeforeCreate();
            $this->Tareas_model->insert($data);
            $this->eventAfterCreate($this->Tareas_model->insertID());
            session()->set('message', 'Tarea creada correctamente');
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('tareas'));
        }
    }


    public function update($id, $modal = false)
    {
        $user_id = $this->ionAuth->user()->row()->id;
        $group_id = $this->Tareas_model->get_group_id($user_id);
        $proyectos = $this->Proyectos_model->get_all();
        if (count($group_id) == 1) {
            $usuarios = $this->Users_model->get_all($user_id);
        } else {
            $usuarios = $this->Users_model->get_all();
        }
        $row = $this->Tareas_model->get_by_id($id);
        $proyectos = $this->Proyectos_model->get_all();
        if ($row) {
            $data = array(
                'button' => 'Modificar',
                'fun' => 'update',
                'action' => site_url('tareas/update_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'proyecto_id' => set_value('proyecto_id', $row->proyecto_id),
                    'proyecto_titulo' => set_value('proyecto_titulo', $row->proyecto_titulo),
                    'usuario_id' => set_value('usuario_id', $row->usuario_id),
                    'usuario_nombre' => set_value('usuario_nombre', $row->operador),
                    'usuariosadicionales' => set_value('usuariosadicionales', $row->usuariosadicionales),
                    'titulo' => set_value('titulo', $row->titulo),
                    'descripcion' => set_value('descripcion', $row->descripcion),
                    'fechaobjetivo' => set_value('fechaobjetivo', $row->fechaobjetivo),
                    'fechaestimada' => set_value('fechaestimada', $row->fechaestimada),
                    'horasestimadas' => set_value('horasestimadas', $row->horasestimadas),
                    'fechacomienzo' => set_value('fechacomienzo', $row->fechacomienzo),
                    'fecharealcierre' => set_value('fecharealcierre', $row->fecharealcierre),
                    'horasreales' => set_value('horasreales', $row->horasreales),
                    'tarea_id' => set_value('tarea_id', $row->tarea_id),
                ),
                'listado_proyectos' => $proyectos,
                'listado_usuarios' => $usuarios
            );

            $data['main'] = 'App\Modules\Tareas\Views\tareas_form';
            $modal_view =  'App\Modules\Tareas\Views\tareas_form_modal';

            $data['titulo'] = 'tareas';
            $data['subtitulo'] = 'Modificar Tareas';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('tareas'));
        }
    }

    public function update_action($from = false)
    {
        $rules = $this->_rules('update');
        $id = $this->request->getPost('tarea_id');
        if ($this->validate($rules) == FALSE) {
            return redirect()->to(site_url('tareas/update/' . $id));
        } else {
            $row = (array) $this->Tareas_model->get_by_id($id);
            $data = array();
            $data['proyecto_id'] = $this->request->getPost('proyecto_id');
            $data['usuario_id'] = $this->request->getPost('usuario_id');
            $data['usuariosadicionales'] = $this->request->getPost('usuariosadicionales');
            $data['titulo'] = $this->request->getPost('titulo');
            $data['descripcion'] = $this->request->getPost('descripcion');
            $data['fechaobjetivo'] = $this->request->getPost('fechaobjetivo');
            $data['fechaestimada'] = $this->request->getPost('fechaestimada');
            $data['horasestimadas'] = $this->request->getPost('horasestimadas');
            $data['fechacomienzo'] = $this->request->getPost('fechacomienzo');
            $data['fecharealcierre'] = $this->request->getPost('fecharealcierre');
            $data['horasreales'] = $this->request->getPost('horasreales');
            $this->eventBeforeUpdate($this->request->getPost('tarea_id'));
            $this->Tareas_model->where('tarea_id', $this->request->getPost('tarea_id'))->set($data)->update();
            $this->eventAfterUpdate($this->request->getPost('tarea_id'));
            $row2 = (array) $this->Tareas_model->get_by_id($id);
            $diff = array_diff($row2,$row);
            $datalog = array (
                'tarea_id' => $id,
                'usuario_id' => $this->ionAuth->user()->row()->id,
                'fechahora' => date('Y-m-d H:i:s'),
                'cambiados' => json_encode($diff)
            );

            $this->Tareas_model->insert_task_log($datalog);
            session()->set('message', 'Tarea modificada correctamente');
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('tareas'));
        }
    }
    public function cambios($id) {
        $tab = $this->request->getGet('tab') ? $this->request->getGet('tab') : '';
        $page = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
        $pagelength = 50;

        if (intval($page) <= 0) {
            $page = 1;
        }
        $title = urldecode($this->request->getGet('title'));
        if ($title == '') {
            $title = urldecode($this->request->getPost('title'));
        }
        if ($title != '') {
            $custom_title = '&title=' . $title;
        } else {
            $custom_title = '';
        }

        $ob = urldecode($this->request->getGet('ob'));
        $nr = urldecode($this->request->getGet('nr'));

        if ($ob != '') {
            $orddir = substr($ob, 0, 1);
            $ordencampo = substr($ob, 1);
            switch ($orddir) {
                case 'a':
                    $ordendir = 'ASC';
                    break;
                case 'd':
                    $ordendir = 'DESC';
                    break;
            }
            session()->set(array('tareas.od' => $ordendir, 'tareas.oc' => $ordencampo));
        }

        $oc = session()->get('tareas.oc');
        $od = session()->get('tareas.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            session()->set(array('tareas.nr' => $nr));
        }

        $nr = session()->get('tareas.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = $pagelength;
            session()->set(array('tareas.nr' => $pagelength));
        }


        $start = $config['per_page'] * ($page - 1);
        $user_id = $this->ionAuth->user()->row()->id;
        $group_id = $this->Tareas_model->get_group_id($user_id);
        $cambios = $this->Tareas_model->get_task_log($id);
        $pager = \Config\Services::pager();
        $config['total_rows'] = count($cambios);
        $data = array (
            'cambios' => $cambios,
            'tab' => $tab,
            'pagination' => $pager->makeLinks($page, $config['per_page'], $config['total_rows']),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'custom_title' => $custom_title,
            'orden_campo' => isset($oc) ? $oc : '',
            'orden_dir' => isset($oc) ? $od : '',
        );
                
        $data['titulo'] = 'tareas';
        $data['element'] = $title;
        if (session()->get('message')) {
            $data['message'] = session()->get('message');
            session()->remove('message');
        }

        $data['main'] = 'App\Modules\Tareas\Views\cambios_list';
        return view('template', $data);;

    }
    public function delete($id)
    {
        $row = $this->Tareas_model->get_by_id($id);

        if ($row) {
            $this->eventBeforeDelete($id);
            $this->Tareas_model->where('tarea_id', $id)->delete();
            $this->eventAfterDelete($id);
            session()->set('message', 'Tarea eliminada correctamente');
            return redirect()->to(site_url('tareas'));
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('tareas'));
        }
    }

    public function bulk_delete(...$ids)
    {
        $rows = $this->Tareas_model->whereIn('tarea_id', $ids)->countAllResults();

        if ($rows > 0) {
            foreach ($ids as $id) {
                $this->eventBeforeDelete($id);
            }
            $this->Tareas_model->whereIn('tarea_id', $ids)->delete();
            foreach ($ids as $id) {
                $this->eventAfterDelete($id);
            }

            session()->set('message', $rows . ' Tareaa eliminada' . ($rows > 1 ? 's' : '') . ' correctamente');
        } else {
            session()->set('message', 'No hay resultados');
        }
        return redirect()->to(site_url('tareas'));
    }

    public function _rules($raction)
    {
        return array(
            'proyecto_id' => 'trim|required',
            'usuario_id' => 'trim|required',
            'usuariosadicionales' => 'trim',
            'titulo' => 'trim|required',
            'descripcion' => 'trim|required',
            'fechaobjetivo' => [
                'rules'  => 'trim|required|check_less[' . date_create()->format('Y-m-d') . ']',
                'errors' => [
                    'check_less' => 'El campo fecha objetivo debe ser mayor que la fecha actual',
                ],
            ],
            'fechaestimada' => [
                'rules'  => 'trim|required|check_less[' . date_create()->format('Y-m-d') . ']',
                'errors' => [
                    'check_less' => 'El campo fecha estimada debe ser mayor que la fecha actual',
                ],
            ],
            'horasestimadas' => 'trim|required',
            'fechacomienzo' => 'trim',
            'fecharealcierre' => 'trim',
            'horasreales' => 'trim',

            'tarea_id' => 'trim',
        );
    }

    public function excel()
    {
        helper('../Modules/Tareas/Helpers/exportexcel');
        $namaFile = "tareas.xls";
        $judul = "tareas";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Proyecto Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Fechahoracreacion");
        xlsWriteLabel($tablehead, $kolomhead++, "Usuario Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Usuariosadicionales");
        xlsWriteLabel($tablehead, $kolomhead++, "Titulo");
        xlsWriteLabel($tablehead, $kolomhead++, "Descripcion");
        xlsWriteLabel($tablehead, $kolomhead++, "Fechaobjetivo");
        xlsWriteLabel($tablehead, $kolomhead++, "Fechaestimada");
        xlsWriteLabel($tablehead, $kolomhead++, "Horasestimadas");
        xlsWriteLabel($tablehead, $kolomhead++, "Fechacomienzo");
        xlsWriteLabel($tablehead, $kolomhead++, "Fecharealcierre");
        xlsWriteLabel($tablehead, $kolomhead++, "Horasreales");
        xlsWriteLabel($tablehead, $kolomhead++, "Estado");

        foreach ($this->Tareas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->proyecto_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->fechahoracreacion);
            xlsWriteNumber($tablebody, $kolombody++, $data->usuario_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->usuariosadicionales);
            xlsWriteLabel($tablebody, $kolombody++, $data->titulo);
            xlsWriteLabel($tablebody, $kolombody++, $data->descripcion);
            xlsWriteLabel($tablebody, $kolombody++, $data->fechaobjetivo);
            xlsWriteLabel($tablebody, $kolombody++, $data->fechaestimada);
            xlsWriteNumber($tablebody, $kolombody++, $data->horasestimadas);
            xlsWriteLabel($tablebody, $kolombody++, $data->fechacomienzo);
            xlsWriteLabel($tablebody, $kolombody++, $data->fecharealcierre);
            xlsWriteNumber($tablebody, $kolombody++, $data->horasreales);
            xlsWriteNumber($tablebody, $kolombody++, $data->estado);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    private function eventBeforeCreate()
    {
    }
    private function eventAfterCreate($id)
    {
    }
    private function eventBeforeUpdate($id)
    {
    }
    private function eventAfterUpdate($id)
    {
    }
    private function eventBeforeDelete($id)
    {
    }
    private function eventAfterDelete($id)
    {
    }
}
