<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = array(
            'button' => 'Añadir',
            'fun' => 'create',
            'action' => site_url('asistencias/fichar_action') . ($this->request->getGet('from') ? ('/' . urlencode($this->request->getGet('from'))) : ''),
            'from' => $this->request->getGet('from') ? $this->request->getGet('from') : NULL,
            'data_fields' => array(
                'asistencia_id' => "",
                'fechahora' => "",
                'fechahora_timestamp' => "",
                'asistenciatipo_id' => "",
                'usuario_id' => "",
                'comentario' => ""
            ),
            'main' => 'App\Modules\Asistencias\Views\asistencias_form'
            );
        return view('template', $data);
    }

}
