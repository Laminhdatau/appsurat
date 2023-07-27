<?php

namespace App\Models;

use CodeIgniter\Model;

class M_user extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    // protected $allowedFields = ['username', 'email', 'password_hash','active'];

    public $authFields = [
        'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
        'password_hash' => ['label' => 'Password', 'rules' => 'required|min_length[8]'],
    ];
    
    public $allowedFields = [
        'username',
        'email',
        'password_hash',
        // kolom-kolom lain yang diperlukan
    ];
    
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
