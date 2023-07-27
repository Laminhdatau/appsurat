<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pegawai_pts extends Model
{
    protected $table = 't_pegawai_pts';
    protected $primaryKey = 'id_pegawai';
    protected $allowedFields = ['nama_lengkap', 'foto', 'nip', 'id_jabatan', 'telp', 'email', 'id_instansi'];

    public function getPegawaiById($idPegawai)
    {
        return $this->find($idPegawai);
    }

    public function getAllPegawai()
    {
        return $this->findAll();
    }

    public function createPegawai($data)
    {
        return $this->insert($data);
    }

    public function updatePegawai($idPegawai, $data)
    {
        return $this->update($idPegawai, $data);
    }

    public function deletePegawai($idPegawai)
    {
        return $this->delete($idPegawai);
    }
}
