<?php

namespace App\Models;

use CodeIgniter\Model;

class M_surat extends Model
{
    protected $table = 't_surat';
    protected $primaryKey = 'id_surat';
    protected $allowedFields = ['id_surat', 'nomor_surat', 'id_sifat', 'tgl_surat', 'id_jenis_surat', 'is_active', 'id_instansi', 'id_status', 'tembusan', 'filex', 'perihal', 'id_sendto', 'dilihat_oleh','created_by','stts_confirm'];

    public function getSurat($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function tambahDilihatOleh($idSurat, $email)
    {
        $surat = $this->find($idSurat);

        if (!$surat) {
            return false;
        }

        $dilihatOleh = json_decode($surat['dilihat_oleh'], true); // Mengubah JSON menjadi array

        if (empty($dilihatOleh)) {
            $dilihatOleh = [];
        }

        // Periksa apakah email sudah ada dalam array
        if (!in_array($email, $dilihatOleh)) {
            $dilihatOleh[] = $email; // Tambahkan email ke dalam array
            $this->update($idSurat, ['dilihat_oleh' => json_encode($dilihatOleh)]); // Mengubah array menjadi JSON dan memperbarui data
        }

        return true; // Mengembalikan true setelah pembaruan berhasil dilakukan
    }




    public function saveSurat($data)
    {
        return $this->insert($data);
    }

    public function updateSurat($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteSurat($id)
    {
        return $this->delete($id);
    }
}
