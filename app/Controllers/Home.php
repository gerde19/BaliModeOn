<?php

namespace App\Controllers;

use App\Models\TabelData;

class Home extends BaseController
{
    protected $TabelData;
    public function index()
    {
        $model  = new TabelData();
        $data = [
            'detailKapal' => $model->detailKapalRow()
        ];
        return view('bmo/index', $data);
    }
}
