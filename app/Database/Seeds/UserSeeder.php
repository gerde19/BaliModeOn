<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $date = date('Y-m-d');
        $data = [
            [
                'user_nama' => 'Gerde Aditya',
                'user_email' => 'gerde.aditya@gmail.com',
                'user_password' => password_hash('klaten19', PASSWORD_BCRYPT),
                'user_foto' => 'mr fredickson',
                'user_level' => 'admin',
                'user_status' => 'active',
                'user_date' => $date
            ],
            [
                'user_nama' => 'Arsen Sarfaraz',
                'user_email' => 'arsen.sarfarz@gmail.com',
                'user_password' => password_hash('gerde19', PASSWORD_BCRYPT),
                'user_foto' => 'russell up',
                'user_level' => 'manajemen',
                'user_status' => 'active',
                'user_date' => $date
            ]
        ];
        $this->db->table('anggota')->insertBatch($data);
    }
}
