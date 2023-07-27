<?php
namespace App\Models;
use CodeIgniter\Model;

class M_instansi extends Model
{
    protected $table = 't_instansi';
    protected $primaryKey = 'id_instansi';
    protected $allowedFields = ['nm_instansi', 'alamat', 'telepon', 'email','id_wilayah'];
    public function getInstansi($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }
        return $this->find($id);
    }

    public function createInstansi($data)
    {
        return $this->insert($data);
    }

    public function updateInstansi($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteInstansi($id)
    {
        return $this->delete($id);
    }
}
