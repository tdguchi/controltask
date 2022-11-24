<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
            $data = array(
                'main' => 'App\Modules\Asistencias\Views\asistencias_form'
            );
        return view('template', $data);
    }

}
