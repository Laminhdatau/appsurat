<?php

namespace App\Models;

use CodeIgniter\Model;

class M_temp_wil extends Model
{
    protected $table = 't_template_wil';
    protected $allowedFields = ['id_template_wil', 'id_surat', 'id_wilayah'];

    public function getWilById($idWil)
    {
        return $this->find($idWil);
    }

    public function getAllWil()
    {
        return $this->findAll();
    }

    public function createWil($data)
    {
        return $this->insert($data);
    }

    public function updateWil($idWil, $data)
    {
        return $this->update($idWil, $data);
    }

    public function deleteWil($idWil)
    {
        return $this->delete($idWil);
    }
}
