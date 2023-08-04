<?php

namespace App\Models;

use CodeIgniter\Model;

class M_groups extends Model
{
    protected $table = 'auth_groups';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','name', 'description'];

    public function getGroup($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function createGroup($data)
    {
        return $this->insert($data);
    }

    public function updateGroup($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteGroup($id)
    {
        return $this->delete($id);
    }
}
