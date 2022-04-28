<?php

namespace App\Controllers;

class Kode extends BaseController
{
    public function kodeKapal()
    {
        $builder    = $this->db->table('kode_kapal');
        $query      = $builder->get()->getResult();
        $data['kode_kapal'] = $query;
        return view('bmo/kodeKapal/index', $data);
    }
}
