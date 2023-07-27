<?php

namespace App\Models;

use CodeIgniter\Model;

class M_kop extends Model
{
    protected $table = 't_kop_surat';
    protected $primaryKey = 'id_kop';
    protected $allowedFields = ['id_kop', 'head', 'sub_head', 'lokasi', 'alamat_jl', 'laman', 'email', 'helpdesk_wa'];
    public function getKo($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }
        return $this->find($id);
    }

    public function createKo($data)
    {
        return $this->insert($data);
    }

    public function updateKo($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteKo($id)
    {
        return $this->delete($id);
    }
}
