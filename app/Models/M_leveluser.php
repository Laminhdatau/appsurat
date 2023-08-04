<?php

namespace App\Models;

use CodeIgniter\Model;

class M_leveluser extends Model
{
    protected $table = 'auth_groups_users';
    protected $primaryKey = 'group_id'; // Update primary key to 'user_id'
    protected $allowedFields = ['group_id', 'user_id'];

   

    public function getLevelUser()
    {
        // Join with auth_permissions table to get permission names
        $this->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->join('users', 'users.id = auth_groups_users.user_id');
        $this->groupBy('users.id');

        $this->select("
        users.id as id_user, 
        users.username, 
        users.email, 
        GROUP_CONCAT(auth_groups.id SEPARATOR ',') AS id_grup,
        GROUP_CONCAT(auth_groups.name SEPARATOR ',') AS grup,
        GROUP_CONCAT(auth_groups.description SEPARATOR ',') AS ket_grup
        ");
        return $this->findAll();
    }
}
