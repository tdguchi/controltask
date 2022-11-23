<?php

namespace App\Modules\Asistencias\Controllers;

use App\Controllers\BaseController;
use App\Modules\Asistencias\Models\Asistencias_model;
use CodeIgniter\Files\File;

class Asistencias extends BaseController
{
    function __construct()
    {
        $this->ionAuth    = new \IonAuth\Libraries\IonAuth();
        $this->Tareas_model = model('App\Modules\Tareas\Models\Tareas_model');
        $this->Asistencias_model = model('App\Modules\Asistencias\Models\Asistencias_model');
        helper(['formatos', 'form']);
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        session()->set(array('asistencias.q' => ''));
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
            session()->set(array('asistencias.q' => $this->request->getPost('q')));

        $q = session()->get('asistencias.q');

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
            session()->set(array('asistencias.od' => $ordendir, 'asistencias.oc' => $ordencampo));
        }

        $oc = session()->get('asistencias.oc');
        $od = session()->get('asistencias.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            session()->set(array('asistencias.nr' => $nr));
        }

        $nr = session()->get('asistencias.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = $pagelength;
            session()->set(array('asistencias.nr' => $pagelength));
        }

        $config['total_rows'] = $this->Asistencias_model->total_rows($q, $tab, $filter);

        $start = $config['per_page'] * ($page - 1);
        $pager = \Config\Services::pager();

        $user_id = $this->ionAuth->user()->row()->id;
        $group_id = $this->Tareas_model->get_group_id($user_id);
        if (count($group_id) == 1) {
            $config['total_rows'] = $this->Asistencias_model->total_rows($q, $tab, $filter,$user_id);
            $asistencias = $this->Asistencias_model->get_limit_data($config['per_page'], $start, $q, $tab, $oc, $od, $filter, $user_id);
        } else {
            $config['total_rows'] = $this->Asistencias_model->total_rows($q, $tab, $filter, null);
            $asistencias = $this->Asistencias_model->get_limit_data($config['per_page'], $start, $q, $tab, $oc, $od, $filter,null);
        }
        
        $data = array(
            'asistencias_data' => $asistencias,
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
        $data['titulo'] = 'asistencias';
        $data['element'] = $title;
        if (session()->get('message')) {
            $data['message'] = session()->get('message');
            session()->remove('message');
        }

        $data['main'] = 'App\Modules\Asistencias\Views\asistencias_list';
        $modal_view = 'App\Modules\Asistencias\Views\asistencias_list_modal';
        return view(($modal) ? $modal_view : 'template', $data);;
    }

    public function read($id, $modal = false)
    {
        $row = $this->Asistencias_model->get_by_id($id);
        if ($row) {
            $data = array(
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'asistencia_id' => $row->asistencia_id,
                    'fechahora' => $row->fechahora,
                    'fechahora_timestamp' => $row->fechahora_timestamp,
                    'asistenciatipo_id' => $row->asistenciatipo_id,
                    'usuario_id' => $row->usuario_id,
                    'comentario' => $row->comentario,
                )
            );
            $data['main'] = 'App\Modules\Asistencias\Views\asistencias_read';
            $modal_view = 'App\Modules\Asistencias\Views\asistencias_read_modal';

            $data['titulo'] = 'asistencias';
            $data['subtitulo'] = 'Ver Asistencias';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('asistencias'));
        }
    }

    public function fichar($modal = null)
    {
        $data = array(
            'button' => 'Añadir',
            'fun' => 'create',
            'action' => site_url('asistencias/fichar_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
            'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
            'data_fields' => array(
                'asistencia_id' => "",
                'fechahora' => "",
                'fechahora_timestamp' => "",
                'asistenciatipo_id' => "",
                'usuario_id' => "",
                'comentario' => "",
            )
        );
        $data['main'] = 'App\Modules\Asistencias\Views\asistencias_form';
        $modal_view = 'App\Modules\Asistencias\Views\asistencias_form_modal';
        $data['titulo'] = 'asistencias';
        $data['subtitulo'] = 'Fichar';
        $data['modal'] = $modal;
        return view(($modal) ? $modal_view : 'template', $data);
    }

    public function fichar_action($from = null)
    {
        $user_id = $this->ionAuth->user()->row()->id;
        $ultima_asistencia_id = $this->Asistencias_model->get_last_asistencia($user_id, date('Y-m-d'))->asistencia_id;
        log_message("error", "ultima_asistencia_id: " . $ultima_asistencia_id);
        $asistencia_nueva_id = $ultima_asistencia_id +1;
        if ($asistencia_nueva_id == 4) {
            $asistencia_nueva_id = 0;
        }
            $data = array(
                'fechahora' => date('Y-m-d H:i:s'),
                'fechahora_timestamp' => time(),
                'asistenciatipo_id' => $asistencia_nueva_id,
                'usuario_id' => $user_id,
                'comentario' => $this->request->getPost('comentario'),
            );
            $this->Asistencias_model->insert($data);
            session()->set('message', 'Create Record Success');
            return redirect()->to(site_url('asistencias'));
    }


    public function _rules($raction)
    {
        return array(
            'fechahora' => 'trim',
            'asistenciatipo_id' => 'trim',
            'usuario_id' => 'trim',
            'comentario' => 'trim',

            'asistencia_id' => 'trim',
        );
    }

    public function excel()
    {
        helper('../Modules/Asistencias/Helpers/exportexcel');
        $namaFile = "asistencias.xls";
        $judul = "asistencias";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Fechahora");
        xlsWriteLabel($tablehead, $kolomhead++, "Fechahora Timestamp");
        xlsWriteLabel($tablehead, $kolomhead++, "Asistenciatipo Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Usuario Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Comentario");

        foreach ($this->Asistencias_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->fechahora);
            xlsWriteLabel($tablebody, $kolombody++, $data->fechahora_timestamp);
            xlsWriteNumber($tablebody, $kolombody++, $data->asistenciatipo_id);
            xlsWriteNumber($tablebody, $kolombody++, $data->usuario_id);
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
