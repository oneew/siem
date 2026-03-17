<?php

namespace App\Controllers;

class MasterData extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Master',
        ];
        return view('master_data/index', $data);
    }
}
