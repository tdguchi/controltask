<?php

namespace App\Modules\Horarios\Models;

use CodeIgniter\Model;


class Horarios_model extends Model
{

    public $table = 'horarios';
    public $id = 'id';
    public $allowedFields = array('id','entrada_manana', 'salida_manana', 'entrada_tarde', 'salida_tarde','users_horarios.tipo','users_horarios.user_id','users_horarios.horario_id');
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $builder = $this->db->table($this->table)->select('horarios.*');
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
    // get data by user_id and tipo
    function get_actual($user_id,$tipo)
    {
        $builder = $this->db->table('users_horarios');
        $builder->where('user_id', $user_id);
        $builder->where('tipo', $tipo);
        $builder->orderBy('id','DESC');
        $builder->limit(1);
        return $builder->get()->getRow();
    }

    // get total rows
    function total_rows($q = NULL, $tab = NULL, $filter = array())
    {
        $builder = $this->db->table($this->table)->select('horarios.*');

        if (count($filter) == 2) {
            $builder->where('horarios.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();
            $builder->groupEnd();
        }
        return $builder->countAllResults();
    }
    function asignar_horario($user_id, $horario_id, $tipo)
    {
        $builder = $this->db->table('users_horarios');
        $builder->insert(['user_id' => $user_id, 'horario_id' => $horario_id, 'tipo' => $tipo]);
    }
    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $tab = NULL, $oc = '', $od = '', $filter = array())
    {
        $builder = $this->db->table($this->table)->select('horarios.*');


        if (count($filter) == 2) {
            $builder->where('horarios.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();
            $builder->groupEnd();
        }

        if ($oc != '') {
            $builder->orderBy($oc, $od);
        } else
            $builder->orderBy('id', 'asc');
        $builder->limit($limit, $start);
        return $builder->get()->getResult();
    }
}
