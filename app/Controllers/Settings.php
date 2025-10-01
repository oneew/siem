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

        try {
            foreach ($this->request->getPost() as $key => $value) {
                // Check if setting exists
                $setting = $model->where('key', $key)->first();

                if ($setting) {
                    // Update existing setting
                    $model->where('key', $key)->set(['value' => $value])->update();
                } else {
                    // Create new setting if it doesn't exist
                    $model->insert(['key' => $key, 'value' => $value]);
                }
            }

            return redirect()->to('/settings')->with('success', 'Pengaturan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->to('/settings')->with('error', 'Gagal memperbarui pengaturan: ' . $e->getMessage());
        }
    }
}
