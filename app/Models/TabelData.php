<?php

namespace App\Models;

use CodeIgniter\Model;

class TabelData extends Model
{
    public function getKodeKapal()
    {
        return $this->db->table('kode_kapal')
            ->orderBy("kk_kode ASC")
            ->get()->getResultArray();
    }

    public function getDetailKapal() // mengambill data didalam tabel detail_kapal
    {
        return $this->db->table('detail_kapal')
            ->join('kode_kapal', 'kode_kapal.kk_id=detail_kapal.dk_kode')
            ->get()->getResultArray();
    }

    public function getAnggota()
    {
        return $this->db->table('anggota')
            ->get()->getResultArray();
    }

    public function getCustomer()
    {
        return $this->db->table('customer')
            ->get()->getResultArray();
    }

    // Booking Awal
    public function getBookingKapal()
    {
        return $this->db->table('transaksi_kapal')
            ->join('detail_kapal', 'detail_kapal.dk_id=transaksi_kapal.nama_kapal')
            ->join('customer', 'customer.cus_id=transaksi_kapal.customer')
            ->where("status_kapal!='Kembali'")
            ->get()->getResultArray();
    }

    public function detailKapal() //Mengambil data di Tabel detail_kapal berdasarkan kriteria Ready
    {
        return $this->db->table('detail_kapal')
            ->get()->getResultArray();
    }
    // Booking Akhir

    // Laporan BOoking Awal
    public function transaksiKapal()
    {
        return $this->db->table('transaksi_kapal')
            ->join('detail_kapal', 'detail_kapal.dk_id=transaksi_kapal.nama_kapal');
    }
    // Laporan BOoking Akhir
}
