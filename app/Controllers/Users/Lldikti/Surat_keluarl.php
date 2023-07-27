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
    tw.id_template_wil,
    tw.id_wilayah,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi AS dari,
    GROUP_CONCAT(DISTINCT a.id_instansi ORDER BY a.id_instansi SEPARATOR ', ') AS id_untuk,
    GROUP_CONCAT(DISTINCT a.nm_instansi ORDER BY a.nm_instansi SEPARATOR ', ') AS untuk,
    sl.tembusan,
    v.id_status,
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
    sl.is_active in (0,1)
  GROUP BY
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    v.id_status,
    sl.tembusan,
    sl.filex,
    tw.id_template_wil,
    tw.id_wilayah
    ORDER BY sl.created_at;");

    $users = $query->getResultArray();
    $sifat = $M_sifat->findAll();
    $daftarInstansi = $M_instansi->findAll();
    $dataVerifikasi = $M_verifikasi->findAll();
    $daftarWilayah = $M_wilayah->findAll();
    $tempWilayah = $M_temp_wil->find();

    // dd($dataVerifikasi);

    $twil = null;
    $twil1 = null;
    $twil2 = null;
    foreach ($tempWilayah as $tw) {
      $twil = $tw['id_surat'];
      $twil1 = $tw['id_template_wil'];
      $twil2 = $tw['id_wilayah'];
    }

    $filterInstansi = array_filter($daftarInstansi, function ($instansi) {
      return $instansi['id_instansi'] !== '782909e8-09b4-11ee-8c85-503eaa456e2a';
    });


    $daftarFilterInstansi = array_values($filterInstansi);

    $data = [
      'title' => 'Surat Keluar',
      'suker' => $users,
      'sifat' => $sifat,
      'instansii' => $daftarFilterInstansi,
      'wilayah' => $daftarWilayah,
      'id_sur' => $twil,
      'id_sur1' => $twil1,
      'id_sur2' => $twil2,
      'verifikasi' => $dataVerifikasi,
    ];


    // dd($data);
    return view('public/lldikti/surat_keluar', $data);
  }

  // SIMPAN DARI SURAT KELUAR PTS

  public function save()
  {

    $userId = idUser();
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
          'id_jenis_surat' => '1',
          'is_active' => '0',
          'id_instansi' => "782909e8-09b4-11ee-8c85-503eaa456e2a",
          'tembusan' => $this->request->getPost('tembusan'),
          'filex' => $doc,
          'id_pegawai' => $this->request->getPost('id_pegawai'),
          'perihal' => $this->request->getPost('perihal'),
          'created_by' => $userId,
          'stts_confirm' => '0'
        ];

        $M_surat = new M_surat();
        $M_surat->saveSurat($data);

        return redirect()->to('/surat_keluarl')->with('success', "SUKSES");
      } else {
        return $file->getErrorString();
      }
    } else {
      return redirect()->to('/surat_keluarl')->with('gagal', "Jenis file yang diunggah tidak valid. Hanya file PDF, JPG, JPEG, dan PNG yang diperbolehkan.");
    }
  }

  public function sendToIns()
  {

    $userId = idUser();
    $instansi = $this->request->getPost('daftarInstansi');
    $surat = $this->request->getPost('id_surat');
    $instansiString = implode(",", $instansi);
    $m_temp_wil = new M_temp_wil();
    $m_verif = new M_verifikasi();
    $m_surat = new M_surat();

    $cekIdSurat = $m_verif->find($surat);
    if (empty($cekIdSurat)) {

      $data = [
        'id_surat' => $surat,
        'id_template_wil' => $instansiString,

      ];

      $m_temp_wil->createWil($data);

      $dataSur = [
        'stts_confirm' => '0',
      ];
      $m_surat->updateSurat($surat, $dataSur);

      $dataVer = [
        'id_surat' => $surat,
        'id_status' => '9',
        'id_user' => $userId,
      ];

      $m_verif->createVerifikasi($dataVer);
    } else {
      $data = [
        'id_surat' => $surat,
        'id_template_wil' => $instansiString,

      ];

      $dataSur = [
        'stts_confirm' => '0',

      ];
      $m_surat->updateSurat($surat, $dataSur);

      $m_temp_wil->createWil($data);
      $dataVer = [
        'id_status' => '9',
        'id_user' => $userId,
      ];

      $m_verif->updateVerifikasi($surat, $dataVer);
    }

    return redirect()->to('/surat_keluarl')->with('success', "SUKSES");
  }




  public function sendAll()
  {
    $userId = idUser();
    $wilayah = $this->request->getPost('daftarWilayah');
    $surat = $this->request->getPost('id_surat');
    $wilayahString = implode(",", $wilayah);
    $m_temp_wil = new M_temp_wil();
    $m_verif = new M_verifikasi();
    $m_surat = new M_surat();


    $cekIdSurat = $m_verif->find($surat);
    if (empty($cekIdSurat)) {
      $data = [
        'id_surat' => $surat,
        'id_wilayah' => $wilayahString,

      ];
      $m_temp_wil->createWil($data);
      $dataSur = [
        'stts_confirm' => '0',

      ];
      $m_surat->updateSurat($surat, $dataSur);

      $dataVer = [
        'id_surat' => $surat,
        'id_status' => '9',
        'id_user' => $userId,
      ];
      $m_verif->createVerifikasi($dataVer);
    } else {
      $data = [
        'id_surat' => $surat,
        'id_wilayah' => $wilayahString,
      ];
      $m_temp_wil->createWil($data);

      $dataSur = [
        'stts_confirm' => '0',

      ];
      $m_surat->updateSurat($surat, $dataSur);

      $dataVer = [
        'id_status' => '9',
        'id_user' => $userId,
      ];
      $m_verif->updateVerifikasi($surat, $dataVer);
    }




    return redirect()->to('/surat_keluarl')->with('success', "SUKSES");
  }



  public function konfirmasiSend($id_surat)
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


    return redirect()->to('/surat_keluarl');
  }



  // SETINGAN UNTUK 
  public function dilihatOleh($idSurat)
  {

    $auth = service('authentication');
    $user = $auth->user();
    $email = $user->email;
    $M_surat = new M_surat();
    $M_surat->tambahDilihatOleh($idSurat, $email);

    return $this->response->setJSON(['message' => 'Pengguna ditambahkan ke daftar dilihat']);
  }
}
