<?php

namespace App\Modules\Operadores\Models;

use CodeIgniter\Model;


class Operadores_model extends Model
{

    public $table = 'operadores';
    public $id = 'operador_id';
    public $allowedFields = array('nombre', 'apellidos', 'dni', 'email', 'password', 'entrada_manana', 'salida_manana', 'entrada_tarde', 'salida_tarde', 'entrada_verano_manana', 'salida_verano_manana', 'entrada_verano_tarde', 'salida_verano_tarde', 'tipo', 'activado');
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $builder = $this->db->table($this->table)->select('operadores.nombre,operadores.apellidos,operadores.dni,operadores.email,operadores.tipo,operadores.operador_id');
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
        $builder = $this->db->table($this->table)->select('operadores.nombre,operadores.apellidos,operadores.dni,operadores.email,operadores.tipo,operadores.operador_id');

        if (count($filter) == 2) {
            $builder->where('operadores.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();
            $builder->like('operador_id', $q);
            $builder->orLike('operadores.nombre', $q);
            $builder->orLike('operadores.apellidos', $q);
            $builder->orLike('operadores.dni', $q);
            $builder->orLike('operadores.email', $q);
            $builder->orLike('operadores.tipo', $q);
            $builder->groupEnd();
        }
        return $builder->countAllResults();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $tab = NULL, $oc = '', $od = '', $filter = array())
    {
        $builder = $this->db->table($this->table)->select('operadores.nombre,operadores.apellidos,operadores.dni,operadores.email,operadores.tipo,operadores.operador_id');


        if (count($filter) == 2) {
            $builder->where('operadores.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();

            $builder->like('operadores.operador_id', $q);
            $builder->orLike('operadores.nombre', $q);
            $builder->orLike('operadores.apellidos', $q);
            $builder->orLike('operadores.dni', $q);
            $builder->orLike('operadores.email', $q);
            $builder->orLike('operadores.tipo', $q);
            $builder->groupEnd();
        }

        if ($oc != '') {
            $builder->orderBy($oc, $od);
        } else
            $builder->orderBy('nombre', 'asc');
        $builder->limit($limit, $start);
        return $builder->get()->getResult();
    }
}
