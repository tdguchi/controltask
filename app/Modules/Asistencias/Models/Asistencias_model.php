<?php

namespace App\Modules\Asistencias\Models;

use CodeIgniter\Model;


class Asistencias_model extends Model
{

    public $table = 'asistencias';
    public $id = 'asistencia_id';
    public $allowedFields = array('fechahora','fechahora_timestamp', 'asistenciatipo_id', 'usuario_id', 'comentario');
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    function get_last_asistencia($usuario_id, $dia = null)
    {
        $builder = $this->db->table($this->table)->select('asistencias.*');
        $builder->where('usuario_id', $usuario_id);
        if ($dia != null) {
            $builder->like('fechahora', $dia);
        }
        $builder->orderBy('fechahora', 'DESC');
        $builder->limit(1);
        return $builder->get()->GetRow();
    }

    function get_jornada($p = null,  $usuario_id = null) {
        $builder = $this->db->table($this->table)->select('SUM(asistencias.fechahora_timestamp) as total');
        $builder->where('usuario_id', $usuario_id);
        $builder->groupBy('asistencias.asistenciatipo_id');
        if ($p != null) {
            $builder->like('fechahora', $p);
        }
        return $builder->get()->GetResult();
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
    function total_rows($p = NULL, $q = NULL, $tab = NULL, $filter = array(), $usuario_id = null)
    {
        $builder = $this->db->table($this->table)->select('asistencias.fechahora,asistencias.asistenciatipo_id,asistencias.usuario_id,asistencias.comentario,asistencias.asistencia_id');
        if (!empty($p)) {
            $builder->like('asistencias.fechahora', $p);
        }
        if (count($filter) == 2) {
            $builder->where('asistencias.' . $filter[0], $filter[1]);
        }
        if ($usuario_id != null) {
            $builder->where('asistencias.usuario_id', $usuario_id);
        }
        if (empty($p)) {
            $builder->like('asistencias.fechahora', date('Y-m-d'));
        }
        if (!empty($q)) {
            $builder->groupStart();
            $builder->orLike('asistencias.comentario', $q);
            $builder->groupEnd();
        }
        return $builder->countAllResults();
    }

    // get data with limit and search
    function get_limit_data($p = null, $limit, $start = 0, $q = NULL, $tab = NULL, $oc = '', $od = '', $filter = array(), $usuario_id = null)
    {
        $builder = $this->db->table($this->table)->select('asistencias.fechahora,asistencias.asistenciatipo_id,asistencias.usuario_id,asistencias.comentario,asistencias.asistencia_id,asistenciasnombre.nombre AS tipo,ion_users.first_name AS nombre');


        if (count($filter) == 2) {
            $builder->where('asistencias.' . $filter[0], $filter[1]);
        }
        if ($usuario_id != null) {
            $builder->where('asistencias.usuario_id', $usuario_id);
        }
        if (empty($p)) {
            $builder->like('asistencias.fechahora', date('Y-m-d'));
        }
        $builder->join('asistenciasnombre', 'asistenciasnombre.asistenciatipo_id = asistencias.asistenciatipo_id', 'left');
        $builder->join('ion_users', 'ion_users.id = asistencias.usuario_id', 'left');
        if (!empty($p)) {
            $builder->like('asistencias.fechahora', $p);
        }

        if (!empty($q)) {
            $builder->groupStart();
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
