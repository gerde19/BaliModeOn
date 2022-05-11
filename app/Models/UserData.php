<?php

namespace App\Models;

use CodeIgniter\Model;

class UserData extends Model
{
    public function getDetailKapal() // mengambill data didalam tabel detail_kapal
    {
        return $this->db->table('detail_kapal')
            ->join('kode_kapal', 'kode_kapal.kk_id=detail_kapal.dk_kode')
            ->orderBy('dk_id', 'DESC')
            ->limit(3)
            ->get()->getResultArray();
    }
}
