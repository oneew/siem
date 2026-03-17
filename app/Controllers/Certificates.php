<?php

namespace App\Controllers;

class Certificates extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Sertifikat Elektronik',
        ];
        return view('certificates/index', $data);
    }
}
