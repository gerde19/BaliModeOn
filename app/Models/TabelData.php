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
            ->join('tujuan_kapal', 'tujuan_kapal.tk_kode=detail_kapal.dk_tujuan')
            ->get()->getResultArray();
    }

    public function getTujuanKapal()
    {
        return $this->db->table('tujuan_kapal')
            ->orderBy("tk_kode ASC")
            ->get()->getResultArray();
    }

    public function kodeTujuanKapal()
    {
        $query = $this->db->query("SELECT MAX(tk_kode) as tk_kode from tujuan_kapal");
        $hasil = $query->getRow();
        return $hasil->tk_kode;
    }

    public function detailKapalRow() // Menghitung jumlah total data pada tabel
    {
        $detailKapal = $this->db->table('detail_kapal');
        if ($detailKapal->countAll() > 0) {
            return $detailKapal->countAll();
        } else {
            return 0;
        }
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
            ->join('detail_kapal', 'detail_kapal.dk_id=transaksi_kapal.transaksi_kode_kapal')
            ->join('tujuan_kapal', 'tujuan_kapal.tk_kode=transaksi_kapal.transaksi_tujuan')
            ->where("transaksi_status_kapal!='Kembali'")
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
