<?php

namespace App\Models;

use CodeIgniter\Model;

class M_submenu extends Model
{
    protected $table = 't_sub_menu';
    protected $primaryKey = 'id_sub_menu';
    protected $allowedFields = ['id_menu', 'title', 'url', 'icon', 'is_active'];

    public function getSubMenu($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function createSubMenu($data)
    {
        return $this->insert($data);
    }

    public function updateSubMenu($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteSubMenu($id)
    {
        return $this->delete($id);
    }
}
