<?php

namespace App\Controllers;

class Analytics extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Analytics',
        ];
        return view('analytics/index', $data);
    }
}
