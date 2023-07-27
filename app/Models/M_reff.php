<?php

namespace App\Models;

use CodeIgniter\Model;

class M_reff extends Model
{
    protected $table = 't_reff_surat';
    protected $primaryKey = 'id_reff_surat';
    protected $allowedFields = ['nomor_surat', 'perihal'];
    public function getReff($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function searchKodeSurat($keyword)
    {
        $this->like('nomor_surat', $keyword);
        $this->orLike('perihal', $keyword);

        $results = $this->findAll();

        return $results;
    }

    public function createReff($data)
    {
        return $this->insert($data);
    }

    public function updateReff($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteReff($id)
    {
        return $this->delete($id);
    }
}
