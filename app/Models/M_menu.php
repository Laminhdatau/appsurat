<?php

namespace App\Models;

use CodeIgniter\Model;

class M_menu extends Model
{
    protected $table = 't_menu';
    protected $primaryKey = 'id_menu';
    protected $allowedFields = ['menu'];

    public function getMenu($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function createMenu($data)
    {
        return $this->insert($data);
    }

    public function updateMenu($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteMenu($id)
    {
        return $this->delete($id);
    }
}
