<?php

namespace App\Controllers;

class Jamming extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Jamming Monitoring',
        ];
        return view('jamming/index', $data);
    }
}
