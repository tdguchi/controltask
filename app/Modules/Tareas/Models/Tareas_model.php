<?php

namespace App\Modules\Tareas\Models;

use CodeIgniter\Model;


class Tareas_model extends Model
{

    public $table = 'tareas';
    public $id = 'tarea_id';
    public $allowedFields = array('proyecto_titulo','proyecto_id', 'usuario_id','fechahoracreacion', 'usuariosadicionales', 'titulo', 'descripcion', 'fechaobjetivo', 'fechaestimada', 'horasestimadas', 'fechacomienzo', 'fecharealcierre', 'horasreales');
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all($usuario_id = null)
    {
        $builder = $this->db->table($this->table)->select('proyectos.titulo AS proyecto_titulo,tareas.proyecto_id,tareas.usuario_id,tareas.usuariosadicionales,tareas.titulo,tareas.descripcion,tareas.fechahoracreacion,tareas.fechaobjetivo,tareas.fechaestimada,tareas.horasestimadas,tareas.fechacomienzo,tareas.fecharealcierre,tareas.horasreales,tareas.estado,tareas.tarea_id');
        $builder->orderBy($this->id, $this->order);
        $builder->join('proyectos', 'proyectos.proyecto_id = tareas.proyecto_id', 'left');
        if ($usuario_id != null) {
            $builder->where('tareas.usuario_id', $usuario_id);
        }
        return $builder->get()->getResult();
    }

    // get data by id
    function get_by_id($id)
    {
        $builder = $this->db->table($this->table)->select('ion_users.first_name AS operador,proyectos.titulo AS proyecto_titulo,tareas.proyecto_id,tareas.usuario_id,tareas.usuariosadicionales,tareas.titulo,tareas.descripcion,tareas.fechahoracreacion,tareas.fechaobjetivo,tareas.fechaestimada,tareas.horasestimadas,tareas.fechacomienzo,tareas.fecharealcierre,tareas.horasreales,tareas.estado,tareas.tarea_id');
        $builder->join('proyectos', 'proyectos.proyecto_id = tareas.proyecto_id', 'left');
        $builder->join('ion_users', 'ion_users.id = tareas.usuario_id', 'left');
        $builder->where($this->id, $id);
        return $builder->get()->getRow();
    }

    // get total rows
    function total_rows($q = NULL, $tab = NULL, $filter = array(), $usuario_id = null)
    {
        $builder = $this->db->table($this->table)->select('tareas.proyecto_id,tareas.titulo,tareas.descripcion,tareas.fechaobjetivo,tareas.fechaestimada,tareas.horasestimadas,tareas.fechacomienzo,tareas.fecharealcierre,tareas.horasreales,tareas.estado,tareas.tarea_id');
        if (count($filter) == 2) {
            $builder->where('tareas.' . $filter[0], $filter[1]);
        }
        if ($usuario_id != null) {
            $builder->where('tareas.usuario_id', $usuario_id);
        }
        if (!empty($q)) {
            $builder->groupStart();
            $builder->like('tarea_id', $q);
            $builder->orLike('tareas.proyecto_id', $q);
            $builder->orLike('tareas.titulo', $q);
            $builder->orLike('tareas.descripcion', $q);
            $builder->orLike('tareas.fechaobjetivo', $q);
            $builder->orLike('tareas.fechaestimada', $q);
            $builder->orLike('tareas.horasestimadas', $q);
            $builder->orLike('tareas.fechacomienzo', $q);
            $builder->orLike('tareas.fecharealcierre', $q);
            $builder->orLike('tareas.horasreales', $q);
            $builder->orLike('tareas.estado', $q);
            $builder->groupEnd();
        }
        return $builder->countAllResults();
    }
    // get froup id based on user id
    function get_group_id($id)
    {
        $builder = $this->db->table('ion_users_groups')->select('group_id');
        $builder->where('user_id', $id);
        return $builder->get()->getResult();
    }
    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $tab = NULL, $oc = '', $od = '', $filter = array(), $usuario_id = null)
    {
        $builder = $this->db->table($this->table)->select('ion_users.first_name AS operador,proyectos.titulo AS proyecto_titulo,tareas.proyecto_id,tareas.titulo,tareas.descripcion,tareas.fechaobjetivo,tareas.fechaestimada,tareas.horasestimadas,tareas.fechacomienzo,tareas.fecharealcierre,tareas.horasreales,tareas.estado,tareas.tarea_id');
        $builder->join('proyectos', 'proyectos.proyecto_id = tareas.proyecto_id', 'left');
        $builder->join('ion_users', 'ion_users.id = tareas.usuario_id', 'left');


        if (count($filter) == 2) {
            $builder->where('tareas.' . $filter[0], $filter[1]);
        }
        if ($usuario_id != null) {
            $builder->where('tareas.usuario_id' , $usuario_id);
        }
        if (!empty($q)) {
            $builder->groupStart();

            $builder->like('tareas.tarea_id', $q);
            $builder->orLike('tareas.proyecto_id', $q);
            $builder->orLike('tareas.titulo', $q);
            $builder->orLike('tareas.descripcion', $q);
            $builder->orLike('tareas.fechaobjetivo', $q);
            $builder->orLike('tareas.fechaestimada', $q);
            $builder->orLike('tareas.horasestimadas', $q);
            $builder->orLike('tareas.fechacomienzo', $q);
            $builder->orLike('tareas.fecharealcierre', $q);
            $builder->orLike('tareas.horasreales', $q);
            $builder->orLike('tareas.estado', $q);
            $builder->groupEnd();
        }

        if ($oc != '') {
            $builder->orderBy($oc, $od);
        } else
            $builder->orderBy('tarea_id', 'asc');
        $builder->limit($limit, $start);
        return $builder->get()->getResult();
    }
}
