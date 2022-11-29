<?php

namespace App\Modules\Horarios\Models;

use CodeIgniter\Model;


class Horarios_model extends Model
{

    public $table = 'horarios';
    public $id = 'id';
    public $allowedFields = array('titulo', 'descripcion');
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $builder = $this->db->table($this->table)->select('horarios.titulo,horarios.descripcion,horarios.proyecto_id');
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
        $builder = $this->db->table($this->table)->select('horarios.titulo,horarios.descripcion,horarios.proyecto_id');

        if (count($filter) == 2) {
            $builder->where('horarios.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();
            $builder->like('proyecto_id', $q);
            $builder->orLike('horarios.titulo', $q);
            $builder->orLike('horarios.descripcion', $q);
            $builder->groupEnd();
        }
        return $builder->countAllResults();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $tab = NULL, $oc = '', $od = '', $filter = array())
    {
        $builder = $this->db->table($this->table)->select('horarios.titulo,horarios.descripcion,horarios.proyecto_id');


        if (count($filter) == 2) {
            $builder->where('horarios.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();

            $builder->like('horarios.proyecto_id', $q);
            $builder->orLike('horarios.titulo', $q);
            $builder->orLike('horarios.descripcion', $q);
            $builder->groupEnd();
        }

        if ($oc != '') {
            $builder->orderBy($oc, $od);
        } else
            $builder->orderBy('proyecto_id', 'asc');
        $builder->limit($limit, $start);
        return $builder->get()->getResult();
    }
}