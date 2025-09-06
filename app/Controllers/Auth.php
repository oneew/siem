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
            return redirect()->back()->with('error', 'Username and password must be filled!');
        }
        
        // Get user from database
        $user = $model->where('username', $username)->first();
        
        if (!$user) {
            return redirect()->back()->with('error', 'Username or password is incorrect!');
        }
        
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Username or password is incorrect!');
        }
        
        // Login successful
        $session->set([
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'role'      => $user['role'],
            'logged_in' => true
        ]);
        
        return redirect()->to('/dashboard')->with('success', 'Login successful!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
    
    public function profile()
    {
        $session = session();
        $model = new UserModel();
        
        $user = $model->find($session->get('user_id'));
        
        if (!$user) {
            return redirect()->to('/login')->with('error', 'User not found!');
        }
        
        $data['title'] = 'User Profile';
        $data['user'] = $user;
        return view('auth/profile', $data);
    }
    
    public function updateProfile()
    {
        helper(['form']);
        
        $session = session();
        $model = new UserModel();
        
        $user = $model->find($session->get('user_id'));
        
        if (!$user) {
            return redirect()->to('/login')->with('error', 'User not found!');
        }
        
        // Handle profile picture upload
        $profilePicture = null;
        if ($this->request->getFile('profile_picture') && $this->request->getFile('profile_picture')->isValid()) {
            $file = $this->request->getFile('profile_picture');
            
            // Validate file type and size
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                return redirect()->back()->withInput()->with('error', 'Invalid file type. Only JPG, PNG, and GIF files are allowed.');
            }
            
            if ($file->getSize() > 2097152) { // 2MB
                return redirect()->back()->withInput()->with('error', 'File size too large. Maximum allowed size is 2MB.');
            }
            
            $fileName = $user['id'] . '_profile_' . time() . '.' . $file->getExtension();
            $file->move(ROOTPATH . 'public/uploads/profile_pictures', $fileName);
            $profilePicture = $fileName;
        }
        
        // Validation rules
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,'.$user['id'].']',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'username' => $this->request->getPost('username'),
        ];
        
        // Add profile picture to data if uploaded
        if ($profilePicture) {
            $data['profile_picture'] = $profilePicture;
        }
        
        if ($model->update($user['id'], $data)) {
            // Update session data
            $session->set('username', $data['username']);
            
            return redirect()->back()->with('success', 'Profile updated successfully!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update profile. Please try again.');
        }
    }

    public function changePassword()
    {
        helper(['form']);
        
        $session = session();
        $model = new UserModel();

        $oldPassword = $this->request->getPost('old_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $user = $model->find($session->get('user_id'));

        if (!$user || !password_verify($oldPassword, $user['password'])) {
            return redirect()->back()->withInput()->with('password_error', 'Old password is incorrect!');
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->withInput()->with('password_error', 'New password confirmation does not match!');
        }
        
        // Validation rules for new password
        $rules = [
            'new_password' => 'required|min_length[6]',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('password_errors', $this->validator->getErrors());
        }

        if ($model->update($user['id'], [
            'password' => password_hash($newPassword, PASSWORD_BCRYPT),
        ])) {
            return redirect()->back()->with('password_success', 'Password changed successfully!');
        } else {
            return redirect()->back()->withInput()->with('password_error', 'Failed to change password. Please try again.');
        }
    }
}