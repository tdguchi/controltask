<?php

namespace App\Modules\MenuConfiguration\Models;

use CodeIgniter\Model;


class MenuConfiguration_model extends Model
{

    public $table = 'menu';
    public $id = 'menu_id';
    public $allowedFields = array('text', 'url', 'position', 'parent', 'icon', 'show_in_menu', 'show_in_dashboard', 'dashboard_description', 'admin_only');
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $builder = $this->db->table($this->table)->select('menu.url,menu.text,rel1.text as parent,menu.parent as parent_id,menu.position,menu.icon,menu.show_in_menu,menu.show_in_dashboard,menu.admin_only,menu.dashboard_description,menu.menu_id');
        $builder->orderBy($this->id, $this->order);
        $builder->join("menu rel1", "menu.parent = rel1.menu_id", "left");
        return $builder->get()->getResult();
    }

    // get data by id
    function get_by_id($id)
    {
        $builder = $this->db->table($this->table);
        $builder->where($this->id, $id);
        return $builder->get()->getRow();
    }

    // get total rows
    function total_rows($q = NULL, $tab = NULL, $filter = array())
    {
        $builder = $this->db->table($this->table)->select('menu.url,menu.text,rel1.text as parent,menu.parent as parent_id,menu.position,menu.icon,menu.show_in_menu,menu.show_in_dashboard,menu.admin_only,menu.dashboard_description,menu.menu_id');

        $builder->join("menu rel1", "menu.parent = rel1.menu_id", "left");
        if (count($filter) == 2) {
            $builder->where('menu.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();
            $builder->like('menu_id', $q);
            $builder->orLike('menu.url', $q);
            $builder->orLike('menu.text', $q);
            $builder->orLike('rel1.text', $q);
            $builder->orLike('menu.position', $q);
            $builder->orLike('menu.icon', $q);
            $builder->orLike('menu.show_in_menu', $q);
            $builder->orLike('menu.show_in_dashboard', $q);
            $builder->orLike('menu.admin_only', $q);
            $builder->orLike('menu.dashboard_description', $q);
            $builder->groupEnd();
        }
        return $builder->countAllResults();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $tab = NULL, $oc = '', $od = '', $filter = array())
    {
        $builder = $this->db->table($this->table)->select('menu.url,menu.text,rel1.text as parent,menu.parent as parent_id,menu.position,menu.icon,menu.show_in_menu,menu.show_in_dashboard,menu.admin_only,menu.dashboard_description,menu.menu_id');


        $builder->join("menu rel1", "menu.parent = rel1.menu_id", "left");
        if (count($filter) == 2) {
            $builder->where('menu.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();

            $builder->like('menu.menu_id', $q);
            $builder->orLike('menu.url', $q);
            $builder->orLike('menu.text', $q);
            $builder->orLike('rel1.text', $q);
            $builder->orLike('menu.position', $q);
            $builder->orLike('menu.icon', $q);
            $builder->orLike('menu.show_in_menu', $q);
            $builder->orLike('menu.show_in_dashboard', $q);
            $builder->orLike('menu.admin_only', $q);
            $builder->orLike('menu.dashboard_description', $q);
            $builder->groupEnd();
        }

        if ($oc != '') {
            $builder->orderBy($oc, $od);
        } else
            $builder->orderBy('menu_id', 'asc');
        $builder->limit($limit, $start);
        return $builder->get()->getResult();
    }
}
