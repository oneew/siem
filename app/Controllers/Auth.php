<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        helper(['form']);
        return view('auth/login', ['title' => 'Login']);
    }

    public function attemptLogin()
    {
        $session = session();
        $model = new \App\Models\UserModel();
        
        $username = trim($this->request->getPost('username'));
        $password = $this->request->getPost('password');
        
        // Validation
        if (empty($username) || empty($password)) {
            return redirect()->back()->with('error', 'Username dan password harus diisi!');
        }
        
        // Get user from database
        $user = $model->where('username', $username)->first();
        
        if (!$user) {
            return redirect()->back()->with('error', 'Username atau password salah!');
        }
        
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Username atau password salah!');
        }
        
        // Login successful
        $session->set([
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'role'      => $user['role'],
            'logged_in' => true
        ]);
        
        return redirect()->to('/dashboard')->with('success', 'Login berhasil!');
    }
    

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
    public function changePassword()
{
    helper(['form']);
    return view('auth/change_password', ['title' => 'Ganti Password']);
}

public function updatePassword()
{
    $session = session();
    $model = new \App\Models\UserModel();

    $oldPassword = $this->request->getPost('old_password');
    $newPassword = $this->request->getPost('new_password');
    $confirmPassword = $this->request->getPost('confirm_password');

    $user = $model->find($session->get('user_id'));

    if (!$user || !password_verify($oldPassword, $user['password'])) {
        return redirect()->back()->with('error', 'Password lama salah!');
    }

    if ($newPassword !== $confirmPassword) {
        return redirect()->back()->with('error', 'Konfirmasi password tidak cocok!');
    }

    $model->update($user['id'], [
        'password' => password_hash($newPassword, PASSWORD_BCRYPT),
    ]);

    return redirect()->to('/dashboard')->with('success', 'Password berhasil diganti!');
}

}
