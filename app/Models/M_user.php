<?php

namespace App\Models;

use CodeIgniter\Model;

class M_user extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'username', 'user_image', 'password_hash', 'email', 'active'];

    public function getUsers($id)
    {
        $query = $this->select('*')
            ->from('v_ulevel u')
            ->join('t_user_pegawai up', 'up.id_user = u.id_user')
            ->join('v_pegawai p', 'p.id_pegawai = up.id_pegawai')
            ->where('u.id_user', $id);
        
        return $query->get()->getRow(); // Menggunakan get() untuk menjalankan query dan getResult() untuk mengambil hasil
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
