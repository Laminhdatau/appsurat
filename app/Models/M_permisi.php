<?php

namespace App\Models;

use CodeIgniter\Model;

class M_permisi extends Model
{
    protected $table = 'auth_permissions';
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['id', 'name', 'description'];
}
