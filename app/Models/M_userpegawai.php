<?php

namespace App\Models;

use CodeIgniter\Model;

class M_userpegawai extends Model
{
    protected $table = 't_user_pegawai';
    protected $allowedFields = ['id_user', 'id_pegawai'];
}
