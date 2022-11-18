<?php

namespace App\Modules\MenuConfiguration\Controllers;

use App\Controllers\BaseController;
use App\Modules\MenuConfiguration\Models\MenuConfiguration_model;
use CodeIgniter\Files\File;

class MenuConfiguration extends BaseController
{
    function __construct()
    {
        $this->MenuConfiguration_model = model('App\Modules\MenuConfiguration\Models\MenuConfiguration_model');
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
        session()->set(array('menuconfiguration.q' => ''));
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
            session()->set(array('menuconfiguration.q' => $this->request->getPost('q')));

        $q = session()->get('menuconfiguration.q');

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
            session()->set(array('menuconfiguration.od' => $ordendir, 'menuconfiguration.oc' => $ordencampo));
        }

        $oc = session()->get('menuconfiguration.oc');
        $od = session()->get('menuconfiguration.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            session()->set(array('menuconfiguration.nr' => $nr));
        }

        $nr = session()->get('menuconfiguration.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = $pagelength;
            session()->set(array('menuconfiguration.nr' => $pagelength));
        }

        $config['total_rows'] = $this->MenuConfiguration_model->total_rows($q, $tab, $filter);

        $start = $config['per_page'] * ($page - 1);

        $menuconfiguration = $this->MenuConfiguration_model->get_limit_data($config['per_page'], $start, $q, $tab, $oc, $od, $filter);

        $pager = \Config\Services::pager();

        $data = array(
            'menuconfiguration_data' => $menuconfiguration,
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
        $data['titulo'] = 'Menú';
        $data['element'] = $title;
        if (session()->get('message')) {
            $data['message'] = session()->get('message');
            session()->remove('message');
        }

        $data['main'] = 'App\Modules\MenuConfiguration\Views\menu_list';
        $modal_view = 'App\Modules\MenuConfiguration\Views\menu_list_modal';
        return view(($modal) ? $modal_view : 'template', $data);;
    }

    public function read($id, $modal = false)
    {
        $row = $this->MenuConfiguration_model->get_by_id($id);
        if ($row) {
            $data = array(
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'menu_id' => $row->menu_id,
                    'url' => $row->url,
                    'text' => $row->text,
                    'parent' => $row->parent,
                    'position' => $row->position,
                    'icon' => $row->icon,
                    'show_in_menu' => $row->show_in_menu,
                    'show_in_dashboard' => $row->show_in_dashboard,
                    'admin_only' => $row->admin_only,
                    'dashboard_description' => $row->dashboard_description,
                )
            );
            $db = \Config\Database::connect();
            $builder = $db->table('menu');
            $builder->orderBy('menu_id', 'ASC');
            $data['s_parent'] = $builder->get()->getResult();
            $data['main'] = 'App\Modules\MenuConfiguration\Views\menu_read';
            $modal_view = 'App\Modules\MenuConfiguration\Views\menu_read_modal';

            $data['titulo'] = 'Menú';
            $data['subtitulo'] = 'Ver Menú';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('menuconfiguration'));
        }
    }


    public function create($modal = false)
    {
        $data = array(
            'button' => 'Añadir',
            'fun' => 'create',
            'action' => site_url('menuconfiguration/create_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
            'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
            'data_fields' => array(
                'url' => set_value('url'),
                'text' => set_value('text'),
                'parent' => set_value('parent'),
                'position' => set_value('position'),
                'icon' => set_value('icon'),
                'show_in_menu' => set_value('show_in_menu'),
                'show_in_dashboard' => set_value('show_in_dashboard'),
                'admin_only' => set_value('admin_only'),
                'dashboard_description' => set_value('dashboard_description'),
                'menu_id' => set_value('menu_id'),
            )
        );
        $db = \Config\Database::connect();
        $builder = $db->table('menu');
        $builder->orderBy('menu_id', 'ASC');
        $data['s_parent'] = $builder->get()->getResult();
        $data['main'] = 'App\Modules\MenuConfiguration\Views\menu_form';
        $modal_view = 'App\Modules\MenuConfiguration\Views\menu_form_modal';

        $data['titulo'] = 'Menú';
        $data['subtitulo'] = 'Añadir Menú';
        $data['modal'] = $modal;
        return view(($modal) ? $modal_view : 'template', $data);
    }


    public function create_action($from = false)
    {
        $rules = $this->_rules('create');

        if ($this->validate($rules) == FALSE) {
            return redirect()->to(site_url('menuconfiguration/create'));
        } else {
            $data = array();
            $data['url'] = $this->request->getPost('url');
            $data['text'] = $this->request->getPost('text');
            $data['parent'] = $this->request->getPost('parent');
            $data['position'] = $this->request->getPost('position');
            $data['icon'] = $this->request->getPost('icon');
            $data['show_in_menu'] = $this->request->getPost('show_in_menu');
            $data['show_in_dashboard'] = $this->request->getPost('show_in_dashboard');
            $data['admin_only'] = $this->request->getPost('admin_only');
            $data['dashboard_description'] = $this->request->getPost('dashboard_description');;

            $this->eventBeforeCreate();
            $this->MenuConfiguration_model->insert($data);
            $this->eventAfterCreate($this->MenuConfiguration_model->insertID());
            session()->set('message', 'Menu creado correctamente');
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('menuconfiguration'));
        }
    }


    public function update($id, $modal = false)
    {
        $row = $this->MenuConfiguration_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Modificar',
                'fun' => 'update',
                'action' => site_url('menuconfiguration/update_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
                'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
                'data_fields' => array(
                    'url' => set_value('url', $row->url),
                    'text' => set_value('text', $row->text),
                    'parent' => set_value('parent', $row->parent),
                    'position' => set_value('position', $row->position),
                    'icon' => set_value('icon', $row->icon),
                    'show_in_menu' => set_value('show_in_menu', $row->show_in_menu),
                    'show_in_dashboard' => set_value('show_in_dashboard', $row->show_in_dashboard),
                    'admin_only' => set_value('admin_only', $row->admin_only),
                    'dashboard_description' => set_value('dashboard_description', $row->dashboard_description),
                    'menu_id' => set_value('menu_id', $row->menu_id),
                )
            );

            $db = \Config\Database::connect();
            $builder = $db->table('menu');
            $builder->orderBy('menu_id', 'ASC');
            $data['s_parent'] = $builder->get()->getResult();
            $data['main'] = 'App\Modules\MenuConfiguration\Views\menu_form';
            $modal_view =  'App\Modules\MenuConfiguration\Views\menu_form_modal';

            $data['titulo'] = 'Menú';
            $data['subtitulo'] = 'Modificar Menú';
            $data['modal'] = $modal;
            return view(($modal) ? $modal_view : 'template', $data);
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('menuconfiguration'));
        }
    }

    public function update_action($from = false)
    {
        $rules = $this->_rules('update');

        if ($this->validate($rules) == FALSE) {
            $id = $this->request->getPost('menu_id');
            return redirect()->to(site_url('menuconfiguration/update/' . $id));
        } else {
            $data = array();
            $data['url'] = $this->request->getPost('url');
            $data['text'] = $this->request->getPost('text');
            $data['parent'] = $this->request->getPost('parent');
            $data['position'] = $this->request->getPost('position');
            $data['icon'] = $this->request->getPost('icon');
            $data['show_in_menu'] = $this->request->getPost('show_in_menu');
            $data['show_in_dashboard'] = $this->request->getPost('show_in_dashboard');
            $data['admin_only'] = $this->request->getPost('admin_only');
            $data['dashboard_description'] = $this->request->getPost('dashboard_description');

            $this->eventBeforeUpdate($this->request->getPost('menu_id'));
            $this->MenuConfiguration_model->where('menu_id', $this->request->getPost('menu_id'))->set($data)->update();
            $this->eventAfterUpdate($this->request->getPost('menu_id'));
            session()->set('message', 'Menu modificado correctamente');
            return redirect()->to($from ? site_url(urldecode($from)) : site_url('menuconfiguration'));
        }
    }

    public function delete($id)
    {
        $row = $this->MenuConfiguration_model->get_by_id($id);

        if ($row) {
            $this->eventBeforeDelete($id);
            $this->MenuConfiguration_model->where('menu_id', $id)->delete();
            $this->eventAfterDelete($id);
            session()->set('message', 'Menu eliminado correctamente');
            return redirect()->to(site_url('menuconfiguration'));
        } else {
            session()->set('message', 'Record Not Found');
            return redirect()->to(site_url('menuconfiguration'));
        }
    }

    public function bulk_delete(...$ids)
    {
        $rows = $this->MenuConfiguration_model->whereIn('menu_id', $ids)->countAllResults();

        if ($rows > 0) {
            foreach ($ids as $id) {
                $this->eventBeforeDelete($id);
            }
            $this->MenuConfiguration_model->whereIn('menu_id', $ids)->delete();
            foreach ($ids as $id) {
                $this->eventAfterDelete($id);
            }

            session()->set('message', $rows . ' Menu eliminado' . ($rows > 1 ? 's' : '') . ' correctamente');
        } else {
            session()->set('message', 'No hay resultados');
        }
        return redirect()->to(site_url('menuconfiguration'));
    }

    public function _rules($raction)
    {
        return array(
            'url' => 'trim',
            'text' => 'trim',
            'parent' => 'trim',
            'position' => 'trim',
            'icon' => 'trim',
            'show_in_menu' => 'trim',
            'show_in_dashboard' => 'trim',
            'admin_only' => 'trim',
            'dashboard_description' => 'trim',

            'menu_id' => 'trim',
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
