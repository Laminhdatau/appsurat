<?php

namespace App\Controllers\Users\Lldikti;

use App\Models\M_surat;
use App\Models\M_disposisi;
use App\Models\M_instruksi;


use App\Controllers\BaseController;
use App\Models\M_pegawai;
use App\Models\M_verifikasi;

class Surat_masukl extends BaseController
{


  // WILAYAH SURAT MASUK LLDIKTI

  public function index()
  {
    $M_surat = new M_surat();
    $query = $M_surat->query("SELECT
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi AS dari,
    GROUP_CONCAT(DISTINCT a.id_instansi ORDER BY a.id_instansi SEPARATOR ', ') AS id_untuk,
    GROUP_CONCAT(DISTINCT a.nm_instansi ORDER BY a.nm_instansi SEPARATOR ', ') AS untuk,

    sl.tembusan,
    sl.filex,
    sl.is_active,
    GROUP_CONCAT(DISTINCT v.id_status SEPARATOR ',')as id_status
  FROM
    t_surat sl
  LEFT JOIN
    t_instansi i ON sl.id_instansi = i.id_instansi
  LEFT JOIN
    t_instansi a ON FIND_IN_SET(a.id_instansi, sl.id_sendto)
  JOIN
    t_sifat s ON sl.id_sifat = s.id_sifat
  JOIN
    t_jenis_surat j ON sl.id_jenis_surat = j.id_jenis_surat
  LEFT JOIN
    t_verifikasi v ON v.id_surat = sl.id_surat
    left join t_status st on FIND_IN_SET(st.id_status,v.id_status)
  WHERE
    sl.id_jenis_surat in (3) and
    sl.is_active in (1)
  GROUP BY
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi,
    sl.tembusan,
    sl.filex;");

    $M_disposisi = new M_disposisi();
    $dislldikti = $M_disposisi->query("SELECT s.id_surat_dispos, GROUP_CONCAT(s.id_pegawai_tujuan SEPARATOR '<br>') as id_tujuan, ll.nomor_surat AS nos,j.id_jenis_surat, GROUP_CONCAT(p.nama_lengkap SEPARATOR '<br>') AS nama_lengkap,s.tanggal_disposisi
        FROM db_persuratan.t_disposisi s
        LEFT JOIN db_persuratan.t_surat ll ON ll.id_surat = s.id_surat_dispos
        JOIN db_persuratan.t_jenis_surat j ON j.id_jenis_surat = s.id_jenis_surat
        JOIN t_pegawai p ON FIND_IN_SET(p.id_pegawai, s.id_pegawai_tujuan) > 0
        WHERE j.id_jenis_surat = 3
        GROUP BY s.id_surat_dispos,s.tanggal_disposisi
        ORDER BY s.id_surat_dispos;");

    $users = $query->getResultArray();
    $disposll = $dislldikti->getResultArray();

    $m_pegawai = new M_pegawai();
    $daftarPegawai = $m_pegawai->findAll();


    $daftarPegawaiFiltered = array_filter($daftarPegawai, function ($pegawai) {
      return $pegawai['id_pegawai'] != idPegawai();
    });

    $daftarPegawaiFiltered = array_values($daftarPegawaiFiltered);

    $m_instruksi = new M_instruksi();
    $inst = $m_instruksi->findAll();




    $data = [
      'title' => 'Surat Masuk',
      'sumas' => $users,
      'disposll' => $disposll,
      'instruksi' => $inst,
      'daftarPegawai' => $daftarPegawaiFiltered,
    ];


    return view('public/lldikti/surat_masuk', $data);
  }




  public function formDisposisi($id_surat)
  {
    $M_surat = new M_surat();
    $query = $M_surat->query("SELECT
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi AS dari,
    GROUP_CONCAT(DISTINCT a.id_instansi ORDER BY a.id_instansi SEPARATOR ', ') AS id_untuk,
    GROUP_CONCAT(DISTINCT a.nm_instansi ORDER BY a.nm_instansi SEPARATOR ', ') AS untuk,

    sl.tembusan,
    sl.filex,
    sl.is_active,
    GROUP_CONCAT(DISTINCT v.id_status SEPARATOR ',')as id_status
  FROM
    t_surat sl
  LEFT JOIN
    t_instansi i ON sl.id_instansi = i.id_instansi
  LEFT JOIN
    t_instansi a ON FIND_IN_SET(a.id_instansi, sl.id_sendto)
  JOIN
    t_sifat s ON sl.id_sifat = s.id_sifat
  JOIN
    t_jenis_surat j ON sl.id_jenis_surat = j.id_jenis_surat
  LEFT JOIN
    t_verifikasi v ON v.id_surat = sl.id_surat
    left join t_status st on FIND_IN_SET(st.id_status,v.id_status)
  WHERE
    sl.id_jenis_surat in (3) and
    sl.is_active in (1) and sl.id_surat='" . $id_surat . "'
  GROUP BY
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi,
    sl.tembusan,
    sl.filex;");

    $M_disposisi = new M_disposisi();
    $dislldikti = $M_disposisi->query("SELECT s.id_surat_dispos, GROUP_CONCAT(s.id_pegawai_tujuan SEPARATOR '<br>') as id_tujuan, ll.nomor_surat AS nos,j.id_jenis_surat, GROUP_CONCAT(p.nama_lengkap SEPARATOR '<br>') AS nama_lengkap,s.tanggal_disposisi
        FROM db_persuratan.t_disposisi s
        LEFT JOIN db_persuratan.t_surat ll ON ll.id_surat = s.id_surat_dispos
        JOIN db_persuratan.t_jenis_surat j ON j.id_jenis_surat = s.id_jenis_surat
        JOIN t_pegawai p ON FIND_IN_SET(p.id_pegawai, s.id_pegawai_tujuan) > 0
        WHERE j.id_jenis_surat = 3
        GROUP BY s.id_surat_dispos,s.tanggal_disposisi
        ORDER BY s.id_surat_dispos;");

    $users = $query->getRow();
    $disposll = $dislldikti->getResultArray();

    $m_pegawai = new M_pegawai();
    $daftarPegawai = $m_pegawai->findAll();


    $daftarPegawaiFiltered = array_filter($daftarPegawai, function ($pegawai) {
      return $pegawai['id_pegawai'] != idPegawai();
    });

    $daftarPegawaiFiltered = array_values($daftarPegawaiFiltered);

    $m_instruksi = new M_instruksi();
    $inst = $m_instruksi->findAll();




    $data = [
      'title' => 'Surat Masuk',
      'sumas' => $users,
      'disposll' => $disposll,
      'instruksi' => $inst,
      'daftarPegawai' => $daftarPegawaiFiltered,
    ];


    return view('public/lldikti/disposisiForm/disposisi', $data);
  }





  public function delete($id)
  {
    $model = new M_surat();
    $data = $model->getSurat($id);

    if ($data) {
      $uploadDir = 'assets/document/'; // Ubah sesuai dengan direktori yang Anda inginkan

      // Menghapus file terkait jika ada
      if ($data['filex']) {
        unlink($uploadDir . '/' . $data['filex']);
      }

      $model->deleteSurat($id);
      return redirect()->to('/surat')->with('success', 'Surat deleted successfully');
    } else {
      return redirect()->to('/surat')->with('error', 'Surat not found');
    }
  }




  public function disposisilldikti()
  {

    $disposisiModel = new M_disposisi();
    $m_verif = new M_verifikasi();
    $userId = idUser();
    $id = $this->request->getPost('id_surat');
    $pegawai = $this->request->getPost('daftarpegawai');
    $instruksi = $this->request->getPost('instruksi');

    if ($pegawai === null) {
      $pegawaiString = null;
    } else {
      $pegawaiString = implode(",", $pegawai);
    }

    if ($instruksi === null) {
      $instrukString = null;
    } else {
      $instrukString = implode(",", $instruksi);
    }

    if ($pegawaiString !== null && $instrukString !== null) {

      $data = [
        'id_surat_dispos' => $id,
        'id_instruksi' => $instrukString,
        'id_pegawai_tujuan' => $pegawaiString,
        'user_id' => $userId,
        'id_jenis_surat' => 3
      ];

      $disposisiModel->createdisposisi($data);

      $verif = [
        'id_surat' => $id,
        'id_user' => $userId,
        'id_status' => '11'
      ];
      $m_verif->createVerifikasi($verif);


      return redirect()->to('/suratmasukl')->with('success', 'Disposisi berhasil dilakukan.');

    } else {
      return redirect()->to('/formDisposisi/' . $id)->with('error', 'Disposisi gagal dilakukan. harap centang instruksi');

    }
  }


  public function indexDisposisi()
  {


    $M_surat = new M_surat();




    $query = $M_surat->query("SELECT
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi AS dari,
     sl.tembusan,
    sl.filex,
    sl.is_active,
    GROUP_CONCAT(DISTINCT a.id_instansi ORDER BY a.id_instansi SEPARATOR ', ') AS id_untuk,
    GROUP_CONCAT(DISTINCT a.nm_instansi ORDER BY a.nm_instansi SEPARATOR ', ') AS untuk,
    GROUP_CONCAT(DISTINCT v.id_status SEPARATOR ',')as id_status,
    GROUP_CONCAT(DISTINCT v.id_user SEPARATOR ',')as id_user,
    GROUP_CONCAT(DISTINCT p.id_pegawai SEPARATOR ',')as id_pegawai,
    GROUP_CONCAT(DISTINCT ins.id_instruksi SEPARATOR ',')as id_instruksi,
    GROUP_CONCAT(DISTINCT ins.instruksi SEPARATOR '<br>')as instruksi
  FROM
    t_surat sl
  LEFT JOIN
    t_instansi i ON sl.id_instansi = i.id_instansi
  LEFT JOIN
    t_instansi a ON FIND_IN_SET(a.id_instansi, sl.id_sendto)
  JOIN
    t_sifat s ON sl.id_sifat = s.id_sifat
  JOIN
    t_jenis_surat j ON sl.id_jenis_surat = j.id_jenis_surat
  LEFT JOIN
    t_verifikasi v ON v.id_surat = sl.id_surat
    left join t_status st on FIND_IN_SET(st.id_status,v.id_status)
    LEFT JOIN t_disposisi d on d.id_surat_dispos=sl.id_surat
    LEFT JOIN t_instruksi ins ON FIND_IN_SET(ins.id_instruksi,d.id_instruksi)
    JOIN v_pegawai p on FIND_IN_SET(p.id_pegawai,d.id_pegawai_tujuan) and FIND_IN_SET('" . idPegawai() . "',d.id_pegawai_tujuan)
    LEFT JOIN users u on FIND_IN_SET(u.id,v.id_user)
  WHERE
    sl.id_jenis_surat in (3) and
    sl.is_active in (1)
  GROUP BY
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi,
    sl.tembusan,
    sl.filex;");



    $sumas = $query->getResultArray();

    $data = [
      'title' => 'Surat Masuk',
      'sumas' => $sumas
    ];

    return view('public/lldikti/surat_masukdisposisi', $data);
  }

  public function konfirmasi()
  {
    $M_verif = new M_verifikasi();
    $userId = idUser();
    $id_surat = $this->request->getPost('id_surat');
    $data = [
      'id_surat' => $id_surat,
      'id_status' => '10',
      'id_user' => $userId
    ];
    $M_verif->createVerifikasi($data);
    return $this->response->setStatusCode(200)->setBody('Konfirmasi berhasil');
  }


  public function konfirmasidis()
  {
    $M_verif = new M_verifikasi();
    $userId = idUser();
    $id_surat = $this->request->getPost('id_surat');
    $data = [
      'id_surat' => $id_surat,
      'id_status' => '10',
      'id_user' => $userId
    ];
    $M_verif->createVerifikasi($data);
    return $this->response->setStatusCode(200)->setBody('Konfirmasi berhasil');
  }


  public function dilihatOleh($idSurat)
  {
    $M_surat = new M_surat();
    $m_verif = new M_verifikasi();

    $dataVer = [
      'id_surat' => $idSurat,
      'id_status' => '5',
      'id_user' => idUser(),
    ];
    $m_verif->createVerifikasi($dataVer);

    $M_surat->tambahDilihatOleh($idSurat, user()->email);
    return $this->response->setJSON(['message' => 'Pengguna ditambahkan ke daftar dilihat']);
  }
}
