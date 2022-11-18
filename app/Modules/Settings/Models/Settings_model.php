<?php

namespace App\Modules\Settings\Models;

use CodeIgniter\Model;


class Settings_model extends Model
{

    public $table = 'settings';
    public $id = 'key';
    public $allowedFields = array('value', 'description');
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $builder = $this->db->table($this->table)->select('settings.value,settings.description,settings.key');
        $builder->orderBy($this->id, $this->order);
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
        $builder = $this->db->table($this->table)->select('settings.value,settings.description,settings.key');

        if (count($filter) == 2) {
            $builder->where('settings.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();
            $builder->like('key', $q);
            $builder->orLike('settings.value', $q);
            $builder->orLike('settings.description', $q);
            $builder->groupEnd();
        }
        return $builder->countAllResults();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $tab = NULL, $oc = '', $od = '', $filter = array())
    {
        $builder = $this->db->table($this->table)->select('settings.value,settings.description,settings.key');


        if (count($filter) == 2) {
            $builder->where('settings.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();

            $builder->like('settings.key', $q);
            $builder->orLike('settings.value', $q);
            $builder->orLike('settings.description', $q);
            $builder->groupEnd();
        }

        if ($oc != '') {
            $builder->orderBy($oc, $od);
        } else
            $builder->orderBy('key', 'asc');
        $builder->limit($limit, $start);
        return $builder->get()->getResult();
    }
}
