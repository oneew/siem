<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['title'] = 'Manajemen Pengguna';
        $data['users'] = $model->findAll();
        return view('user/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Pengguna';
        return view('users/create', $data);
    }

    public function store()
    {
        $model = new UserModel();
        $data = $this->request->getPost();
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $model->insert($data);
        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['title'] = 'Edit Pengguna';
        $data['user'] = $model->find($id);
        return view('users/edit', $data);
    }

    public function update($id)
    {
        $model = new UserModel();
        $data = $this->request->getPost();
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }
        $model->update($id, $data);
        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('/users');
    }
    public function resetPassword($id)
{
    $model = new UserModel();
    $user = $model->find($id);

    if (!$user) {
        return redirect()->to('/users')->with('error', 'User tidak ditemukan!');
    }

    // Reset ke default
    $defaultPassword = 'password123';
    $model->update($id, [
        'password' => password_hash($defaultPassword, PASSWORD_BCRYPT)
    ]);

    return redirect()->to('/users')->with('success', 'Password user berhasil direset ke: ' . $defaultPassword);
}

}
