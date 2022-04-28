<?php

namespace App\Controllers;

use App\Models\TabelData;
use CodeIgniter\Validation\Rules;

class Customer extends BaseController
{
    protected $TabelData;
    public function __construct()
    {
        helper('form');
    }

    public function customer()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            $model  = new TabelData();
            $data = [
                'customer' => $model->getCustomer()
            ];
            return view('bmo/customer/index', $data);
        }
    }

    public function customerAdd()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            $date = date('Y-m-d');
            $pass = password_hash($this->request->getPost('cus_password'), PASSWORD_BCRYPT);
            $data = [
                'cus_nama' => $this->request->getPost('cus_nama'),
                'cus_email' => $this->request->getPost('cus_email'),
                'cus_password' => $pass,
                'cus_alamat' => $this->request->getPost('cus_alamat'),
                'cus_kota' => $this->request->getPost('cus_kota'),
                'cus_provinsi' => $this->request->getPost('cus_provinsi'),
                'cus_negara' => $this->request->getPost('cus_negara'),
                'cus_date' => $date,
            ];

            $this->db->table('customer')->insert($data);
            return redirect()->to(site_url('customer'))->with('success', 'Data Berhasil Disimpan!');
        }
    }

    public function customerEdit()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            $id = $this->request->getPost('cus_id');
            $query = $this->db->table('customer')->getWhere(['cus_id' => $id]);
            $ambil = $query->getRow();
            if (session()->get('user_level') <> "admin") {
                return redirect()->to(site_url('home'));
            } else {
                $id = $this->request->getPost('cus_id');
                if ($this->request->getPost('cus_password') == "") {
                    $data = [
                        'cus_nama' => $this->request->getPost('cus_nama'),
                        'cus_email' => $this->request->getPost('cus_email'),
                        'cus_alamat' => $this->request->getPost('cus_alamat'),
                        'cus_kota' => $this->request->getPost('cus_kota'),
                        'cus_provinsi' => $this->request->getPost('cus_provinsi'),
                        'cus_negara' => $this->request->getPost('cus_negara'),
                        'cus_date' => $this->request->getPost('cus_date'),
                    ];
                    $this->db->table('customer')->where(['cus_id' => $id])->update($data);
                    return redirect()->to(site_url('customer'))->with('success', 'Data Berhasil Dirubah!');
                } else {
                    $pass = password_hash($this->request->getPost('cus_password'), PASSWORD_BCRYPT);
                    $data = [
                        'cus_nama' => $this->request->getPost('cus_nama'),
                        'cus_email' => $this->request->getPost('cus_email'),
                        'cus_password' => $pass,
                        'cus_alamat' => $this->request->getPost('cus_alamat'),
                        'cus_kota' => $this->request->getPost('cus_kota'),
                        'cus_provinsi' => $this->request->getPost('cus_provinsi'),
                        'cus_negara' => $this->request->getPost('cus_negara'),
                        'cus_date' => $this->request->getPost('cus_date'),
                    ];
                    $this->db->table('customer')->where(['cus_id' => $id])->update($data);
                    return redirect()->to(site_url('customer'))->with('success', 'Data Berhasil Dirubah!');
                }
            }
        }
    }

    public function customerDel()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            $id = $this->request->getPost('cus_id');
            $this->db->table('customer')->where(['cus_id' => $id])->delete();
            return redirect()->to(site_url('customer'))->with('success', 'Data Berhasil Dihapus!');
        }
    }
}
