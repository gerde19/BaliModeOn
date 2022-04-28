<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KodeMobil extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'km_id'         => [
                'type'          => 'BIGINT',
                'constraint'    => 111,
                'unsigned'      => true,
                'auto_increment' =>  true,
            ],
            'km_kode'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ]
        ]);
        $this->forge->addKey('km_id', true);
        $this->forge->createTable('kode_mobil');
    }

    public function down()
    {
        $this->forge->dropTable('kode_mobil');
    }
}
