<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customer extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'cus_id'         => [
                'type'          => 'INT',
                'constraint'    => 111,
                'unsigned'      => true,
                'auto_increment' =>  true,
            ],
            'cus_nama'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'cus_email'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'cus_password'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'cus_alamat'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'cus_kota'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'cus_provinsi'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'cus_negara'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
        ]);
        $this->forge->addKey('cus_id', true);
        $this->forge->createTable('customer');
    }

    public function down()
    {
        $this->forge->dropTable('customer');
    }
}
