<?php

namespace App\Modules\Users\Models;

use CodeIgniter\Model;


class Users_model extends Model
{

    public $table = 'ion_users';
    public $id = 'id';
    public $allowedFields = array('first_name', 'last_name', 'username', 'company', 'email', 'phone', 'password', 'active');
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $builder = $this->db->table($this->table)->select('ion_users.email,ion_users.active,ion_users.first_name,ion_users.last_name,id');
        $builder->orderBy($this->id, $this->order);
        return $builder->get()->getResult();
    }

    // get data by id
    function get_by_id($id)
    {
        $builder = $this->db->table($this->table);
        $builder->where("id", $id);
        $user = $builder->get()->getRow();

        return $user;
    }

    // get total rows
    function total_rows($q = NULL, $filter = array())
    {
        $builder = $this->db->table($this->table)->select('ion_users.email,ion_users.active,ion_users.first_name,ion_users.last_name,id');

        if (count($filter) == 2) {
            $builder->where('ion_users.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();
            $builder->like('id', $q);
            $builder->orLike('ion_users.email', $q);
            $builder->orLike('ion_users.active', $q);
            $builder->orLike('ion_users.first_name', $q);
            $builder->orLike('ion_users.last_name', $q);
            $builder->groupEnd();
        }
        return $builder->countAllResults();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $oc = '', $od = '', $filter = array())
    {
        $builder = $this->db->table($this->table)->select('ion_users.username,ion_users.email,ion_users.active,ion_users.first_name,ion_users.last_name,id,ion_users.dni, ion_users.entrada_manana, ion_users.salida_manana, ion_users.entrada_tarde, ion_users.salida_tarde, ion_users.entrada_verano_manana, ion_users.salida_verano_manana, ion_users.entrada_verano_tarde, ion_users.salida_verano_tarde');


        if (count($filter) == 2) {
            $builder->where('ion_users.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();

            $builder->like('ion_users.id', $q);
            $builder->orLike('ion_users.email', $q);
            $builder->orLike('ion_users.active', $q);
            $builder->orLike('ion_users.first_name', $q);
            $builder->orLike('ion_users.last_name', $q);
            $builder->groupEnd();
        }

        if ($oc != '') {
            $builder->orderBy($oc, $od);
        } else
            $builder->orderBy('id', 'asc');
        $builder->limit($limit, $start);
        $users = $builder->get()->getResult();
        foreach ($users as $user) {
            $builder = $this->db->table('ion_users_groups')->select('ion_groups.name');
            $builder->join("ion_groups", "ion_users_groups.group_id = ion_groups.id", "left");
            $builder->where("user_id", $user->id);
            $user->groups = implode(', ', array_column($builder->get()->getResult(), 'name'));
        }
        return $users;
    }

    function insertGrupo($data)
    {
        $this->db->table('ion_groups')->insert($data);
    }
}
