<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['title'] = 'User Management';
        $data['users'] = $model->findAll();
        return view('users/index', $data);
    }

    public function show($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User not found!');
        }

        $data['title'] = 'User Details';
        $data['user'] = $user;
        return view('users/show', $data);
    }

    public function create()
    {
        $data['title'] = 'Add User';
        return view('users/create', $data);
    }

    public function store()
    {
        helper(['form']);

        // Validation rules
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'role' => 'required|in_list[Admin,Analyst,Operator]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $data = $this->request->getPost();
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        if ($model->insert($data)) {
            return redirect()->to('/users')->with('success', 'User created successfully!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to create user. Please try again.');
        }
    }

    public function edit($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User not found!');
        }

        $data['title'] = 'Edit User';
        $data['user'] = $user;
        return view('users/edit', $data);
    }

    // Updated to match the new route: /users/(:num) with POST method and _method=PUT
    public function update($id)
    {
        helper(['form']);

        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User not found!');
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
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,' . $id . ']',
            'role' => 'required|in_list[Admin,Analyst,Operator]',
        ];

        // Only require password if it's being changed
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $rules['password'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();

        // Only update password if provided
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }

        // Add profile picture to data if uploaded
        if ($profilePicture) {
            $data['profile_picture'] = $profilePicture;
        }

        if ($model->update($id, $data)) {
            return redirect()->to('/users')->with('success', 'User updated successfully!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update user. Please try again.');
        }
    }

    // Updated to match the new route: /users/delete/(:num) with GET method
    public function delete($id)
    {
        // Prevent deleting the current user
        if ($id == session()->get('user_id')) {
            return redirect()->to('/users')->with('error', 'You cannot delete your own account!');
        }

        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User not found!');
        }

        if ($model->delete($id)) {
            return redirect()->to('/users')->with('success', 'User deleted successfully!');
        } else {
            return redirect()->to('/users')->with('error', 'Failed to delete user. Please try again.');
        }
    }

    public function resetPassword($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User not found!');
        }

        // Reset to default
        $defaultPassword = 'password123';
        if ($model->update($id, [
            'password' => password_hash($defaultPassword, PASSWORD_BCRYPT)
        ])) {
            return redirect()->to('/users')->with('success', 'User password reset successfully to: ' . $defaultPassword);
        } else {
            return redirect()->to('/users')->with('error', 'Failed to reset user password. Please try again.');
        }
    }

    // Profile picture upload functionality
    public function uploadProfilePicture($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User not found!');
        }

        // Handle profile picture upload
        if ($this->request->getFile('profile_picture') && $this->request->getFile('profile_picture')->isValid()) {
            $file = $this->request->getFile('profile_picture');

            // Validate file type and size
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                return redirect()->to('/users/edit/' . $id)->with('error', 'Invalid file type. Only JPG, PNG, and GIF files are allowed.');
            }

            if ($file->getSize() > 2097152) { // 2MB
                return redirect()->to('/users/edit/' . $id)->with('error', 'File size too large. Maximum allowed size is 2MB.');
            }

            $fileName = $user['id'] . '_profile_' . time() . '.' . $file->getExtension();
            $file->move(ROOTPATH . 'public/uploads/profile_pictures', $fileName);

            // Update user record with profile picture path
            if ($model->update($id, ['profile_picture' => $fileName])) {
                return redirect()->to('/users/edit/' . $id)->with('success', 'Profile picture uploaded successfully!');
            } else {
                return redirect()->to('/users/edit/' . $id)->with('error', 'Failed to update profile picture. Please try again.');
            }
        } else {
            return redirect()->to('/users/edit/' . $id)->with('error', 'No valid file uploaded.');
        }
    }
}
