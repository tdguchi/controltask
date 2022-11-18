<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = array(
            'main' => 'homepage',
            'title' => 'Controltask'
        );
        return view('template', $data);
    }
}
