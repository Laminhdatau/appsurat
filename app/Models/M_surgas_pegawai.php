<?php

namespace App\Models;

use CodeIgniter\Model;

class M_surgas_pegawai extends Model
{
    protected $table = 't_surat_tugas_pegawai';
    protected $allowedFields = ['id_surat_tugas', 'id_pegawai_string'];
    public function getSurgasPegawai($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function saveSurgasPegawai($data)
    {
        return $this->insert($data);
    }

    public function updateSurgasPegawai($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteSurgasPegawai($id)
    {
        return $this->delete($id);
    }
}
