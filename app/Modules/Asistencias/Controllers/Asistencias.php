<?php

namespace App\Modules\Asistencias\Controllers;
 
use App\Controllers\BaseController;
use App\Modules\Asistencias\Models\Asistencias_model;
use CodeIgniter\Files\File;
use CodeIgniter\I18n\Time;


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

    public function horas()
    {
        $user = $this->ionAuth->user()->row();
        if ($user->entrada_manana == '00:00:00' || $user->salida_manana == '00:00:00' || $user->entrada_tarde == '00:00:00' || $user->salida_tarde == '00:00:00' || $user->entrada_verano_manana == '00:00:00' || $user->salida_verano_manana == '00:00:00' || $user->entrada_verano_tarde == '00:00:00' || $user->salida_verano_tarde == '00:00:00') {

            $data = array(
                'button' => 'Añadir',
                'fun' => 'create',
                'action' => site_url('asistencias/horario_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
                'from' => null,
                'data_fields' => array(
                    'entrada_manana' => set_value('entrada_manana', $user->entrada_manana),
                    'salida_manana' => set_value('salida_manana', $user->salida_manana),
                    'entrada_tarde' => set_value('entrada_tarde', $user->entrada_tarde),
                    'salida_tarde' => set_value('salida_tarde', $user->salida_tarde),
                    'entrada_verano_manana' => set_value('entrada_verano_manana', $user->entrada_verano_manana),
                    'salida_verano_manana' => set_value('salida_verano_tarde', $user->salida_verano_manana),
                    'entrada_verano_tarde' => set_value('entrada_verano_tarde', $user->entrada_verano_tarde),
                    'salida_verano_tarde' => set_value('salida_verano_tarde', $user->salida_verano_tarde),
                )
            );
            $data['titulo'] = 'Mi horario';
            $data['element'] = 'Mi horario';
            $data['subtitulo'] = 'Configurar mi horario';
            if (session()->get('message')) {
                $data['message'] = session()->get('message');
                session()->remove('message');
            }

            $data['main'] = 'App\Modules\Asistencias\Views\horario_form';
            return view($data['main'], $data);
        };
        return redirect()->to(base_url('/'));
    }

    public function horario_action($from = null)
    {
        $rules = $this->_ruleshorario();

        if ($this->validate($rules) == FALSE) {
            session()->set('message', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $user = $this->ionAuth->user()->row();
            $data = array(
                'entrada_manana' => $this->request->getPost('entrada_manana'),
                'salida_manana' => $this->request->getPost('salida_manana'),
                'entrada_tarde' => $this->request->getPost('entrada_tarde'),
                'salida_tarde' => $this->request->getPost('salida_tarde'),
                'entrada_verano_manana' => $this->request->getPost('entrada_verano_manana'),
                'salida_verano_manana' => $this->request->getPost('salida_verano_manana'),
                'entrada_verano_tarde' => $this->request->getPost('entrada_verano_tarde'),
                'salida_verano_tarde' => $this->request->getPost('salida_verano_tarde'),
            );
            if ($this->ionAuth->update($user->id, $data)) {
                session()->set('message', 'Usuario modificado correctamente');
            } else {
                session()->set('message', 'No se ha podido modificar el usuario');
            }
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('/'));
        }
    }
    public function _ruleshorario()
    {
        return array(
            'entrada_manana' => 'trim',
            'salida_manana' =>  [
                'rules'  => 'trim|check_equal_less[' . $this->request->getPost('entrada_manana') . ']',
                'errors' => [
                    'check_equal_less' => 'El campo salida mañana debe ser mayor que el campo entrada mañana',
                ],
            ],
            'entrada_tarde' => [
                'rules'  => 'trim|check_equal_less[' . $this->request->getPost('salida_manana') . ']',
                'errors' => [
                    'check_equal_less' => 'El campo entrada tarde debe ser mayor que el campo salida mañana',
                ],
            ],
            'salida_tarde' => [
                'rules'  => 'trim|check_equal_less[' . $this->request->getPost('entrada_tarde') . ']',
                'errors' => [
                    'check_equal_less' => 'El campo salida tarde debe ser mayor que el campo entrada tarde',
                ],
            ],
            'entrada_verano_manana' => 'trim',
            'salida_verano_manana' => 'trim',
            'entrada_verano_tarde' => 'trim',
            'salida_verano_tarde' => 'trim',
        );
    }
    public function view($modal = false, $quien = null, $fecha = null)
    {
        $tab = $this->request->getGet('tab') ? $this->request->getGet('tab') : '';
        $page = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
        $pagelength = $modal ? 10 : 50;

        if (intval($page) <= 0) {
            $page = 1;
        }
        if (count($_POST) > 0) {
            session()->set(array('asistencias.q' => $this->request->getPost('q')));
        }
        session()->set(array('asistencias.p' => $this->request->getPost('p')));
        $q = session()->get('asistencias.q');
        $p = session()->get('asistencias.p');
        if ($p == null) {
            $p = $fecha;
        }
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
        if ($quien != null) {
            $q = null;
        }
        $config['total_rows'] = $this->Asistencias_model->total_rows($p, $q, $tab, $filter);
        $start = $config['per_page'] * ($page - 1);
        $pager = \Config\Services::pager();

        $user_id = $this->ionAuth->user()->row()->id;
        $group_id = $this->Tareas_model->get_group_id($user_id);
        if (count($group_id) == 1 || $quien == 1) {
            $config['total_rows'] = $this->Asistencias_model->total_rows($p, $q, $tab, $filter, $user_id);
            $asistencias = $this->Asistencias_model->get_limit_data($p, $config['per_page'], $start, $q, $tab, $oc, $od, $filter, $user_id);
        } else {
            $config['total_rows'] = $this->Asistencias_model->total_rows($p, $q, $tab, $filter, null);
            $asistencias = $this->Asistencias_model->get_limit_data($p, $config['per_page'], $start, $q, $tab, $oc, $od, $filter, null);
        }
        $ultima_asistencia = $this->Asistencias_model->get_last_asistencia($user_id, date('Y-m-d'));
        if ($ultima_asistencia == null || $ultima_asistencia->asistenciatipo_id == 1) {
            $fichado = false;
        } else {
            $fichado = true;
        }
        if ($quien != 2) {
            $jornada = $this->Asistencias_model->get_jornada($p, $user_id);
            if ($jornada != null && count($jornada) != 1) {
                $totalhoras = $jornada[1]->total - $jornada[0]->total;
            } else {
                $totalhoras = 0;
            }
            if ($config['total_rows'] % 2 != 0 && count($jornada) != 1) {
                $fecha = date('Y-m-d H:i:s');
                $time = Time::parse($fecha);
                $totalhoras = $totalhoras + $time->timestamp;
            }
            if (count($jornada) == 1) {
                $fecha = date('Y-m-d H:i:s');
                $time = Time::parse($fecha);
                $totalhoras = $time->timestamp - $jornada[0]->total;
            }
        } else {
            $totalhoras = 0;
        }
        if ($modal == null && $quien == null) {
           $accion = site_url('asistencias/view');
        } else if ($modal != null && $quien == null) {
            $accion = site_url('asistencias/view');
        } else if ($modal != null && $quien != null) {
            $accion = site_url('asistencias/view/' . $modal . '/' . $quien);
        }

        if($fecha == null) {
            $accion .= '/' . $fecha;
        }
        $data = array(
            'accion' =>  $accion,
            'group_id' => $group_id,
            'fichado' => $fichado,
            'asistencias_data' => $asistencias,
            'totalhoras' => $totalhoras,
            'q' => $q,
            'p' => $p,
            'tab' => $tab,
            'pagination' => $pager->makeLinks($page, $config['per_page'], $config['total_rows']),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'filter' => $filter_get,
            'custom_title' => $custom_title,
            'orden_campo' => isset($oc) ? $oc : '',
            'orden_dir' => isset($oc) ? $od : '',
        );
        $data['titulo'] = 'Asistencias';
        $data['element'] = $title;
        if (session()->get('message')) {
            $data['message'] = session()->get('message');
            session()->remove('message');
        }

        $data['main'] = 'App\Modules\Asistencias\Views\asistencias_list';
        $modal_view = 'App\Modules\Asistencias\Views\asistencias_list_modal';
        return view(($modal) ? $modal_view : 'template', $data);
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
        $ultima_asistencia = $this->Asistencias_model->get_last_asistencia($user_id, date('Y-m-d'));
        if ($ultima_asistencia == null) {
            $asistencia_nueva_id = 0;
        } else {
            $asistencia_nueva_id = $ultima_asistencia->asistenciatipo_id + 1;
            if ($asistencia_nueva_id == 2) {
                $asistencia_nueva_id = 0;
            }
        }
        $fecha = date('Y-m-d H:i:s');
        $time = Time::parse($fecha);
        $data = array(
            'fechahora' => $fecha,
            'fechahora_timestamp' => $time->timestamp,
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
