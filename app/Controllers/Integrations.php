<?php

namespace App\Controllers;

class Integrations extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Integrations',
        ];
        return view('integrations/index', $data);
    }
}
