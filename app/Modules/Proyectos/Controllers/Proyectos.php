<?php

namespace App\Modules\Proyectos\Controllers;

use App\Controllers\BaseController;
use App\Modules\Proyectos\Models\Proyectos_model;
use CodeIgniter\Files\File;

class Proyectos extends BaseController
{
    function __construct()
    {
        $this->ionAuth    = new \IonAuth\Libraries\IonAuth();
        $this->Tareas_model = model('App\Modules\Tareas\Models\Tareas_model');
        $this->Asistencias_model = model('App\Modules\Asistencias\Models\Asistencias_model');
        $this->Proyectos_model = model('App\Modules\Proyectos\Models\Proyectos_model');
        helper(['formatos', 'form']);
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        session()->set(array('proyectos.q' => ''));
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
            session()->set(array('proyectos.q' => $this->request->getPost('q')));

        $q = session()->get('proyectos.q');

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
            session()->set(array('proyectos.od' => $ordendir, 'proyectos.oc' => $ordencampo));
        }

        $oc = session()->get('proyectos.oc');
        $od = session()->get('proyectos.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            session()->set(array('proyectos.nr' => $nr));
        }

        $nr = session()->get('proyectos.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = $pagelength;
            session()->set(array('proyectos.nr' => $pagelength));
        }

        $config['total_rows'] = $this->Proyectos_model->total_rows($q, $tab, $filter);
        $proyectos = $this->Proyectos_model->get_limit_data($config['per_page'], $page, $q, $tab, $filter, $oc, $od);
        $start = $config['per_page'] * ($page - 1);
        $pager = \Config\Services::pager();
        $user_id = $this->ionAuth->user()->row()->id;
        $ultima_asistencia = $this->Asistencias_model->get_last_asistencia($user_id, date('Y-m-d'));
        if ($ultima_asistencia == null || $ultima_asistencia->asistenciatipo_id == 1 || $ultima_asistencia->asistenciatipo_id == 3) {
            $fichado = false;
        } else {
            $fichado = true;
        }
        $data = array(
            'fichado' => $fichado,
            'proyectos_data' => $proyectos,
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
        $data['titulo'] = 'proyectos';
        $data['element'] = $title;
        if (session()->get('message')) {
            $data['message'] = session()->get('message');
            session()->remove('message');
        }

        $data['main'] = 'App\Modules\Proyectos\Views\proyectos_list';
        $modal_view = 'App\Modules\Proyectos\Views\proyectos_list_modal';
        return view(($modal) ? $modal_view : 'template', $data);;
    }

    public function read($id, $modal = false)
    {
        $row = $this->Proyectos_model->get_by_id($id);
        if ($row) {
            $data = array(
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'proyecto_id' => $row->proyecto_id,
                    'titulo' => $row->titulo,
                    'descripcion' => $row->descripcion,
                )
            );
            $data['main'] = 'App\Modules\Proyectos\Views\proyectos_read';
            $modal_view = 'App\Modules\Proyectos\Views\proyectos_read_modal';

            $data['titulo'] = 'proyectos';
            $data['subtitulo'] = 'Ver Proyectos';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('proyectos'));
        }
    }


    public function create($modal = false)
    {
        $data = array(
            'button' => 'Añadir',
            'fun' => 'create',
            'action' => site_url('proyectos/create_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
            'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
            'data_fields' => array(
                'titulo' => set_value('titulo'),
                'descripcion' => set_value('descripcion'),
                'proyecto_id' => set_value('proyecto_id'),
            )
        );
        $data['main'] = 'App\Modules\Proyectos\Views\proyectos_form';
        $modal_view = 'App\Modules\Proyectos\Views\proyectos_form_modal';

        $data['titulo'] = 'proyectos';
        $data['subtitulo'] = 'Añadir Proyectos';
        $data['modal'] = $modal;
        return view(($modal) ? $modal_view : 'template', $data);
    }


    public function create_action($from = false)
    {
        $rules = $this->_rules('create');

        if ($this->validate($rules) == FALSE) {
            return redirect()->to(site_url('proyectos/create'));
        } else {
            $data = array();
            $data['titulo'] = $this->request->getPost('titulo');
            $data['descripcion'] = $this->request->getPost('descripcion');;

            $this->eventBeforeCreate();
            $this->Proyectos_model->insert($data);
            $this->eventAfterCreate($this->Proyectos_model->insertID());
            session()->set('message', 'Proyectos creado correctamente');
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('proyectos'));
        }
    }


    public function update($id, $modal = false)
    {
        $row = $this->Proyectos_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Modificar',
                'fun' => 'update',
                'action' => site_url('proyectos/update_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'titulo' => set_value('titulo', $row->titulo),
                    'descripcion' => set_value('descripcion', $row->descripcion),
                    'proyecto_id' => set_value('proyecto_id', $row->proyecto_id),
                )
            );

            $data['main'] = 'App\Modules\Proyectos\Views\proyectos_form';
            $modal_view =  'App\Modules\Proyectos\Views\proyectos_form_modal';

            $data['titulo'] = 'proyectos';
            $data['subtitulo'] = 'Modificar Proyectos';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('proyectos'));
        }
    }

    public function update_action($from = false)
    {
        $rules = $this->_rules('update');

        if ($this->validate($rules) == FALSE) {
            $id = $this->request->getPost('proyecto_id');
            return redirect()->to(site_url('proyectos/update/' . $id));
        } else {
            $data = array();
            $data['titulo'] = $this->request->getPost('titulo');
            $data['descripcion'] = $this->request->getPost('descripcion');

            $this->eventBeforeUpdate($this->request->getPost('proyecto_id'));
            $this->Proyectos_model->where('proyecto_id', $this->request->getPost('proyecto_id'))->set($data)->update();
            $this->eventAfterUpdate($this->request->getPost('proyecto_id'));
            session()->set('message', 'Proyectos modificado correctamente');
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('proyectos'));
        }
    }

    public function delete($id)
    {
        $row = $this->Proyectos_model->get_by_id($id);

        if ($row) {
            $this->eventBeforeDelete($id);
            $this->Proyectos_model->where('proyecto_id', $id)->delete();
            $this->eventAfterDelete($id);
            session()->set('message', 'Proyectos eliminado correctamente');
            return redirect()->to(site_url('proyectos'));
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('proyectos'));
        }
    }

    public function bulk_delete(...$ids)
    {
        $rows = $this->Proyectos_model->whereIn('proyecto_id', $ids)->countAllResults();

        if ($rows > 0) {
            foreach ($ids as $id) {
                $this->eventBeforeDelete($id);
            }
            $this->Proyectos_model->whereIn('proyecto_id', $ids)->delete();
            foreach ($ids as $id) {
                $this->eventAfterDelete($id);
            }

            session()->set('message', $rows . ' Proyectos eliminado' . ($rows > 1 ? 's' : '') . ' correctamente');
        } else {
            session()->set('message', 'No hay resultados');
        }
        return redirect()->to(site_url('proyectos'));
    }

    public function _rules($raction)
    {
        return array(
            'titulo' => 'trim|required',
            'descripcion' => 'trim|required',

            'proyecto_id' => 'trim',
        );
    }

    public function excel()
    {
        helper('../Modules/Proyectos/Helpers/exportexcel');
        $namaFile = "proyectos.xls";
        $judul = "proyectos";
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

        foreach ($this->Proyectos_model->get_all() as $data) {
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
