<?php

namespace App\Models;

use CodeIgniter\Model;

class M_aksesgrup extends Model
{
    protected $table = 'auth_groups_permissions';
    protected $primaryKey = 'group_id'; // Update primary key to 'user_id'
    protected $allowedFields = ['group_id', 'permission_id'];

   

    public function getGrupPermissions()
    {
        // Join with auth_permissions table to get permission names
        $this->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id');
        $this->join('auth_groups', 'auth_groups.id = auth_groups_permissions.group_id');
        $this->groupBy('auth_groups.id');

        $this->select("
        auth_groups.id as id_grup, 
        auth_groups.name as grup, 
        auth_groups.description as ket_grup, 
        GROUP_CONCAT(auth_permissions.id SEPARATOR ',') AS id_akses,
        GROUP_CONCAT(auth_permissions.name SEPARATOR ',') AS akses,
        GROUP_CONCAT(auth_permissions.description SEPARATOR ',') AS ket_akses
        ");
        return $this->findAll();
    }
}
