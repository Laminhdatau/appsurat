<?php

namespace App\Controllers\Users\Pts;

use App\Controllers\BaseController;
use App\Models\M_surat;
use App\Models\M_sifat;
use App\Models\M_instansi;


class Surat_keluarp extends BaseController
{


  public function index()
  {
    $M_sifat = new M_sifat();
    $m_instansi = new M_instansi();
    $M_surat = new M_surat();

    $query = $M_surat->query("SELECT
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi AS dari,
    GROUP_CONCAT(DISTINCT i.id_instansi ORDER BY i.id_instansi SEPARATOR ', ') AS id_untuk,
    GROUP_CONCAT(DISTINCT i.nm_instansi ORDER BY i.nm_instansi SEPARATOR ', ') AS untuk,
    sl.tembusan,
    sl.filex,
    sl.id_sendto,
    ins.nm_instansi as lldikti,
    v.id_status
  FROM
    t_surat sl
  LEFT JOIN
    t_instansi i ON sl.id_instansi = i.id_instansi
    join t_instansi ins on ins.id_instansi=sl.id_sendto
    LEFT JOIN t_template_wil tw on tw.id_surat=sl.id_surat
    left join t_verifikasi v on v.id_surat=sl.id_surat
    
  JOIN
    t_sifat s ON sl.id_sifat = s.id_sifat
  JOIN
    t_jenis_surat j ON sl.id_jenis_surat = j.id_jenis_surat
    where sl.id_jenis_surat in(2,3)
  GROUP BY
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi,
    sl.tembusan,
    sl.filex,
    v.id_status;");

    $users = $query->getResultArray();
    $sifat = $M_sifat->findAll();
    $instansi = $m_instansi->findAll();


    $data = [
      'title' => 'Surat Keluar PTS',
      'suker' => $users,
      'sifat' => $sifat,
      'instansi' => $instansi


    ];

    return view('public/pts/surat_keluar', $data);
  }


  // SIMPAN DARI SURAT KELUAR PTS

  public function save()
  {
    $file = $this->request->getFile('filex');

    // Validasi jenis file
    if ($file->isValid() && !$file->hasMoved() && in_array($file->getExtension(), ['pdf', 'jpg', 'jpeg', 'png'])) {
      $doc = $file->getRandomName();

      if ($file->move('./assets/document/', $doc)) {

        $data = [
          'id_surat' => auto_uuid(),
          'nomor_surat' => $this->request->getPost('nomor_surat'),
          'id_sifat' => $this->request->getPost('id_sifat'),
          'tgl_surat' => date('Y-m-d'), // Menggunakan format tanggal yang sesuai
          'id_jenis_surat' => 3,
          'id_instansi' => $this->request->getPost('id_instansi'),
          'is_active' => 0,
          'tembusan' => $this->request->getPost('tembusan'),
          'filex' => $doc,
          'id_pegawai' => $this->request->getPost('id_pegawai'),
          'id_sendto' => "782909e8-09b4-11ee-8c85-503eaa456e2a",
          'perihal' => $this->request->getPost('perihal'),
          'created_by' => idUser()
        ];

        // dd($data);
        $M_surat = new M_surat();
        $M_surat->saveSurat($data);


        return redirect()->to('/surat_keluarp')->with('success', "SUKSES");
      } else {
        return $file->getErrorString();
      }
    } else {
      return 'Jenis file yang diunggah tidak valid. Hanya file PDF, JPG, JPEG, dan PNG yang diperbolehkan.';
    }
  }
}
