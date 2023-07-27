<?php

namespace App\Models;

use CodeIgniter\Model;

class M_instruksi extends Model
{
    protected $table = 't_instruksi';
    protected $primaryKey = 'id_instruksi';
    protected $allowedFields = ['instruksi'];
    public function getInstruksi($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function createInstruksi($data)
    {
        return $this->insert($data);
    }

    public function updateInstruksi($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteInstruksi($id)
    {
        return $this->delete($id);
    }
}
