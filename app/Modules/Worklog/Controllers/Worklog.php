<?php

namespace App\Modules\Worklog\Controllers;

use App\Controllers\BaseController;
use App\Modules\Worklog\Models\Worklog_model;
use CodeIgniter\Files\File;

class Worklog extends BaseController
{
    function __construct()
    {
        $this->ionAuth    = new \IonAuth\Libraries\IonAuth();
        $this->Asistencias_model = model('App\Modules\Asistencias\Models\Asistencias_model');
        $this->Worklog_model = model('App\Modules\Worklog\Models\Worklog_model');
        helper(['formatos', 'form']);
        $this->validation =  \Config\Services::validation();

        $config = config('App');
        if (isset($config->authEnabled) && $config->authEnabled) {
            $ionAuth = new \IonAuth\Libraries\IonAuth();
            if (!$ionAuth->isAdmin()) {
                header("Location: " . base_url());
                die();
            }
        }
    }

    public function index()
    {
        session()->set(array('worklog.q' => ''));
        return redirect()->to(current_url() . '/view');
    }


    public function view($modal = false)
    {

        $tab = $this->request->getGet('tab') ? $this->request->getGet('tab') : '';
        $page = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
        $pagelength = $modal ? 10 : 50;

        if (intval($page) <= 0) {
            $page = 1;
        }
        if (count($_POST) > 0)
            session()->set(array('worklog.q' => $this->request->getPost('q')));

        $q = session()->get('worklog.q');

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
            session()->set(array('worklog.od' => $ordendir, 'worklog.oc' => $ordencampo));
        }

        $oc = session()->get('worklog.oc');
        $od = session()->get('worklog.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            session()->set(array('worklog.nr' => $nr));
        }

        $nr = session()->get('worklog.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = $pagelength;
            session()->set(array('worklog.nr' => $pagelength));
        }

        $config['total_rows'] = $this->Worklog_model->total_rows($q, $tab, $filter);

        $start = $config['per_page'] * ($page - 1);

        $worklog = $this->Worklog_model->get_limit_data($config['per_page'], $start, $q, $tab, $oc, $od, $filter);

        $pager = \Config\Services::pager();
        
        $user_id = $this->ionAuth->user()->row()->id;
        $ultima_asistencia = $this->Asistencias_model->get_last_asistencia($user_id, date('Y-m-d'));
        if ($ultima_asistencia == null || $ultima_asistencia->asistenciatipo_id == 1 || $ultima_asistencia->asistenciatipo_id == 3) {
            $fichado = false;
        } else {
            $fichado = true;
        }
        $data = array(
            'worklog_data' => $worklog,
            'fichado' => $fichado,
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
        $data['titulo'] = 'worklog';
        $data['element'] = $title;
        if (session()->get('message')) {
            $data['message'] = session()->get('message');
            session()->remove('message');
        }

        $data['main'] = 'App\Modules\Worklog\Views\worklog_list';
        $modal_view = 'App\Modules\Worklog\Views\worklog_list_modal';
        return view(($modal) ? $modal_view : 'template', $data);;
    }

    public function read($id, $modal = false)
    {
        $row = $this->Worklog_model->get_by_id($id);
        if ($row) {
            $data = array(
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'worklog_id' => $row->worklog_id,
                    'tarea_id' => $row->tarea_id,
                    'usuario_id' => $row->usuario_id,
                    'fechainicio' => $row->fechainicio,
                    'fechacierre' => $row->fechacierre,
                    'comentario' => $row->comentario,
                )
            );
            $data['main'] = 'App\Modules\Worklog\Views\worklog_read';
            $modal_view = 'App\Modules\Worklog\Views\worklog_read_modal';

            $data['titulo'] = 'worklog';
            $data['subtitulo'] = 'Ver Worklog';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('worklog'));
        }
    }
    public function update($id)
    {
        $data = array(
            'button' => 'Añadir',
            'fun' => 'create',
            'action' => site_url('worklog/update_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
            'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
            'data_fields' => array(
                'id' => set_value('id', $id),
                'comentario' => "",
            )
        );
            $data['main'] = 'App\Modules\Worklog\Views\worklog_form_modal';

            $data['titulo'] = 'worklog';
            $data['subtitulo'] = 'Modificar worklog';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
    }

    public function update_action($from = false)
    {
        $rules = $this->_rules('update');

        if ($this->validate($rules) == FALSE) {
            $id = $this->request->getPost('tarea_id');
            return redirect()->to(site_url('tareas/update/' . $id));
        } else {
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
            session()->set('message', 'Tareaa modificada correctamente');
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('tareas'));
        }
    }

    public function _rules($raction)
    {
        return array(
            'tarea_id' => 'trim',
            'usuario_id' => 'trim',
            'fechainicio' => 'trim',
            'fechacierre' => 'trim',
            'comentario' => 'trim',

            'worklog_id' => 'trim',
        );
    }

    public function excel()
    {
        helper('../Modules/Worklog/Helpers/exportexcel');
        $namaFile = "worklog.xls";
        $judul = "worklog";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Tarea Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Usuario Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Fechainicio");
        xlsWriteLabel($tablehead, $kolomhead++, "Fechacierre");
        xlsWriteLabel($tablehead, $kolomhead++, "Comentario");

        foreach ($this->Worklog_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->tarea_id);
            xlsWriteNumber($tablebody, $kolombody++, $data->usuario_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->fechainicio);
            xlsWriteLabel($tablebody, $kolombody++, $data->fechacierre);
            xlsWriteLabel($tablebody, $kolombody++, $data->comentario);

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
