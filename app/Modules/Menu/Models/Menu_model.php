<?php

namespace App\Modules\Menu\Models;

use CodeIgniter\Model;

class Menu_model extends Model
{

	public $table = 'menu';
	public $id = 'menu_id';
	public $allowedFields = array('text', 'url', 'parent', 'position', 'icon', 'show_in_menu', 'show_in_dashboard', 'dashboard_description', 'admin_only');

	function __construct()
	{
		parent::__construct();
		$config = new \Config\App();
		if (isset($config->authEnabled) && $config->authEnabled) {
			$ionAuth = new \IonAuth\Libraries\IonAuth();
			$this->admin = $ionAuth->isAdmin();
		} else {
			$this->admin = false;
		}
	}

	function get_all()
	{
		$builder = $this->db->table($this->table)->select('menu.url,menu.text,menu.menu_id,menu.parent,menu.position,parent.text as parent_text,menu.icon,menu.show_in_menu,menu.show_in_dashboard,menu.dashboard_description,menu.admin_only');
		$builder->join("menu parent", "menu.parent = parent.menu_id", "left");
		$builder->orderBy('position', 'asc');
		return $builder->get()->getResult();
	}

	function get_by_id($id)
	{
		$builder = $this->db->table($this->table);
		$builder->where($this->id, $id);
		return $builder->get()->getRow();
	}

	function total_rows($q = NULL)
	{
		$builder = $this->db->table($this->table)->select('menu.url,menu.text,menu.menu_id,menu.parent,menu.position,parent.text as parent_text,menu.icon,menu.show_in_menu,menu.show_in_dashboard,menu.dashboard_description,menu.admin_only');
		$builder->join("menu parent", "menu.parent = parent.menu_id", "left");

		if (!empty($q)) {
			$builder->groupStart();
			$builder->like('menu.url', $q);
			$builder->orLike('menu.text', $q);
			$builder->orLike('menu.dashboard_description', $q);
			$builder->groupEnd();
		}
		return $builder->countAllResults();
	}

	function get_limit_data($limit, $start = 0, $q = NULL, $oc = '', $od = '')
	{
		$builder = $this->db->table($this->table)->select('menu.url,menu.text,menu.menu_id,menu.parent,menu.position,parent.text as parent_text,menu.icon,menu.show_in_menu,menu.show_in_dashboard,menu.dashboard_description,menu.admin_only');
		$builder->join("menu parent", "menu.parent = parent.menu_id", "left");

		if (!empty($q)) {
			$builder->groupStart();
			$builder->like('menu.url', $q);
			$builder->orLike('menu.text', $q);
			$builder->orLike('menu.dashboard_description', $q);
			$builder->groupEnd();
		}

		if ($oc != '') {
			$builder->orderBy($oc, $od);
		} else {
			$builder->orderBy('position', 'asc');
		}
		$builder->limit($limit, $start);
		return $builder->get()->getResult();
	}

	function get_menu_items($id = 0)
	{
		return $this->get_items('show_in_menu', $id);
	}

	function get_dashboard_items($id = 0)
	{
		return $this->get_items('show_in_dashboard', $id);
	}

	function get_items($field, $id)
	{
		$builder = $this->db->table($this->table)->select('menu.url,menu.text,menu.menu_id,menu.parent,menu.position,menu.icon,menu.dashboard_description,menu.admin_only');
		$builder->orderBy('position', 'asc');
		$builder->where('parent', $id);
		$builder->where($field, 1);
		if (!$this->admin) {
			$builder->where('admin_only', 0);
		}
		if ($id == 0) {
			$builder->orWhere('parent IS NULL');
		}
		$menu_items = $builder->get()->getResult();
		$result = array();
		foreach ($menu_items as $item) {
			$result[] = array(
				'id'					=> $item->menu_id,
				'text'					=> $item->text,
				'url'					=> $item->url,
				'icon'					=> $item->icon,
				'dashboard_description'	=> $item->dashboard_description,
				'children'				=> $this->get_items($field, $item->menu_id),
			);
		}
		return $result;
	}

	function get_by_url($url)
	{
		$builder = $this->db->table($this->table);
		$builder->where('url', $url);
		return $builder->get()->getRow();
	}
}
