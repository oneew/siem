<?php

namespace App\Controllers;

use App\Models\SettingModel;

class Settings extends BaseController
{
    public function index()
    {
        $model = new SettingModel();
        $data['title'] = 'Pengaturan';
        $data['settings'] = $model->findAll();
        return view('setting/index', $data);
    }

    public function update()
    {
        $model = new SettingModel();
        foreach ($this->request->getPost() as $key => $value) {
            $model->where('key', $key)->set(['value' => $value])->update();
        }
        return redirect()->to('/settings');
    }
}
