<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard/' . session()->get('role'));
        }
        return view('auth/login');
    }

    public function doLogin()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan email
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
                'logged_in' => true
            ]);

            return redirect()->to('/dashboard/' . $user['role']);
        }

        session()->setFlashdata('error', 'Login gagal. Email atau password salah.');
        return redirect()->back();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}