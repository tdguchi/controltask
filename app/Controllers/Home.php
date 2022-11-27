<?php

namespace App\Controllers;

class Home extends BaseController
{
    function __construct()
    {
        $this->ionAuth    = new \IonAuth\Libraries\IonAuth();
        $this->Asistencias_model = model('App\Modules\Asistencias\Models\Asistencias_model');
    }

    public function index()
    {
        $user_id = $this->ionAuth->user()->row();
        $ultima = $this->Asistencias_model->get_last_asistencia($user_id->id, date('Y-m-d'));
        if ($ultima == null) {
            $ultima = new \stdClass();
            $ultima->nombre = 'Ninguna';
            $ultima->asistenciatipo_id = 1;
        }
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
            'ultima' => $ultima,
            'main' => 'App\Modules\Asistencias\Views\asistencias_form'
            );
            $data['titulo'] = 'Registrar asistencia';
            $data['subtitulo'] = 'Hola ' . $user_id->first_name . ', hoy es dia ' . date('d/m/Y') . ' y son las ' . date('H:i');
        return view('template', $data);
    }

}
