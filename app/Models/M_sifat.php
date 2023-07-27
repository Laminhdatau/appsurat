<?php

namespace App\Models;

use CodeIgniter\Model;

class M_sifat extends Model
{
    protected $table = 't_sifat';
    protected $primaryKey = 'id_sifat';
    protected $allowedFields = ['sifat'];
    public function getSifat($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function createSifat($data)
    {
        return $this->insert($data);
    }

    public function updateSifat($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteSifat($id)
    {
        return $this->delete($id);
    }
}
