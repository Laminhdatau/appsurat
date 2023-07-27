<?php

namespace App\Models;

use CodeIgniter\Model;

class M_status extends Model
{
    protected $table = 't_status';
    protected $primaryKey = 'id_status';
    protected $allowedFields = ['id_status','status'];
    public function getStatus($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function createStatus($data)
    {
        return $this->insert($data);
    }

    public function updateStatus($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteStatus($id)
    {
        return $this->delete($id);
    }
}
