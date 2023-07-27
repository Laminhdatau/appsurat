<?php

namespace App\Models;

use CodeIgniter\Model;

class M_jenis_surat extends Model
{
    protected $table = 't_jenis_surat';
    protected $primaryKey = 'id_jenis_surat';
    protected $allowedFields = ['jenis_surat'];

    public function getJenisSurat($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function createJenisSurat($data)
    {
        return $this->insert($data);
    }

    public function updateJenisSurat($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteJenisSurat($id)
    {
        return $this->delete($id);
    }
}
