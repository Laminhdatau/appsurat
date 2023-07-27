<?php

namespace App\Models;

use CodeIgniter\Model;

class M_wilayah extends Model
{
    protected $table = 't_wilayah';
    protected $allowedFields = ['id_wilayah', 'wilayah'];

    public function getWilayahById($idWilayah)
    {
        return $this->find($idWilayah);
    }

    public function getAllWilayah()
    {
        return $this->findAll();
    }

    public function createWilayah($data)
    {
        return $this->insert($data);
    }

    public function updateWilayah($idWilayah, $data)
    {
        return $this->update($idWilayah, $data);
    }

    public function deleteWilayah($idWilayah)
    {
        return $this->delete($idWilayah);
    }
}
