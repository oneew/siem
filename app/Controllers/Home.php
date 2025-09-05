<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('auth/login');
    }
    
    // public function demoInfo(): string
    // {
    //     return view('demo_info');
    // }
}
