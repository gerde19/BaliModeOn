<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Anggota extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'         => [
                'type'          => 'INT',
                'constraint'    => 111,
                'unsigned'      => true,
                'auto_increment' =>  true,
            ],
            'user_nama'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'user_email'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'user_password'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'user_foto'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 100
            ],
            'user_level'       => [
                'type'          => 'ENUM',
                'constraint'    => 'admin', 'manajemen'
            ],
            'user_status'       => [
                'type'          => 'ENUM',
                'constraint'    => 'active', 'disable'
            ],
            'user_date'       => [
                'type'          => 'DATE'
            ]
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('anggota');
    }

    public function down()
    {
        $this->forge->dropTable('anggota');
    }
}
