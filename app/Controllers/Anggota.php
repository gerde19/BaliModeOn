<?php

namespace App\Controllers;

use App\Models\TabelData;
use CodeIgniter\Validation\Rules;

class Anggota extends BaseController
{
    protected $TabelData;
    public function __construct()
    {
        helper('form');
    }

    public function anggota()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            $model  = new TabelData();
            $data = [
                'anggota' => $model->getAnggota()
            ];
            return view('bmo/anggota/index', $data);
        }
    }

    public function anggotaAdd()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            $file_gambar = $this->request->getFile('user_foto');
            $file_gambar->move(ROOTPATH . 'public/img/');
            $date = date('Y-m-d');
            $pass = password_hash($this->request->getPost('user_password'), PASSWORD_BCRYPT);
            $data = [
                'user_nama' => $this->request->getPost('user_nama'),
                'user_email' => $this->request->getPost('user_email'),
                'user_password' => $pass,
                'user_level' => $this->request->getPost('user_level'),
                'user_status' => $this->request->getPost('user_status'),
                'user_date' => $date,
                'user_foto' => $file_gambar->getName(),
            ];

            $this->db->table('anggota')->insert($data);
            return redirect()->to(site_url('anggota'))->with('success', 'Data Berhasil Disimpan!');
        }
    }

    public function anggotaEdit()
    {
        $id = $this->request->getPost('user_id');
        $query = $this->db->table('anggota')->getWhere(['user_id' => $id]);
        $ambil = $query->getRow();
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            $id = $this->request->getPost('user_id');
            if ($this->request->getFile('user_foto')->getName() == "" && $this->request->getPost('user_password') == "") {
                $data = [
                    'user_nama' => $this->request->getPost('user_nama'),
                    'user_email' => $this->request->getPost('user_email'),
                    'user_level' => $this->request->getPost('user_level'),
                    'user_status' => $this->request->getPost('user_status'),
                    'user_date' => $this->request->getPost('user_date'),
                ];
                $this->db->table('anggota')->where(['user_id' => $id])->update($data);
                return redirect()->to(site_url('anggota'))->with('success', 'Data Berhasil Dirubah!');
            } else {
                if ($this->request->getFile('user_foto') == "") {
                    $pass = password_hash($this->request->getPost('user_password'), PASSWORD_BCRYPT);
                    $data = [
                        'user_nama' => $this->request->getPost('user_nama'),
                        'user_email' => $this->request->getPost('user_email'),
                        'user_password' => $pass,
                        'user_level' => $this->request->getPost('user_level'),
                        'user_status' => $this->request->getPost('user_status'),
                        'user_date' => $this->request->getPost('user_date'),
                    ];
                    $this->db->table('anggota')->where(['user_id' => $id])->update($data);
                    return redirect()->to(site_url('anggota'))->with('success', 'Data Berhasil Dirubah!');
                } elseif ($this->request->getPost('user_password') == "") {
                    if ($ambil->user_foto != "") {
                        $target_gambar = '../public/img/' . $ambil->user_foto;
                        unlink($target_gambar);
                    }
                    $file_gambar = $this->request->getFile('user_foto');
                    $file_gambar->move(ROOTPATH . 'public/img/');
                    $data = [
                        'user_nama' => $this->request->getPost('user_nama'),
                        'user_email' => $this->request->getPost('user_email'),
                        'user_level' => $this->request->getPost('user_level'),
                        'user_status' => $this->request->getPost('user_status'),
                        'user_date' => $this->request->getPost('user_date'),
                        'user_foto' => $file_gambar->getName(),
                    ];
                    $this->db->table('anggota')->where(['user_id' => $id])->update($data);
                    return redirect()->to(site_url('anggota'))->with('success', 'Data Berhasil Dirubah!');
                } elseif ($this->request->getFile('user_foto')->getName() != "" && $this->request->getPost('user_password') != "") {
                    if ($ambil->user_foto != "") {
                        $target_gambar = '../public/img/' . $ambil->user_foto;
                        unlink($target_gambar);
                    }
                    $pass = password_hash($this->request->getPost('user_password'), PASSWORD_BCRYPT);
                    $file_gambar = $this->request->getFile('user_foto');
                    $file_gambar->move(ROOTPATH . 'public/img/');
                    $data = [
                        'user_nama' => $this->request->getPost('user_nama'),
                        'user_email' => $this->request->getPost('user_email'),
                        'user_password' => $pass,
                        'user_level' => $this->request->getPost('user_level'),
                        'user_status' => $this->request->getPost('user_status'),
                        'user_date' => $this->request->getPost('user_date'),
                        'user_foto' => $file_gambar->getName(),
                    ];
                    $this->db->table('anggota')->where(['user_id' => $id])->update($data);
                    return redirect()->to(site_url('anggota'))->with('success', 'Data Berhasil Dirubah!');
                }
            }
        }
    }

    public function anggotaDel()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            $id = $this->request->getPost('user_id');
            $query = $this->db->table('anggota')->getWhere(['user_id' => $id]);
            $ambil = $query->getRow();
            $target_gambar = '../public/img/' . $ambil->user_foto;
            unlink($target_gambar);
            $this->db->table('anggota')->where(['user_id' => $id])->delete();
            return redirect()->to(site_url('anggota'))->with('success', 'Data Berhasil Dihapus!');
        }
    }
}
