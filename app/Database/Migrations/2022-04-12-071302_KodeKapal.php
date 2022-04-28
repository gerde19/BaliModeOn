<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KodeKapal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kk_id'         => [
                'type'          => 'BIGINT',
                'constraint'    => 111,
                'unsigned'      => true,
                'auto_increment' =>  true,
            ],
            'kk_kode'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ]
        ]);
        $this->forge->addKey('kk_id', true);
        $this->forge->createTable('kode_kapal');
    }

    public function down()
    {
        $this->forge->dropTable('kode_kapal');
    }
}
