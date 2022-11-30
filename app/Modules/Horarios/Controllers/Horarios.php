<?php

namespace App\Modules\Horarios\Controllers;

use App\Controllers\BaseController;
use App\Modules\Horarios\Models\Horarios_model;
use CodeIgniter\Files\File;

class Horarios extends BaseController
{
    function __construct()
    {
        $this->ionAuth    = new \IonAuth\Libraries\IonAuth();
        $this->Tareas_model = model('App\Modules\Tareas\Models\Tareas_model');
        $this->Users_model = model('App\Modules\Users\Models\Users_model');
        $this->Asistencias_model = model('App\Modules\Asistencias\Models\Asistencias_model');
        $this->Horarios_model = model('App\Modules\Horarios\Models\Horarios_model');
        helper(['formatos', 'form']);
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        session()->set(array('horarios.q' => ''));
        return redirect()->to(current_url() . '/view');
    }


    public function view($id = null, $modal = false)
    {

        $tab = $this->request->getGet('tab') ? $this->request->getGet('tab') : '';
        $page = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
        $pagelength = $modal ? 10 : 50;

        if (intval($page) <= 0) {
            $page = 1;
        }
        if (count($_POST) > 0)
            session()->set(array('horarios.q' => $this->request->getPost('q')));

        $q = session()->get('horarios.q');

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
            session()->set(array('horarios.od' => $ordendir, 'horarios.oc' => $ordencampo));
        }

        $oc = session()->get('horarios.oc');
        $od = session()->get('horarios.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            session()->set(array('horarios.nr' => $nr));
        }

        $nr = session()->get('horarios.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = $pagelength;
            session()->set(array('horarios.nr' => $pagelength));
        }

        $config['total_rows'] = $this->Horarios_model->total_rows($q, $tab, $filter);
        $start = $config['per_page'] * ($page - 1);
        $horarios = $this->Horarios_model->get_limit_data($config['per_page'], $start, $q, $tab, $oc, $od, $filter);
        $pager = \Config\Services::pager();
        $user_id = $this->ionAuth->user()->row()->id;
        $group_id = $this->Tareas_model->get_group_id($user_id);
        $ultima_asistencia = $this->Asistencias_model->get_last_asistencia($user_id, date('Y-m-d'));
        if ($ultima_asistencia == null || $ultima_asistencia->asistenciatipo_id == 1 || $ultima_asistencia->asistenciatipo_id == 3) {
            $fichado = false;
        } else {
            $fichado = true;
        }
        $horario_verano = $this->Horarios_model->get_actual($id,'0');
        $horario_invierno = $this->Horarios_model->get_actual($id,'1');
        $nombre = $this->Users_model->get_by_id($id)->first_name;
        $data = array(
            'fichado' => $fichado,
            'group_id' => $group_id,
            'user_id' => $user_id,
            'username' => $nombre,
            'horarios_data' => $horarios,
            'verano' => $horario_verano,
            'invierno' => $horario_invierno,
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
        $data['titulo'] = 'horarios';
        $data['element'] = $title;
        if (session()->get('message')) {
            $data['message'] = session()->get('message');
            session()->remove('message');
        }

        $data['main'] = 'App\Modules\Horarios\Views\horarios_list';
        $modal_view = 'App\Modules\Horarios\Views\horarios_list_modal';
        return view(($modal) ? $modal_view : 'template', $data);;
    }

    public function read($id, $modal = false)
    {
        $row = $this->Horarios_model->get_by_id($id);
        if ($row) {
            $data = array(
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'horario_id' => $row->horario_id,
                    'titulo' => $row->titulo,
                    'descripcion' => $row->descripcion,
                )
            );
            $data['main'] = 'App\Modules\Horarios\Views\horarios_read';
            $modal_view = 'App\Modules\Horarios\Views\horarios_read_modal';

            $data['titulo'] = 'horarios';
            $data['subtitulo'] = 'Ver Horarios';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('horarios'));
        }
    }
    //write function to asign horario
    public function asignar($horario = 1, $tipo = 1, $usuario=null) {
        $this->Horarios_model->asignar_horario($usuario, $horario, $tipo);
        return redirect()->to(site_url('horarios/view/' . $usuario));
    }

    public function create($modal = false, $id=null)
    {
        $data = array(
            'button' => 'Añadir',
            'fun' => 'create',
            'action' => site_url('horarios/create_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : '/0/' . $id),
            'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
            'data_fields' => array(
                'horario_id' => set_value('horario_id'),
                'entrada_manana' => set_value('entrada_manana'),
                'salida_manana' => set_value('salida_manana'),
                'entrada_tarde' => set_value('entrada_tarde'),
                'salida_tarde' => set_value('salida_tarde'),
            )
        );
        $data['main'] = 'App\Modules\Horarios\Views\horarios_form';
        $modal_view = 'App\Modules\Horarios\Views\horarios_form_modal';

        $data['titulo'] = 'horarios';
        $data['subtitulo'] = 'Añadir Horarios';
        $data['modal'] = $modal;
        return view(($modal) ? $modal_view : 'template', $data);
    }


    public function create_action($from = false, $id=null)
    {
        $rules = $this->_rules('create');
            $data = array(
                'entrada_manana' => $this->request->getPost('entrada_manana'),
                'salida_manana' => $this->request->getPost('salida_manana'),
                'entrada_tarde' => $this->request->getPost('entrada_tarde'),
                'salida_tarde' => $this->request->getPost('salida_tarde'),
            );

            $this->eventBeforeCreate();
            $this->Horarios_model->insert($data);
            $this->eventAfterCreate($this->Horarios_model->insertID());
            session()->set('message', 'Horario creado correctamente');
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('horarios/view/' . $id));
    }


    public function update($id, $modal = false)
    {
        $row = $this->Horarios_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Modificar',
                'fun' => 'update',
                'action' => site_url('horarios/update_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'titulo' => set_value('titulo', $row->titulo),
                    'descripcion' => set_value('descripcion', $row->descripcion),
                    'horario_id' => set_value('horario_id', $row->horario_id),
                )
            );

            $data['main'] = 'App\Modules\Horarios\Views\horarios_form';
            $modal_view =  'App\Modules\Horarios\Views\horarios_form_modal';

            $data['titulo'] = 'horarios';
            $data['subtitulo'] = 'Modificar Horario';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('horarios'));
        }
    }

    public function update_action($from = false)
    {
        $rules = $this->_rules('update');

        if ($this->validate($rules) == FALSE) {
            $id = $this->request->getPost('horario_id');
            return redirect()->to(site_url('horarios/update/' . $id));
        } else {
            $data = array();
            $data['titulo'] = $this->request->getPost('titulo');
            $data['descripcion'] = $this->request->getPost('descripcion');

            $this->eventBeforeUpdate($this->request->getPost('horario_id'));
            $this->Horarios_model->where('horario_id', $this->request->getPost('horario_id'))->set($data)->update();
            $this->eventAfterUpdate($this->request->getPost('horario_id'));
            session()->set('message', 'Horario modificado correctamente');
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('horarios'));
        }
    }

    public function delete($id)
    {
        $row = $this->Horarios_model->get_by_id($id);

        if ($row) {
            $this->eventBeforeDelete($id);
            $this->Horarios_model->where('horario_id', $id)->delete();
            $this->eventAfterDelete($id);
            session()->set('message', 'Horario eliminado correctamente');
            return redirect()->to(site_url('horarios'));
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('horarios'));
        }
    }

    public function bulk_delete(...$ids)
    {
        $rows = $this->Horarios_model->whereIn('horario_id', $ids)->countAllResults();

        if ($rows > 0) {
            foreach ($ids as $id) {
                $this->eventBeforeDelete($id);
            }
            $this->Horarios_model->whereIn('horario_id', $ids)->delete();
            foreach ($ids as $id) {
                $this->eventAfterDelete($id);
            }

            session()->set('message', $rows . ' Horario eliminado' . ($rows > 1 ? 's' : '') . ' correctamente');
        } else {
            session()->set('message', 'No hay resultados');
        }
        return redirect()->to(site_url('horarios'));
    }

    public function _rules($raction)
    {
        return array(
            'titulo' => 'trim|required',
            'descripcion' => 'trim|required',

            'horario_id' => 'trim',
        );
    }

    public function excel()
    {
        helper('../Modules/Horarios/Helpers/exportexcel');
        $namaFile = "horarios.xls";
        $judul = "horarios";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Titulo");
        xlsWriteLabel($tablehead, $kolomhead++, "Descripcion");

        foreach ($this->Horarios_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->titulo);
            xlsWriteLabel($tablebody, $kolombody++, $data->descripcion);

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
