<?php

namespace App\Models;

use CodeIgniter\Model;

class M_akses_menu extends Model
{
    protected $table = 't_akses_menu';
    protected $primaryKey = 'id_akses_menu';
    protected $allowedFields = ['id_auth_group', 'id_menu', 'id_jenis_surat'];

    public function getAksesMenu($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }
        return $this->find($id);
    }

    public function createAksesMenu($data)
    {
        return $this->insert($data);
    }

    public function updateAksesMenu($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteAksesMenu($id)
    {
        return $this->delete($id);
    }
}
