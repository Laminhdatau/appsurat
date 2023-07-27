<?php

namespace App\Controllers;

use App\Models\M_pegawai;
use App\Models\M_userpegawai;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['title'] = "Dashboard";

        return view('dashboard', $data);
    }
}
