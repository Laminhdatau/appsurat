<?php

namespace App\Models;

use CodeIgniter\Model;

class M_verifikasi extends Model
{
    protected $table = 't_verifikasi';
    protected $primaryKey = 'id_surat';
    protected $allowedFields = ['id_surat', 'id_status', 'wkt_verifikasi', 'id_user'];
    public function getVerifikasi($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }
        return $this->find($id);
    }

    public function createVerifikasi($data)
    {
        return $this->insert($data);
    }

    public function updateVerifikasi($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteVerifikasi($id)
    {
        return $this->delete($id);
    }
}
