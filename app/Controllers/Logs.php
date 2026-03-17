<?php

namespace App\Controllers;

class Logs extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Security Logs',
        ];
        return view('logs/index', $data);
    }
}
