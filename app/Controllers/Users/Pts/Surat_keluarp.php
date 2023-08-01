<?php

namespace App\Controllers\Users\Pts;

use App\Controllers\BaseController;
use App\Models\M_surat;
use App\Models\M_sifat;
use App\Models\M_instansi;
use App\Models\M_verifikasi;


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
    s.id_sifat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi AS dari,
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

  public function formTambahSuker()
  {
    $M_sifat = new M_sifat();

    $sifat = $M_sifat->findAll();


    $data = [
      'title' => 'Surat Keluar PTS',
      'sifat' => $sifat,

    ];

    return view('public/pts/suratkeluarform/addsuratkeluarp', $data);
  }

  public function formUbahSuker($id)
  {
    $M_sifat = new M_sifat();
    $M_surat = new M_surat();

    $query = $M_surat->query("SELECT
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.id_sifat,
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
    and sl.id_surat='" . $id . "'
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

    $users = $query->getRow();
    $sifat = $M_sifat->findAll();


    $data = [
      'title' => 'Surat Keluar PTS',
      'suker' => $users,
      'sifat' => $sifat


    ];

    return view('public/pts/suratkeluarform/updatesuratkeluarp', $data);
  }



  // SIMPAN DARI SURAT KELUAR PTS

  public function simpanSuker()
  {
    $file = $this->request->getFile('filex');

    // Validasi jenis file
    if ($file->isValid() && !$file->hasMoved() && in_array($file->getExtension(), ['pdf', 'jpg', 'jpeg', 'png'])) {
      $doc = $file->getRandomName();

      if ($file->move('./assets/document/', $doc)) {

        $data = [
          'id_surat' => auto_uuid(),
          'tgl_surat' => date('Y-m-d'), // Menggunakan format tanggal yang sesuai
          'is_active' => 0,
          'id_jenis_surat' => 3,
          'filex' => $doc,
          'created_by' => idUser(),
          'nomor_surat' => $this->request->getPost('nomor_surat'),
          'id_sifat' => $this->request->getPost('id_sifat'),
          'id_instansi' => $this->request->getPost('id_instansi'),
          'tembusan' => $this->request->getPost('tembusan'),
          'id_pegawai' => $this->request->getPost('id_pegawai'),
          'id_sendto' => "782909e8-09b4-11ee-8c85-503eaa456e2a",
          'perihal' => $this->request->getPost('perihal')
        ];

        // dd($data);
        $M_surat = new M_surat();
        $M_surat->saveSurat($data);


        return redirect()->to('/suratkeluarp')->with('success', "SUKSES");
      } else {
        return $file->getErrorString();
      }
    } else {
      return 'Jenis file yang diunggah tidak valid. Hanya file PDF, JPG, JPEG, dan PNG yang diperbolehkan.';
    }
  }



  public function updateSuker($id)
  {
    $file = $this->request->getFile('filex');

    // Validasi jenis file
    if ($file->isValid() && !$file->hasMoved() && in_array($file->getExtension(), ['pdf', 'jpg', 'jpeg', 'png'])) {
      $doc = $file->getRandomName();

      if ($file->move('./assets/document/', $doc)) {

        $data = [

          'created_by' => idUser(),
          'tgl_surat' => date('Y-m-d'),
          'id_jenis_surat' => 3,
          'is_active' => 0,
          'filex' => $doc,
          'id_sendto' => "782909e8-09b4-11ee-8c85-503eaa456e2a",
          'nomor_surat' => $this->request->getPost('nomor_surat'),
          'id_sifat' => $this->request->getPost('id_sifat'),
          'id_instansi' => $this->request->getPost('id_instansi'),
          'tembusan' => $this->request->getPost('tembusan'),
          'id_pegawai' => $this->request->getPost('id_pegawai'),
          'perihal' => $this->request->getPost('perihal'),
        ];

        // dd($data);
        $M_surat = new M_surat();
        $M_surat->updateSurat($id, $data);


        return redirect()->to('/suratkeluarp')->with('success', "SUKSES");
      } else {
        return $file->getErrorString();
      }
    } else {
      return 'Jenis file yang diunggah tidak valid. Hanya file PDF, JPG, JPEG, dan PNG yang diperbolehkan.';
    }
  }




  public function validasiKirim($id_surat)
  {

    $userId = idUser();
    $m_surat = new M_surat();
    $m_verif = new M_verifikasi();
    $stts = $this->request->getPost('stts');
    $cekIdSurat = $m_verif->find($id_surat);

    switch ($stts) {
      case '1':

        $dataUp = [
          'stts_confirm' => $stts
        ];
        $m_surat->updateSurat($id_surat, $dataUp);

        if (empty($cekIdSurat)) {
          $dataVerif = [
            'id_surat' => $id_surat,
            'id_user' => $userId,
            'id_status' => '8'
          ];
          $m_verif->createVerifikasi($dataVerif);
        } else {
          $dataVerif = [
            'id_user' => $userId,
            'id_status' => '8'
          ];
          $m_verif->updateVerifikasi($id_surat, $dataVerif);
        }

        break;

      case '2':


        $dataUp = [
          'stts_confirm' => $stts
        ];
        $m_surat->updateSurat($id_surat, $dataUp);

        if (empty($cekIdSurat)) {
          $dataVerif = [
            'id_surat' => $id_surat,
            'id_user' => $userId,
            'id_status' => '4'
          ];
          $m_verif->createVerifikasi($dataVerif);
        } else {
          $dataVerif = [
            'id_user' => $userId,
            'id_status' => '4'
          ];
          $m_verif->updateVerifikasi($id_surat, $dataVerif);
        }
        break;


      default:
        // Tindakan default jika tidak ada nilai tombol yang sesuai
        break;
    }


    return redirect()->to('/suratkeluarp');
  }


}
