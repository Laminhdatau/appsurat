<?php

namespace App\Models;

use CodeIgniter\Model;

class M_disposisi extends Model
{
    protected $table = 't_disposisi';
    protected $allowedFields = ['id_surat_dispos', 'id_jenis_surat', 'user_id', 'tanggal_disposisi', 'id_pegawai_tujuan', 'id_instruksi'];

    public function getdisposisiById($iddisposisi)
    {
        return $this->find($iddisposisi);
    }

    public function getAlldisposisi()
    {
        return $this->findAll();
    }

    public function createdisposisi($data)
    {
        return $this->insert($data);
    }

    public function updatedisposisi($iddisposisi, $data)
    {
        return $this->update($iddisposisi, $data);
    }

    public function deletedisposisi($iddisposisi)
    {
        return $this->delete($iddisposisi);
    }
}
