<?php

namespace App\Models;

use CodeIgniter\Model;

class M_aksesuser extends Model
{
    protected $table = 'auth_users_permissions';
    protected $primaryKey = 'user_id'; // Update primary key to 'user_id'
    protected $allowedFields = ['user_id', 'permission_id'];

    public function getUserPermissions()
    {
        // Join with auth_permissions table to get permission names
        $this->join('auth_permissions', 'auth_permissions.id = auth_users_permissions.permission_id');
        $this->join('users', 'users.id = auth_users_permissions.user_id');
        $this->groupBy('users.id');

        // Select the desired fields
        $this->select("
        users.id as user_id, 
        users.email, users.username, 
        GROUP_CONCAT(auth_permissions.id SEPARATOR ',') AS id_akses,
        GROUP_CONCAT(auth_permissions.name SEPARATOR ',') AS akses,
        GROUP_CONCAT(auth_permissions.description SEPARATOR ',') AS ket_akses
        ");
        return $this->findAll();
    }

    public function getGrupPermissions()
    {
        // Join with auth_permissions table to get permission names
        $this->join('auth_permissions', 'auth_permissions.id = auth_users_permissions.permission_id');
        $this->join('auth_groups', 'auth_groups.id = auth_users_permissions.user_id');
        $this->groupBy('auth_groups.id');

        // Select the desired fields
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
