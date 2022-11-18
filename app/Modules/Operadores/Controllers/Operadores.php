<?php

namespace App\Modules\Operadores\Controllers;

use App\Controllers\BaseController;
use App\Modules\Operadores\Models\Operadores_model;
use CodeIgniter\Files\File;

class Operadores extends BaseController
{
    function __construct()
    {
        $this->Operadores_model = model('App\Modules\Operadores\Models\Operadores_model');
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
        session()->set(array('operadores.q' => ''));
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
            session()->set(array('operadores.q' => $this->request->getPost('q')));

        $q = session()->get('operadores.q');

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
            session()->set(array('operadores.od' => $ordendir, 'operadores.oc' => $ordencampo));
        }

        $oc = session()->get('operadores.oc');
        $od = session()->get('operadores.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            session()->set(array('operadores.nr' => $nr));
        }

        $nr = session()->get('operadores.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = $pagelength;
            session()->set(array('operadores.nr' => $pagelength));
        }

        $config['total_rows'] = $this->Operadores_model->total_rows($q, $tab, $filter);

        $start = $config['per_page'] * ($page - 1);

        $operadores = $this->Operadores_model->get_limit_data($config['per_page'], $start, $q, $tab, $oc, $od, $filter);

        $pager = \Config\Services::pager();

        $data = array(
            'operadores_data' => $operadores,
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
        $data['titulo'] = 'operadores';
        $data['element'] = $title;
        if (session()->get('message')) {
            $data['message'] = session()->get('message');
            session()->remove('message');
        }

        $data['main'] = 'App\Modules\Operadores\Views\operadores_list';
        $modal_view = 'App\Modules\Operadores\Views\operadores_list_modal';
        return view(($modal) ? $modal_view : 'template', $data);;
    }

    public function read($id, $modal = false)
    {
        $row = $this->Operadores_model->get_by_id($id);
        if ($row) {
            $data = array(
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'operador_id' => $row->operador_id,
                    'nombre' => $row->nombre,
                    'apellidos' => $row->apellidos,
                    'dni' => $row->dni,
                    'email' => $row->email,
                    'password' => $row->password,
                    'entrada_manana' => $row->entrada_manana,
                    'salida_manana' => $row->salida_manana,
                    'entrada_tarde' => $row->entrada_tarde,
                    'salida_tarde' => $row->salida_tarde,
                    'entrada_verano_manana' => $row->entrada_verano_manana,
                    'salida_verano_manana' => $row->salida_verano_manana,
                    'entrada_verano_tarde' => $row->entrada_verano_tarde,
                    'salida_verano_tarde' => $row->salida_verano_tarde,
                    'tipo' => $row->tipo,
                    'activado' => $row->activado,
                    'token' => $row->token,
                    'fechatoken' => $row->fechatoken,
                )
            );
            $data['main'] = 'App\Modules\Operadores\Views\operadores_read';
            $modal_view = 'App\Modules\Operadores\Views\operadores_read_modal';

            $data['titulo'] = 'operadores';
            $data['subtitulo'] = 'Ver Operadores';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('operadores'));
        }
    }


    public function create($modal = false)
    {
        $data = array(
            'button' => 'Añadir',
            'fun' => 'create',
            'action' => site_url('operadores/create_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
            'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
            'data_fields' => array(
                'nombre' => set_value('nombre'),
                'apellidos' => set_value('apellidos'),
                'dni' => set_value('dni'),
                'email' => set_value('email'),
                'password' => set_value('password'),
                'entrada_manana' => set_value('entrada_manana'),
                'salida_manana' => set_value('salida_manana'),
                'entrada_tarde' => set_value('entrada_tarde'),
                'salida_tarde' => set_value('salida_tarde'),
                'entrada_verano_manana' => set_value('entrada_verano_manana'),
                'salida_verano_manana' => set_value('salida_verano_manana'),
                'entrada_verano_tarde' => set_value('entrada_verano_tarde'),
                'salida_verano_tarde' => set_value('salida_verano_tarde'),
                'tipo' => set_value('tipo'),
                'activado' => set_value('activado'),
                'operador_id' => set_value('operador_id'),
            )
        );
        $data['main'] = 'App\Modules\Operadores\Views\operadores_form';
        $modal_view = 'App\Modules\Operadores\Views\operadores_form_modal';

        $data['titulo'] = 'operadores';
        $data['subtitulo'] = 'Añadir Operadores';
        $data['modal'] = $modal;
        return view(($modal) ? $modal_view : 'template', $data);
    }


    public function create_action($from = false)
    {
        $rules = $this->_rules('create');

        if ($this->validate($rules) == FALSE) {
            return redirect()->to(site_url('operadores/create'));
        } else {
            $data = array();
            $data['nombre'] = $this->request->getPost('nombre');
            $data['apellidos'] = $this->request->getPost('apellidos');
            $data['dni'] = $this->request->getPost('dni');
            $data['email'] = $this->request->getPost('email');
            $data['password'] = $this->request->getPost('password');
            $data['entrada_manana'] = $this->request->getPost('entrada_manana');
            $data['salida_manana'] = $this->request->getPost('salida_manana');
            $data['entrada_tarde'] = $this->request->getPost('entrada_tarde');
            $data['salida_tarde'] = $this->request->getPost('salida_tarde');
            $data['entrada_verano_manana'] = $this->request->getPost('entrada_verano_manana');
            $data['salida_verano_manana'] = $this->request->getPost('salida_verano_manana');
            $data['entrada_verano_tarde'] = $this->request->getPost('entrada_verano_tarde');
            $data['salida_verano_tarde'] = $this->request->getPost('salida_verano_tarde');
            $data['tipo'] = $this->request->getPost('tipo');
            $data['activado'] = $this->request->getPost('activado');;

            $this->eventBeforeCreate();
            $this->Operadores_model->insert($data);
            $this->eventAfterCreate($this->Operadores_model->insertID());
            session()->set('message', 'Operadores creado correctamente');
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('operadores'));
        }
    }


    public function update($id, $modal = false)
    {
        $row = $this->Operadores_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Modificar',
                'fun' => 'update',
                'action' => site_url('operadores/update_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'nombre' => set_value('nombre', $row->nombre),
                    'apellidos' => set_value('apellidos', $row->apellidos),
                    'dni' => set_value('dni', $row->dni),
                    'email' => set_value('email', $row->email),
                    'password' => set_value('password', $row->password),
                    'entrada_manana' => set_value('entrada_manana', $row->entrada_manana),
                    'salida_manana' => set_value('salida_manana', $row->salida_manana),
                    'entrada_tarde' => set_value('entrada_tarde', $row->entrada_tarde),
                    'salida_tarde' => set_value('salida_tarde', $row->salida_tarde),
                    'entrada_verano_manana' => set_value('entrada_verano_manana', $row->entrada_verano_manana),
                    'salida_verano_manana' => set_value('salida_verano_manana', $row->salida_verano_manana),
                    'entrada_verano_tarde' => set_value('entrada_verano_tarde', $row->entrada_verano_tarde),
                    'salida_verano_tarde' => set_value('salida_verano_tarde', $row->salida_verano_tarde),
                    'tipo' => set_value('tipo', $row->tipo),
                    'activado' => set_value('activado', $row->activado),
                    'operador_id' => set_value('operador_id', $row->operador_id),
                )
            );

            $data['main'] = 'App\Modules\Operadores\Views\operadores_form';
            $modal_view =  'App\Modules\Operadores\Views\operadores_form_modal';

            $data['titulo'] = 'operadores';
            $data['subtitulo'] = 'Modificar Operadores';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('operadores'));
        }
    }

    public function update_action($from = false)
    {
        $rules = $this->_rules('update');

        if ($this->validate($rules) == FALSE) {
            $id = $this->request->getPost('operador_id');
            return redirect()->to(site_url('operadores/update/' . $id));
        } else {
            $data = array();
            $data['nombre'] = $this->request->getPost('nombre');
            $data['apellidos'] = $this->request->getPost('apellidos');
            $data['dni'] = $this->request->getPost('dni');
            $data['email'] = $this->request->getPost('email');
            $data['password'] = $this->request->getPost('password');
            $data['entrada_manana'] = $this->request->getPost('entrada_manana');
            $data['salida_manana'] = $this->request->getPost('salida_manana');
            $data['entrada_tarde'] = $this->request->getPost('entrada_tarde');
            $data['salida_tarde'] = $this->request->getPost('salida_tarde');
            $data['entrada_verano_manana'] = $this->request->getPost('entrada_verano_manana');
            $data['salida_verano_manana'] = $this->request->getPost('salida_verano_manana');
            $data['entrada_verano_tarde'] = $this->request->getPost('entrada_verano_tarde');
            $data['salida_verano_tarde'] = $this->request->getPost('salida_verano_tarde');
            $data['tipo'] = $this->request->getPost('tipo');
            $data['activado'] = $this->request->getPost('activado');

            $this->eventBeforeUpdate($this->request->getPost('operador_id'));
            $this->Operadores_model->where('operador_id', $this->request->getPost('operador_id'))->set($data)->update();
            $this->eventAfterUpdate($this->request->getPost('operador_id'));
            session()->set('message', 'Operadores modificado correctamente');
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('operadores'));
        }
    }

    public function delete($id)
    {
        $row = $this->Operadores_model->get_by_id($id);

        if ($row) {
            $this->eventBeforeDelete($id);
            $this->Operadores_model->where('operador_id', $id)->delete();
            $this->eventAfterDelete($id);
            session()->set('message', 'Operadores eliminado correctamente');
            return redirect()->to(site_url('operadores'));
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('operadores'));
        }
    }

    public function bulk_delete(...$ids)
    {
        $rows = $this->Operadores_model->whereIn('operador_id', $ids)->countAllResults();

        if ($rows > 0) {
            foreach ($ids as $id) {
                $this->eventBeforeDelete($id);
            }
            $this->Operadores_model->whereIn('operador_id', $ids)->delete();
            foreach ($ids as $id) {
                $this->eventAfterDelete($id);
            }

            session()->set('message', $rows . ' Operadores eliminado' . ($rows > 1 ? 's' : '') . ' correctamente');
        } else {
            session()->set('message', 'No hay resultados');
        }
        return redirect()->to(site_url('operadores'));
    }

    public function _rules($raction)
    {
        return array(
            'nombre' => 'trim|required',
            'apellidos' => 'trim|required',
            'dni' => 'trim|required',
            'email' => 'trim|required',
            'password' => 'trim|required',
            'entrada_manana' => 'trim|required',
            'salida_manana' => 'trim|required',
            'entrada_tarde' => 'trim|required',
            'salida_tarde' => 'trim|required',
            'entrada_verano_manana' => 'trim',
            'salida_verano_manana' => 'trim',
            'entrada_verano_tarde' => 'trim',
            'salida_verano_tarde' => 'trim',
            'tipo' => 'trim|required',
            'activado' => 'trim|required',

            'operador_id' => 'trim',
        );
    }

    public function excel()
    {
        helper('../Modules/Operadores/Helpers/exportexcel');
        $namaFile = "operadores.xls";
        $judul = "operadores";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nombre");
        xlsWriteLabel($tablehead, $kolomhead++, "Apellidos");
        xlsWriteLabel($tablehead, $kolomhead++, "Dni");
        xlsWriteLabel($tablehead, $kolomhead++, "Email");
        xlsWriteLabel($tablehead, $kolomhead++, "Password");
        xlsWriteLabel($tablehead, $kolomhead++, "Entrada Manana");
        xlsWriteLabel($tablehead, $kolomhead++, "Salida Manana");
        xlsWriteLabel($tablehead, $kolomhead++, "Entrada Tarde");
        xlsWriteLabel($tablehead, $kolomhead++, "Salida Tarde");
        xlsWriteLabel($tablehead, $kolomhead++, "Entrada Verano Manana");
        xlsWriteLabel($tablehead, $kolomhead++, "Salida Verano Manana");
        xlsWriteLabel($tablehead, $kolomhead++, "Entrada Verano Tarde");
        xlsWriteLabel($tablehead, $kolomhead++, "Salida Verano Tarde");
        xlsWriteLabel($tablehead, $kolomhead++, "Tipo");
        xlsWriteLabel($tablehead, $kolomhead++, "Activado");
        xlsWriteLabel($tablehead, $kolomhead++, "Token");
        xlsWriteLabel($tablehead, $kolomhead++, "Fechatoken");

        foreach ($this->Operadores_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nombre);
            xlsWriteLabel($tablebody, $kolombody++, $data->apellidos);
            xlsWriteLabel($tablebody, $kolombody++, $data->dni);
            xlsWriteLabel($tablebody, $kolombody++, $data->email);
            xlsWriteLabel($tablebody, $kolombody++, $data->password);
            xlsWriteLabel($tablebody, $kolombody++, $data->entrada_manana);
            xlsWriteLabel($tablebody, $kolombody++, $data->salida_manana);
            xlsWriteLabel($tablebody, $kolombody++, $data->entrada_tarde);
            xlsWriteLabel($tablebody, $kolombody++, $data->salida_tarde);
            xlsWriteLabel($tablebody, $kolombody++, $data->entrada_verano_manana);
            xlsWriteLabel($tablebody, $kolombody++, $data->salida_verano_manana);
            xlsWriteLabel($tablebody, $kolombody++, $data->entrada_verano_tarde);
            xlsWriteLabel($tablebody, $kolombody++, $data->salida_verano_tarde);
            xlsWriteNumber($tablebody, $kolombody++, $data->tipo);
            xlsWriteNumber($tablebody, $kolombody++, $data->activado);
            xlsWriteNumber($tablebody, $kolombody++, $data->token);
            xlsWriteLabel($tablebody, $kolombody++, $data->fechatoken);

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
