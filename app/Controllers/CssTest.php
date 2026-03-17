<?php

namespace App\Controllers;

class CssTest extends BaseController
{
    public function index()
    {
        $data['title'] = 'CSS Test Page';
        return view('css_test', $data);
    }
}