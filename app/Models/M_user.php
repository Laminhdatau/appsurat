<?php

namespace App\Models;

use CodeIgniter\Model;

class M_user extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'username', 'email', 'active'];

    public function getUsers()
    {
        return $this->findAll();
    }

    public function getUserById($id)
    {
        return $this->find($id);
    }

    public function createUser($data)
    {
        return $this->insert($data);
    }

    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }
}
