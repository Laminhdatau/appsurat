<?php

namespace App\Controllers\Users\Lldikti;

use App\Controllers\BaseController;
use App\Models\M_surat;
use App\Models\M_wilayah;
use App\Models\M_instansi;
use App\Models\M_sifat;
use App\Models\M_temp_wil;
use App\Models\M_verifikasi;

class Surat_keluarl extends BaseController
{
  public function index()
  {

    $M_temp_wil = new M_temp_wil();
    $M_surat = new M_surat();
    $M_sifat = new M_sifat();
    $M_wilayah = new M_wilayah();
    $M_instansi = new M_instansi();
    $M_verifikasi = new M_verifikasi();



    $query = $M_surat->query("SELECT
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    sl.dilihat_oleh,
    tw.id_surat as id_sur,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi AS dari,
    sl.tembusan,
    sl.is_active,
    sl.filex,
    sl.created_by,
    sl.stts_confirm,
    GROUP_CONCAT(DISTINCT st.id_status SEPARATOR ',') as id_status,
    GROUP_CONCAT(DISTINCT pts.id_instansi) as id_template_wil,
    GROUP_CONCAT(DISTINCT w.id_wilayah) as id_wilayah
FROM
    t_surat sl
LEFT JOIN t_template_wil tw ON tw.id_surat = sl.id_surat
LEFT JOIN t_instansi i ON sl.id_instansi = i.id_instansi
LEFT JOIN t_instansi pts ON FIND_IN_SET(pts.id_instansi, tw.id_template_wil)
LEFT JOIN t_wilayah w ON FIND_IN_SET(w.id_wilayah, tw.id_wilayah)
JOIN t_sifat s ON sl.id_sifat = s.id_sifat
JOIN t_jenis_surat j ON sl.id_jenis_surat = j.id_jenis_surat
LEFT JOIN t_verifikasi v ON v.id_surat = sl.id_surat
LEFT JOIN t_status st ON FIND_IN_SET(st.id_status, v.id_status)
WHERE
    sl.id_jenis_surat = 1
GROUP BY
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    sl.dilihat_oleh,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi,
    sl.tembusan,
    sl.is_active,
    sl.filex,
    sl.created_by,
    sl.stts_confirm
ORDER BY
    sl.created_at DESC;");

    $users = $query->getResultArray();


    $sifat = $M_sifat->findAll();
    $daftarInstansi = $M_instansi->findAll();
    $dataVerifikasi = $M_verifikasi->findAll();
    $daftarWilayah = $M_wilayah->findAll();


    // GROUP PENGIRIMAN
    $tempWilayah = $M_temp_wil->find();
    $twil = null;
    $twil1 = null;
    $twil2 = null;
    foreach ($tempWilayah as $tw) {
      $twil = $tw['id_surat'];
      $twil1 = $tw['id_template_wil'];
      $twil2 = $tw['id_wilayah'];
    }
    $filterInstansi = array_filter($daftarInstansi, function ($instansi) {
      return $instansi['id_instansi'] !== '0';
    });
    $daftarFilterInstansi = array_values($filterInstansi);

    // END GROUP PENGIRIMAN


    $data = [
      'title' => 'Surat Keluar',
      'suker' => $users,
      'sifat' => $sifat,
      'wilayah' => $daftarWilayah,
      'verifikasi' => $dataVerifikasi,

      'instansii' => $daftarFilterInstansi,
      'id_sur' => $twil,
      'id_sur1' => $twil1,
      'id_sur2' => $twil2,
    ];


    // dd($data);
    return view('public/lldikti/surat_keluar', $data);
  }




  public function formTambahSuker()
  {

    $M_sifat = new M_sifat();

    $sifat = $M_sifat->findAll();



    $data = [
      'title' => 'Tambah Surat Keluar',
      'sifat' => $sifat
    ];


    // dd($data);
    return view('public/lldikti/suratkeluarform/addsuratkeluarl', $data);
  }

  public function formUbahSuker($id)
  {


    $M_surat = new M_surat();
    $M_sifat = new M_sifat();



    $query = $M_surat->query("SELECT
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    sl.dilihat_oleh,
    tw.id_surat as id_sur,
    tw.id_template_wil,
    tw.id_wilayah,
    s.id_sifat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi AS dari,
    GROUP_CONCAT(DISTINCT a.id_instansi ORDER BY a.id_instansi SEPARATOR ', ') AS id_untuk,
    GROUP_CONCAT(DISTINCT a.nm_instansi ORDER BY a.nm_instansi SEPARATOR ', ') AS untuk,
    sl.tembusan,
    v.id_status,
    sl.is_active,
    sl.filex,
    sl.created_by,
    sl.stts_confirm
  FROM
    t_surat sl
  LEFT JOIN
    t_instansi i ON sl.id_instansi = i.id_instansi
  LEFT JOIN
    t_instansi a ON FIND_IN_SET(a.id_instansi, sl.id_sendto)
  LEFT JOIN t_template_wil tw on tw.id_surat=sl.id_surat
  JOIN
    t_sifat s ON sl.id_sifat = s.id_sifat
  JOIN
    t_jenis_surat j ON sl.id_jenis_surat = j.id_jenis_surat
 left join t_verifikasi v on v.id_surat=sl.id_surat
 left join t_status st on st.id_status=v.id_status
 WHERE
    sl.id_jenis_surat in(1) and
    sl.is_active in (0,1) and sl.id_surat='" . $id . "'
  GROUP BY
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.id_sifat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    v.id_status,
    sl.tembusan,
    sl.filex,
    tw.id_template_wil,
    tw.id_wilayah
    ORDER BY sl.created_at");

    $users = $query->getRow();
    $sifat = $M_sifat->findAll();

    $data = [
      'title' => 'Surat Keluar',
      'suker' => $users,
      'sifat' => $sifat
    ];


    // dd($data);
    return view('public/lldikti/suratkeluarform/ubahsuratkeluarl', $data);
  }



  // SIMPAN DARI SURAT KELUAR PTS

  public function simpanSuker()
  {

    $userId = idUser();
    $file = $this->request->getFile('filex');
    // Validasi jenis file
    if ($file->isValid() && !$file->hasMoved() && in_array($file->getExtension(), ['pdf', 'jpg', 'jpeg'])) {
      // $doc = $file->getRandomName();
      $doc = auto_uuid();
      if ($file->move('./assets/document/', $doc)) {
        $data = [
          'id_surat' => $doc,
          'tgl_surat' => date('Y-m-d'), // Menggunakan format tanggal yang sesuai
          'id_jenis_surat' => '1',
          'is_active' => '0',
          'created_by' => $userId,
          'id_instansi' => idInstansi(),
          'filex' => $doc,
          'nomor_surat' => $this->request->getPost('nomor_surat'),
          'id_sifat' => $this->request->getPost('id_sifat'),
          'tembusan' => $this->request->getPost('tembusan'),
          'id_pegawai' => $this->request->getPost('id_pegawai'),
          'perihal' => $this->request->getPost('perihal'),
        ];

        $M_surat = new M_surat();
        $M_surat->saveSurat($data);
        return redirect()->to('/suratkeluarl')->with('success', "SUKSES");
      } else {
        return $file->getErrorString();
      }
    } else {
      return redirect()->to('/formTambahSuker')->with('gagal', "Jenis file yang diunggah tidak valid. Hanya file PDF, JPG, dan JPEG yang diperbolehkan.");
    }
  }

  public function updateSuker($id)
  {

    $userId = idUser();
    $file = $this->request->getFile('filex');
    // Validasi jenis file
    if ($file->isValid() && !$file->hasMoved() && in_array($file->getExtension(), ['pdf', 'jpg', 'jpeg'])) {
      $doc = $id;

      if ($file->move('./assets/document/', $doc)) {
        $data = [
          'tgl_surat' => date('Y-m-d'),
          'id_jenis_surat' => '1',
          'is_active' => '0',
          'created_by' => $userId,
          'filex' => $doc,
          'id_instansi' => idInstansi(),
          'nomor_surat' => $this->request->getPost('nomor_surat'),
          'id_sifat' => $this->request->getPost('id_sifat'),
          'tembusan' => $this->request->getPost('tembusan'),
          'id_pegawai' => $this->request->getPost('id_pegawai'),
          'perihal' => $this->request->getPost('perihal')
        ];

        $M_surat = new M_surat();
        $M_surat->updateSurat($id, $data);

        return redirect()->to('/suratkeluarl')->with('success', "SUKSES");
      } else {
        return $file->getErrorString();
      }
    } else {
      return redirect()->to('/formUbahSukerl/' . $id)->with('gagal', "Jenis file yang diunggah tidak valid. Hanya file PDF, JPG, dan JPEG yang diperbolehkan.");
    }
  }

  public function sendToIns()
  {


    $instansi = $this->request->getPost('daftarInstansi');
    $surat = $this->request->getPost('id_surat');
    $instansiString = implode(",", $instansi);
    $m_temp_wil = new M_temp_wil();
    $data = [
      'id_surat' => $surat,
      'id_template_wil' => $instansiString
    ];

    $m_temp_wil->createWil($data);

    $m_surat = new M_surat();
    $data = [
      'stts_confirm' => '0'
    ];
    $m_surat->updateSurat($surat, $data);

    return redirect()->to('/suratkeluarl')->with('success', "SUKSES");
  }




  public function sendAll()
  {

    $wilayah = $this->request->getPost('daftarWilayah');
    $surat = $this->request->getPost('id_surat');
    $wilayahString = implode(",", $wilayah);
    $m_temp_wil = new M_temp_wil();


    $data = [
      'id_surat' => $surat,
      'id_wilayah' => $wilayahString,

    ];
    $m_temp_wil->createWil($data);

    $m_surat = new M_surat();
    $data = [
      'stts_confirm' => '0'
    ];
    $m_surat->updateSurat($surat, $data);

    return redirect()->to('/suratkeluarl')->with('success', "SUKSES");
  }

  public function konfirmasiSend($id_surat)
  {

    $userId = idUser();
    $m_surat = new M_surat();
    $m_verif = new M_verifikasi();
    $stts = $this->request->getPost('stts');

    switch ($stts) {
      case '1':

        $dataUp = [
          'stts_confirm' => $stts
        ];

        $m_surat->updateSurat($id_surat, $dataUp);

        $dataVerif = [
          'id_surat' => $id_surat,
          'id_user' => $userId,
          'id_status' => '8'
        ];
        $m_verif->createVerifikasi($dataVerif);

        break;

      case '2':

        $dataUp = [
          'stts_confirm' => $stts
        ];
        $m_surat->updateSurat($id_surat, $dataUp);


        $dataVerif = [
          'id_surat' => $id_surat,
          'id_user' => $userId,
          'id_status' => '4'
        ];
        $m_verif->createVerifikasi($dataVerif);

        break;


      default:
        // Tindakan default jika tidak ada nilai tombol yang sesuai
        break;
    }


    return redirect()->to('/suratkeluarl');
  }



  public function deleteSuker($idsurat){
    $m_surat=new M_surat();
    $m_surat->deleteSurat($idsurat);

    return redirect()->to('/suratkeluarl')->with('success', "SUKSES");

  }
}
