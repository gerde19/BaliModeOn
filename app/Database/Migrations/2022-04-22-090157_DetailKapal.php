<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailKapal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'dk_id'         => [
                'type'          => 'INT',
                'constraint'    => 111,
                'unsigned'      => true,
                'auto_increment' =>  true,
            ],
            'dk_kode'       => [
                'type'          => 'INT',
                'constraint'    => 111
            ],
            'dk_nama'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'dk_status'       => [
                'type'          => 'ENUM',
                'constraint'    => 'Ready', 'Booked'
            ],
            'dk_kapten'       => [
                'type'          => 'INT',
                'constraint'    => 10
            ],
            'dk_kapasitas'       => [
                'type'          => 'DECIMAL',
                'constraint'    => 65, 2
            ],
            'dk_ac'       => [
                'type'          => 'INT',
                'constraint'    => 10
            ],
            'dk_toilet'       => [
                'type'          => 'INT',
                'constraint'    => 10
            ],
            'dk_ruang'       => [
                'type'          => 'DECIMAL',
                'constraint'    => 65, 2
            ],
            'dk_mesin'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'dk_gambar'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ]
        ]);
        $this->forge->addKey('dk_id', true);
        $this->forge->createTable('detail_kapal');
    }

    public function down()
    {
        $this->forge->dropTable('detail_kapal');
    }
}
