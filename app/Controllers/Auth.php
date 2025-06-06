<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function doLogin()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'username' => $user['username'],
                'role' => $user['role'],
                'logged_in' => true
            ]);

            // Redirect berdasarkan role
            return redirect()->to('/dashboard/' . $user['role']);
        }

        session()->setFlashdata('error', 'Login gagal');
        return redirect()->back();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
