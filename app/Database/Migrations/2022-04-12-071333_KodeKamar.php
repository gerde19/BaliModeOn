<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KodeKamar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kh_id'         => [
                'type'          => 'BIGINT',
                'constraint'    => 111,
                'unsigned'      => true,
                'auto_increment' =>  true,
            ],
            'kh_kode'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ]
        ]);
        $this->forge->addKey('kh_id', true);
        $this->forge->createTable('kode_kamar');
    }

    public function down()
    {
        $this->forge->dropTable('kode_kamar');
    }
}
