<?php

namespace App\Modules\Users\Controllers;

use App\Controllers\BaseController;
use App\Modules\Users\Models\Users_model;
use CodeIgniter\Files\File;

class Users extends BaseController
{
    function __construct()
    {
        $this->Users_model = model('App\Modules\Users\Models\Users_model');
        helper(['formatos', 'form']);
        $this->validation =  \Config\Services::validation();

        $config = config('App');
        if (isset($config->authEnabled) && $config->authEnabled) {
            $this->ionAuth = new \IonAuth\Libraries\IonAuth();
            if (!$this->ionAuth->loggedIn()) {
                header("Location: " . base_url('/auth/login'));
                die();
            }
            if (!$this->ionAuth->isAdmin()) {
                header("Location: " . base_url());
                die();
            }
        }
    }

    public function index()
    {
        session()->set(array('users.q' => ''));
        return redirect()->to(current_url() . '/view');
    }


    public function view($modal = false)
    {

        $page = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
        $pagelength = $modal ? 10 : 50;

        if (intval($page) <= 0) {
            $page = 1;
        }
        if (count($_POST) > 0)
            session()->set(array('users.q' => $this->request->getPost('q')));

        $q = session()->get('users.q');

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
            session()->set(array('users.od' => $ordendir, 'users.oc' => $ordencampo));
        }

        $oc = session()->get('users.oc');
        $od = session()->get('users.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            session()->set(array('users.nr' => $nr));
        }

        $nr = session()->get('users.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = $pagelength;
            session()->set(array('users.nr' => $pagelength));
        }




        $config['base_url'] = current_url() . '/';
        $config['first_url'] = current_url() . '/';




        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->Users_model->total_rows($q, $filter);

        $start = $config['per_page'] * ($page - 1);

        $users = $this->Users_model->get_limit_data($config['per_page'], $start, $q, $oc, $od, $filter);

        // die(json_encode($users));

        $pager = \Config\Services::pager();

        $data = array(
            'users_data' => $users,
            'q' => $q,
            'pagination' => $pager->makeLinks($page, $config['per_page'], $config['total_rows']),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'filter' => $filter_get,
            'custom_title' => $custom_title,
            'orden_campo' => isset($ordencampo) ? $ordencampo : '',
            'orden_dir' => isset($ordendir) ? $ordendir : '',
        );
        $data['titulo'] = 'users';
        $data['element'] = $title;
        if (session()->get('message')) {
            $data['message'] = session()->get('message');
            session()->remove('message');
        }

        $data['main'] = 'App\Modules\Users\Views\users_list';
        $modal_view = 'App\Modules\Users\Views\users_list_modal';
        return view(($modal) ? $modal_view : 'template', $data);
    }

    public function activate($id)
    {
        $this->Users_model->where('id', $id)->set('active', 1)->update();
        return redirect()->to(site_url('users'));
    }

    public function deactivate($id)
    {
        $this->Users_model->where('id', $id)->set('active', 0)->update();
        return redirect()->to(site_url('users'));
    }

    public function create($modal = false)
    {
        $data = array(
            'button' => 'Añadir',
            'fun' => 'create',
            'action' => site_url('users/create_action'),
            'data_fields' => array(
                'username' => set_value('username'),
                'password' => set_value('password'),
                'email' => set_value('email'),
                'first_name' => set_value('first_name'),
                'last_name' => set_value('last_name'),
                'company' => set_value('company'),
                'phone' => set_value('phone'),
                'id' => set_value('id'),
                'dni' => set_value('dni'),
                'entrada_manana' => set_value('entrada_manana'),
                'salida_manana' => set_value('salida_manana'),
                'entrada_tarde' => set_value('entrada_tarde'),
                'salida_tarde' => set_value('salida_tarde'),
                'entrada_verano_manana' => set_value('entrada_verano_manana'),
                'salida_verano_manana' => set_value('salida_verano_manana'),
                'entrada_verano_tarde' => set_value('entrada_verano_tarde'),
                'salida_verano_tarde' => set_value('salida_verano_tarde')
            )
        );

        if (session()->get('message')) {
            $data['message'] = session()->get('message');
            session()->remove('message');
        }
        $data['main'] = 'App\Modules\Users\Views\users_form';
        $modal_view = 'App\Modules\Users\Views\users_form_modal';

        $data['titulo'] = 'users';
        $data['subtitulo'] = 'Añadir Usuario';
        $data['modal'] = $modal;
        return view(($modal) ? $modal_view : 'template', $data);
    }


    public function create_action()
    {
        $rules = $this->_rules('create');

        if ($this->validate($rules) == FALSE) {
            session()->set('message', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $identity = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $email = $this->request->getPost('email');
            $additionalData = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name'  => $this->request->getPost('last_name'),
                'company'    => $this->request->getPost('company'),
                'phone'      => $this->request->getPost('phone'),
                'dni'        => $this->request->getPost('dni'),
                'entrada_manana'   => $this->request->getPost('entrada_manana'),
                'salida_manana' => $this->request->getPost('salida_manana'),
                'entrada_tarde' => $this->request->getPost('entrada_tarde'),
                'salida_tarde' => $this->request->getPost('salida_tarde'),
                'entrada_verano_manana' => $this->request->getPost('entrada_verano_manana'),
                'salida_verano_manana' => $this->request->getPost('salida_verano_manana'),
                'entrada_verano_tarde' => $this->request->getPost('entrada_verano_tarde'),
                'salida_verano_tarde'  => $this->request->getPost('salida_verano_tarde')

            ];
            $user_id = $this->ionAuth->register($identity, $password, $email, $additionalData);
            if ($user_id) {
                session()->set('message', 'Usuario creado correctamente');
            } else {
                session()->set('message', 'No se ha podido crear el usuario');
            }

            return redirect()->to(site_url('users'));
        }
    }

    public function create_group()
    {
        $data = array(
            'button' => 'Añadir',
            'fun' => 'create_group',
            'action' => site_url('users/create_group_action'),
            'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
            'data_fields' => array(
                'name' => set_value('name'),
                'description' => set_value('description'),
                'id' => set_value('id'),
            )
        );
        $modal_view = 'App\Modules\Users\Views\groups_form_modal';
        $data['titulo'] = 'groups';
        $data['subtitulo'] = 'Añadir Grupo';
        return view($modal_view, $data);
    }

    public function create_group_action()
    {
        $rules = array(
            'name' => 'trim|required',
        );

        if ($this->validate($rules) == FALSE) {
            session()->set('message', 'Error al crear grupo');
            return redirect()->to(site_url('users'));
        } else {
            $data = array();
            $data['name'] = $this->request->getPost('name');
            $data['description'] = $this->request->getPost('description');

            $this->Users_model->insertGrupo($data);
            session()->set('message', 'Grupo creado correctamente');
            return redirect()->to(site_url('users'));
        }
    }


    public function update($id, $modal = false)
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Modificar',
                'fun' => 'update',
                'action' => site_url('users/update_action'),
                'data_fields' => array(
                    'username' => set_value('username', $row->username),
                    'password' => set_value('password', $row->password),
                    'email' => set_value('email', $row->email),
                    'first_name' => set_value('first_name', $row->first_name),
                    'last_name' => set_value('last_name', $row->last_name),
                    'company' => set_value('company', $row->company),
                    'phone' => set_value('phone', $row->phone),
                    'id' => set_value('id', $id),
                )
            );

            if (session()->get('message')) {
                $data['message'] = session()->get('message');
                session()->remove('message');
            }

            $data['main'] = 'App\Modules\Users\Views\users_form';
            $modal_view =  'App\Modules\Users\Views\users_form_modal';

            $db = \Config\Database::connect();
            $builder = $db->table('ion_groups');
            $builder->orderBy('id', 'ASC');
            $data['groups'] = $builder->get()->getResult();

            $db = \Config\Database::connect();
            $builder = $db->table('ion_users_groups');
            $builder->where('user_id', $id);
            $builder->orderBy('id', 'ASC');
            $data['active_groups'] = array_column($builder->get()->getResult(), 'group_id');

            $data['titulo'] = 'users';
            $data['subtitulo'] = 'Modificar Usuario';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('users'));
        }
    }

    public function update_action()
    {
        $rules = $this->_rules('update');

        if ($this->validate($rules) == FALSE) {
            session()->set('message', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $data = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name'  => $this->request->getPost('last_name'),
                'company'    => $this->request->getPost('company'),
                'phone'      => $this->request->getPost('phone'),
            ];

            if ($this->request->getPost('password')) {
                $data['password'] = $this->request->getPost('password');
            }

            $user_id = $this->request->getPost('id');
            $groupData = $this->request->getPost('groups');
            if (!empty($groupData)) {
                $this->ionAuth->removeFromGroup('', $user_id);
                foreach ($groupData as $grp) {
                    $this->ionAuth->addToGroup($grp, $user_id);
                }
            }

            if ($this->ionAuth->update($user_id, $data)) {
                session()->set('message', 'Usuario modificado correctamente');
            } else {
                session()->set('message', 'No se ha podido modificar el usuario');
            }


            return redirect()->to(site_url('users'));
        }
    }

    public function _rules($raction)
    {
        return array(
            'username' => $raction == "create" ?  'trim|required' : 'trim',
            'password' => $raction == "create" ? 'trim|required|matches[repeat_password]' : 'trim|matches[repeat_password]',
            'repeat_password' => $raction == "create" ? 'trim|required' : 'trim',
            'email' => $raction == "create" ?  'trim|required' : 'trim',
            'first_name' => 'trim|required',
            'last_name' => 'trim|required',
            'company' => 'trim',
            'phone' => 'trim',

            'id' => 'trim',
        );
    }
}
