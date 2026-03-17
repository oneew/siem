<?php

namespace App\Controllers;

class Signatures extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Tanda Tangan Digital',
        ];
        return view('signatures/index', $data);
    }
}
