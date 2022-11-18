<?php

namespace App\Modules\Asistencias\Models;

use CodeIgniter\Model;


class Asistencias_model extends Model
{

    public $table = 'asistencias';
    public $id = 'asistencia_id';
    public $allowedFields = array('fechahora', 'asistenciatipo_id', 'usuario_id', 'comentario');
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $builder = $this->db->table($this->table)->select('asistencias.fechahora,asistencias.asistenciatipo_id,asistencias.usuario_id,asistencias.comentario,asistencias.asistencia_id');
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
        $builder = $this->db->table($this->table)->select('asistencias.fechahora,asistencias.asistenciatipo_id,asistencias.usuario_id,asistencias.comentario,asistencias.asistencia_id');

        if (count($filter) == 2) {
            $builder->where('asistencias.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();
            $builder->like('asistencia_id', $q);
            $builder->orLike('asistencias.fechahora', $q);
            $builder->orLike('asistencias.asistenciatipo_id', $q);
            $builder->orLike('asistencias.usuario_id', $q);
            $builder->orLike('asistencias.comentario', $q);
            $builder->groupEnd();
        }
        return $builder->countAllResults();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $tab = NULL, $oc = '', $od = '', $filter = array())
    {
        $builder = $this->db->table($this->table)->select('asistencias.fechahora,asistencias.asistenciatipo_id,asistencias.usuario_id,asistencias.comentario,asistencias.asistencia_id');


        if (count($filter) == 2) {
            $builder->where('asistencias.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();

            $builder->like('asistencias.asistencia_id', $q);
            $builder->orLike('asistencias.fechahora', $q);
            $builder->orLike('asistencias.asistenciatipo_id', $q);
            $builder->orLike('asistencias.usuario_id', $q);
            $builder->orLike('asistencias.comentario', $q);
            $builder->groupEnd();
        }

        if ($oc != '') {
            $builder->orderBy($oc, $od);
        } else
            $builder->orderBy('usuario_id', 'asc');
        $builder->limit($limit, $start);
        return $builder->get()->getResult();
    }
}
