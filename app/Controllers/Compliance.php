<?php

namespace App\Controllers;

class Compliance extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Compliance',
        ];
        return view('compliance/index', $data);
    }
}
