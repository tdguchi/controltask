<?php

namespace App\Controllers;

class Home extends BaseController
{
    function __construct()
    {
        $this->ionAuth    = new \IonAuth\Libraries\IonAuth();
        $this->Asistencias_model =  model('\App\Modules\Asistencias\Models\Asistencias_model');
    }

    public function index()
    {
        $user_id = $this->ionAuth->user()->row()->id;
        $data['asistencias'] = $this->Asistencias_model->get_last_asistencia($user_id);
        if (count($data['asistencias']) == 0 || $data['asistencias']->asistenciatipo_id != 0) {
            $data = array(
                'main' => 'homepage',
                'texto_fichar' => 'Fichar entrada'
            );
        } else {
            $data = array(
                'main' => 'homepage',
                'texto_fichar' => 'Fichar salida'
            );
        }
        $data = array(
            'main' => 'homepage',
            'texto_fichar' => 'Ficharno'
        );
        return view('template', $data);
    }

}
