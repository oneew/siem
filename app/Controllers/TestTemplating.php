<?php

namespace App\Controllers;

class TestTemplating extends BaseController
{
    public function index()
    {
        $data['title'] = 'Templating System Test';
        return view('test_templating', $data);
    }
}