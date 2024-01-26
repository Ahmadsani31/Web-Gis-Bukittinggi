<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MAuth;

class Auth extends BaseController
{
    public function index()
    {
        return view('v_singin');
    }

    public function login()
    {

        $session = session();
        $userModel = new MAuth();
        $email = $this->request->getPost('Username');
        $password = $this->request->getPost('Password');

        $data = $userModel->where('Username', $email)->first();

        if ($data) {
            $pass = $data['Password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    's_UserID' => $data['AdminID'],
                    's_Nama' => $data['Nama'],
                    's_Level' => $data['Level'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/admin/dashboard');
            } else {
                $session->setFlashdata('msg', 'Password salah.');
                return redirect()->to('/signin');
            }
        } else {
            $session->setFlashdata('msg', 'username tidak terdaftar.');
            return redirect()->to('/signin');
        }
    }

    public function logout()
    {
        session_destroy();
        return redirect()->to('/');
    }
}
