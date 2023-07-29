<?php

namespace App\Models;

use CodeIgniter\Database\Query;

use CodeIgniter\Model;

class M_surgas extends Model
{
    protected $table = 't_surat_tugas';
    protected $primaryKey = 'id_surat_tugas';
    protected $allowedFields = ['id_surat_tugas', 'id_jenis_surat', 'id_nomor_surat', 'tanggal_terbit', 'tgl_mulai', 'tgl_selesai', 'tujuan_surat', 'tempat_pelaksanaan','tembusan', 'qr_code_image_path', 'id_penandatangan','verifikator', 'id_status','id_uprov', 'is_active','lokasi','seeto','create_at','created_by','dasar'];

    public function getSurgas($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function tambahDilihatOleh($idSurgas, $email)
    {
        $Surgas = $this->find($idSurgas);

        if (!$Surgas) {
            return false;
        }

        $dilihatOleh = json_decode($Surgas['seeto'], true); // Mengubah JSON menjadi array

        if (empty($dilihatOleh)) {
            $dilihatOleh = [];
        }

        // Periksa apakah email sudah ada dalam array
        if (!in_array($email, $dilihatOleh)) {
            $dilihatOleh[] = $email; // Tambahkan email ke dalam array
            $this->update($idSurgas, ['seeto' => json_encode($dilihatOleh)]); // Mengubah array menjadi JSON dan memperbarui data
        }

        return true; // Mengembalikan true setelah pembaruan berhasil dilakukan
    }

    public function getLastSurat()
    {
        $query = $this->db->query("SELECT MAX(id_nomor_surat) as id_nomor_surat FROM t_surat_tugas ORDER BY id_surat_tugas DESC LIMIT 1");
        $lastSurat = $query->getRowArray();
        // dd($lastSurat);
        if ($lastSurat !== null) {
            $lastNo = explode('/', $lastSurat['id_nomor_surat']);
            // dd($lastNo[0]);
            return $lastNo[0];
        } else {
            return null;
        }
    }

    // Model M_surgas
    public function checkUniqueNomorSurat($nomorSurat)
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM t_surat_tugas 
        WHERE SUBSTRING_INDEX(id_nomor_surat, '/', 1) = '" . $nomorSurat . "'");
        $result = $query->getRow();

        return $result->total == 0; // Return true if the count is 0 (unique)
    }




    public function saveSurgas($data)
    {
        return $this->insert($data);
    }

    public function updateSurgas($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteSurgas($id)
    {
        return $this->delete($id);
    }
}
