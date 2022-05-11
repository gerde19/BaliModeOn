<?php

namespace App\Controllers;

use App\Models\UserData;
use CodeIgniter\Validation\Rules;
use DateTime;

class User extends BaseController
{
    public function index()
    {
        $model  = new UserData();
        $data = [
            'detailKapal' => $model->getDetailKapal()
        ];
        return view('user/index', $data);
    }

    public function booking()
    {
        return view('user/booking/index');
    }
}
