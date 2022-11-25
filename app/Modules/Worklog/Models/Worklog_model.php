<?php

namespace App\Modules\Worklog\Models;

use CodeIgniter\Model;


class Worklog_model extends Model
{

    public $table = 'worklog';
    public $id = 'worklog_id';
    public $allowedFields = array('ion_users.first_name','tareas.titulo','tarea_id', 'usuario_id', 'fechainicio', 'fechacierre', 'comentario');
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    // get diference between fechacierre and fechainicio for a worklog by tarea_id
    function calculahoras($tarea_id)
    {
        $builder = $this->db->table($this->table)->select('SEC_TO_TIME(SUM(TIME_TO_SEC(fechacierre) - TIME_TO_SEC(fechainicio))) AS diferencia');
        $builder->where('tarea_id', $tarea_id);
        $builder->groupBy($tarea_id);
        return $builder->get()->getRow();
    } 
    // get all
    function get_all()
    {
        $builder = $this->db->table($this->table)->select('worklog.tarea_id,worklog.usuario_id,worklog.fechainicio,worklog.fechacierre,worklog.comentario,worklog.worklog_id');
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
        $builder = $this->db->table($this->table)->select('worklog.tarea_id,worklog.usuario_id,worklog.fechainicio,worklog.fechacierre,worklog.comentario,worklog.worklog_id');

        if (count($filter) == 2) {
            $builder->where('worklog.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();
            $builder->like('worklog_id', $q);
            $builder->orLike('worklog.tarea_id', $q);
            $builder->orLike('worklog.usuario_id', $q);
            $builder->orLike('worklog.fechainicio', $q);
            $builder->orLike('worklog.fechacierre', $q);
            $builder->orLike('worklog.comentario', $q);
            $builder->groupEnd();
        }
        return $builder->countAllResults();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $tab = NULL, $oc = '', $od = '', $filter = array())
    {
        $builder = $this->db->table($this->table)->select('ion_users.first_name AS nombre,tareas.titulo AS titulo,worklog.tarea_id,worklog.usuario_id,worklog.fechainicio,worklog.fechacierre,worklog.comentario,worklog.worklog_id');
        $builder->join('ion_users', 'ion_users.id = worklog.usuario_id');
        $builder->join('tareas', 'tareas.tarea_id = worklog.tarea_id');

        if (count($filter) == 2) {
            $builder->where('worklog.' . $filter[0], $filter[1]);
        }
        if (!empty($q)) {
            $builder->groupStart();

            $builder->like('worklog.worklog_id', $q);
            $builder->orLike('worklog.tarea_id', $q);
            $builder->orLike('worklog.usuario_id', $q);
            $builder->orLike('worklog.fechainicio', $q);
            $builder->orLike('worklog.fechacierre', $q);
            $builder->orLike('worklog.comentario', $q);
            $builder->groupEnd();
        }

        if ($oc != '') {
            $builder->orderBy($oc, $od);
        } else
            $builder->orderBy('worklog_id', 'asc');
        $builder->limit($limit, $start);
        return $builder->get()->getResult();
    }
}
