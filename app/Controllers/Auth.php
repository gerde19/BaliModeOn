<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
    }

    public function login()
    {
        if (session('user_id')) {
            return redirect()->to(site_url('home'));
        }
        return view('bmo/auth/index');
    }

    public function loginProcess()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('anggota')->getWhere(['user_email' => $post['email']]);
        $user = $query->getRow();
        if ($user) {
            if (password_verify($post['password'], $user->user_password)) {
                $params = [
                    'user_id' => $user->user_id,
                    'user_level' => $user->user_level,
                    'user_foto' => $user->user_foto,
                    'user_nama' => $user->user_nama
                ];
                if ($user->user_status == "active") {
                    session()->set($params);
                    return redirect()->to(site_url('home'));
                } else {
                    return redirect()->back()->with('error', 'Maaf Anda Tidak Boleh Login!');
                }
            } else {
                return redirect()->back()->with('error', 'Password Salah!');
            }
        } else {
            return redirect()->back()->with('error', 'Email Tidak Ditemukan!');
        }
    }

    public function logout()
    {
        session()->remove('user_id');
        return redirect()->to(site_url('login'));
    }
}
