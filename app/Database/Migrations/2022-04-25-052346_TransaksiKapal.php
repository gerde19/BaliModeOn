<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransaksiKapal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'transaksi_id'         => [
                'type'          => 'INT',
                'constraint'    => 111,
                'unsigned'      => true,
                'auto_increment' =>  true,
            ],
            'customer'       => [
                'type'          => 'INT',
                'constraint'    => 111
            ],
            'nama'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'tgl_booking'       => [
                'type'          => 'DATE'
            ],
            'tgl_selesai'       => [
                'type'          => 'DATE'
            ],
            'tujuan'       => [
                'type'          => 'INT',
                'constraint'    => 111
            ],
            'harga_booking'       => [
                'type'          => 'DECIMAL',
                'constraint'    => 65, 2
            ],
            'harga_perjam'       => [
                'type'          => 'DECIMAL',
                'constraint'    => 65, 2
            ],
            'harga_dp'       => [
                'type'          => 'DECIMAL',
                'constraint'    => 65, 2
            ],
            'harga_bayar'       => [
                'type'          => 'DECIMAL',
                'constraint'    => 65, 2
            ],
            'harga_bank'       => [
                'type'          => 'INT',
                'constraint'    => 111
            ],
            'status_kapal'       => [
                'type'          => 'ENUM',
                'constraint'    => 'Berlayar', 'Kembali', 'Ready'
            ],
            'status_pembayaran'       => [
                'type'          => 'ENUM',
                'constraint'    => 'DP', 'Lunas', 'Belum'
            ],
        ]);
        $this->forge->addKey('transaksi_id', true);
        $this->forge->createTable('transaksi_kapal');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_kapal');
    }
}
