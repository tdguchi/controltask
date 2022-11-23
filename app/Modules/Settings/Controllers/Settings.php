<?php

namespace App\Modules\Settings\Controllers;

use App\Controllers\BaseController;
use App\Modules\Settings\Models\Settings_model;
use CodeIgniter\Files\File;

class Settings extends BaseController
{
    function __construct()
    {
        $this->ionAuth    = new \IonAuth\Libraries\IonAuth();
        $this->Asistencias_model = model('App\Modules\Asistencias\Models\Asistencias_model');
        $this->Settings_model = model('App\Modules\Settings\Models\Settings_model');
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
        session()->set(array('settings.q' => ''));
        return redirect()->to(current_url() . '/view');
    }


    public function view($modal = false)
    {

        $tab = $this->request->getGet('tab') ? $this->request->getGet('tab') : '';
        $page = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
        $pagelength = $modal ? 10 : 100;

        if (intval($page) <= 0) {
            $page = 1;
        }
        if (count($_POST) > 0)
            session()->set(array('settings.q' => $this->request->getPost('q')));

        $q = session()->get('settings.q');

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
            session()->set(array('settings.od' => $ordendir, 'settings.oc' => $ordencampo));
        }

        $oc = session()->get('settings.oc');
        $od = session()->get('settings.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            session()->set(array('settings.nr' => $nr));
        }

        $nr = session()->get('settings.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = $pagelength;
            session()->set(array('settings.nr' => $pagelength));
        }

        $config['total_rows'] = $this->Settings_model->total_rows($q, $tab, $filter);

        $start = $config['per_page'] * ($page - 1);

        $settings = $this->Settings_model->get_limit_data($config['per_page'], $start, $q, $tab, $oc, $od, $filter);

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
            'settings_data' => $settings,
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
        $data['titulo'] = 'settings';
        $data['element'] = $title;
        if (session()->get('message')) {
            $data['message'] = session()->get('message');
            session()->remove('message');
        }

        $data['main'] = 'App\Modules\Settings\Views\settings_list';
        $modal_view = 'App\Modules\Settings\Views\settings_list_modal';
        return view(($modal) ? $modal_view : 'template', $data);;
    }

    public function read($id, $modal = false)
    {
        $row = $this->Settings_model->get_by_id($id);
        if ($row) {
            $data = array(
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'key' => $row->key,
                    'value' => $row->value,
                    'description' => $row->description,
                )
            );
            $data['main'] = 'App\Modules\Settings\Views\settings_read';
            $modal_view = 'App\Modules\Settings\Views\settings_read_modal';

            $data['titulo'] = 'settings';
            $data['subtitulo'] = 'Ver Settings';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('settings'));
        }
    }


    public function create($modal = false)
    {
        $data = array(
            'button' => 'Añadir',
            'fun' => 'create',
            'action' => site_url('settings/create_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
            'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
            'data_fields' => array(
                'value' => set_value('value'),
                'description' => set_value('description'),
                'key' => set_value('key'),
            )
        );
        $data['main'] = 'App\Modules\Settings\Views\settings_form';
        $modal_view = 'App\Modules\Settings\Views\settings_form_modal';

        $data['titulo'] = 'settings';
        $data['subtitulo'] = 'Añadir Settings';
        $data['modal'] = $modal;
        return view(($modal) ? $modal_view : 'template', $data);
    }


    public function create_action($from = false)
    {
        $rules = $this->_rules('create');

        if ($this->validate($rules) == FALSE) {
            return redirect()->to(site_url('settings/create'));
        } else {
            $data = array();
            $data['value'] = $this->request->getPost('value');
            $data['description'] = $this->request->getPost('description');;

            $this->eventBeforeCreate();
            $this->Settings_model->insert($data);
            $this->eventAfterCreate($this->Settings_model->insertID());
            session()->set('message', 'Settings creado correctamente');
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('settings'));
        }
    }


    public function update($id, $modal = false)
    {
        $row = $this->Settings_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Modificar',
                'fun' => 'update',
                'action' => site_url('settings/update_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'value' => set_value('value', $row->value),
                    'description' => set_value('description', $row->description),
                    'key' => set_value('key', $row->key),
                )
            );

            $data['main'] = 'App\Modules\Settings\Views\settings_form';
            $modal_view =  'App\Modules\Settings\Views\settings_form_modal';

            $data['titulo'] = 'settings';
            $data['subtitulo'] = 'Modificar Settings';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('settings'));
        }
    }

    public function update_action($from = false)
    {
        $rules = $this->_rules('update');

        if ($this->validate($rules) == FALSE) {
            $id = $this->request->getPost('key');
            return redirect()->to(site_url('settings/update/' . $id));
        } else {
            $data = array();
            $data['value'] = $this->request->getPost('value');
            $data['description'] = $this->request->getPost('description');

            $this->eventBeforeUpdate($this->request->getPost('key'));
            $this->Settings_model->where('key', $this->request->getPost('key'))->set($data)->update();
            $this->eventAfterUpdate($this->request->getPost('key'));
            session()->set('message', 'Settings modificado correctamente');
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('settings'));
        }
    }

    public function _rules($raction)
    {
        return array(
            'value' => 'trim',
            'description' => 'trim',

            'key' => 'trim',
        );
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
