<?php

namespace App\Controllers;

class TestTemplate extends BaseController
{
    public function index()
    {
        $data['title'] = 'Template Test';
        return view('test_template', $data);
    }
}