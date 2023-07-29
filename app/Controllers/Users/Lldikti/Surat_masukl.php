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
    v.id_status,
    sl.tembusan,
    sl.filex,
    sl.is_active
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
  WHERE
    sl.id_jenis_surat in (3) and
    sl.is_active in (0)
  GROUP BY
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi,
    v.id_status,
    sl.tembusan,
    sl.filex;");

    $M_disposisi = new M_disposisi();
    $dislldikti = $M_disposisi->query("SELECT s.id_surat_dispos, GROUP_CONCAT(s.id_pegawai_tujuan SEPARATOR '<br>') as id_tujuan, ll.nomor_surat AS nos,j.id_jenis_surat, GROUP_CONCAT(p.nama_lengkap SEPARATOR '<br>') AS nama_lengkap,s.tanggal_disposisi
        FROM db_persuratan.t_disposisi s
        LEFT JOIN db_persuratan.t_surat ll ON ll.id_surat = s.id_surat_dispos
        JOIN db_persuratan.t_jenis_surat j ON j.id_jenis_surat = s.id_jenis_surat
        JOIN db_pegawai.t_pegawai p ON FIND_IN_SET(p.id_pegawai, s.id_pegawai_tujuan) > 0
        WHERE j.id_jenis_surat = 3
        GROUP BY s.id_surat_dispos,s.tanggal_disposisi
        ORDER BY s.id_surat_dispos;");




    $users = $query->getResultArray();
    $disposll = $dislldikti->getResultArray();

    $m_pegawai = new M_pegawai();
    $daftarPegawai = $m_pegawai->findAll();


    $daftarPegawaiFiltered = array_filter($daftarPegawai, function ($pegawai) {
      return $pegawai['id_pegawai'] != 0 && $pegawai['id_pegawai'] != 3;
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

    $userId = idUser();
    $id = $this->request->getPost('id_surat');
    $pegawai = $this->request->getPost('daftarpegawai');
    $instruksi = $this->request->getPost('instruksi');
    $pegawaiString = implode(",", $pegawai);
    $instrukString = implode(",", $instruksi);
    $disposisiModel = new M_disposisi();
    $m_verif = new M_verifikasi();


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


    if ($this->request->getPost('simpan')) {
      $pegawai = $this->request->getPost('daftarpegawai');
      $instruksi = $this->request->getPost('instruksi');
      $pegawaiString = implode(",", $pegawai);
      $instrukString = implode(",", $instruksi);

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
    }

    return redirect()->to('/suratmasukl')->with('success', "SUKSES");
  }


  public function get_notifikasil()
  {
    $M_surat = new M_surat();
    $countNotiflldiktiMasuk = $M_surat->query("SELECT COUNT(id_status) as notif
                FROM t_surat
                WHERE id_jenis_surat = '3' AND id_status = '0';");

    // Ambil nilai hitungan notifikasi dari query Anda
    $notifikasil = $countNotiflldiktiMasuk->getRow()->notif;

    // Kembalikan nilai hitungan notifikasi sebagai respons Ajax
    echo $notifikasil;
  }


  public function reset_notifikasi()
  {
    $M_surat = new M_surat();
    $M_surat->query("UPDATE t_surat SET id_status = '5' WHERE id_jenis_surat = '3';");
  }



  public function indexDisposisi()
  {


    $M_surat = new M_surat();

    $id = idPegawai();


    $query = $M_surat->query("SELECT
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi AS dari,
    GROUP_CONCAT(DISTINCT d.id_instruksi SEPARATOR ', ') AS id_instruksi,
    GROUP_CONCAT(DISTINCT ins.instruksi SEPARATOR '<br> ') AS instruksi,
    GROUP_CONCAT(DISTINCT p.id_pegawai SEPARATOR ', ') AS id_pegawai,
    GROUP_CONCAT(DISTINCT p.nama_lengkap SEPARATOR '<br> ') AS pegawai,
    GROUP_CONCAT(DISTINCT a.id_instansi ORDER BY a.id_instansi SEPARATOR ', ') AS id_untuk,
    GROUP_CONCAT(DISTINCT a.nm_instansi ORDER BY a.nm_instansi SEPARATOR ', ') AS untuk,
    v.id_status,
    sl.tembusan,
    sl.filex,
    sl.is_active
FROM
    t_surat sl
LEFT JOIN
    t_instansi i ON sl.id_instansi = i.id_instansi
LEFT JOIN
    t_instansi a ON FIND_IN_SET(a.id_instansi, sl.id_sendto)
    LEFT JOIN t_verifikasi v on v.id_surat=sl.id_surat
JOIN
    t_sifat s ON sl.id_sifat = s.id_sifat
JOIN
    t_jenis_surat j ON sl.id_jenis_surat = j.id_jenis_surat
LEFT JOIN
    t_disposisi d ON d.id_surat_dispos = sl.id_surat
JOIN
    db_pegawai.t_pegawai p ON FIND_IN_SET(p.id_pegawai, d.id_pegawai_tujuan) AND FIND_IN_SET('" . $id . "',d.id_pegawai_tujuan)
LEFT JOIN
    t_instruksi ins ON FIND_IN_SET(ins.id_instruksi, d.id_instruksi)
WHERE
    sl.id_jenis_surat = 3 AND
    sl.is_active = 0
GROUP BY
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi,
    v.id_status,
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
      'id_status' => '10',
      'id_user' => $userId
    ];
    $M_verif->updateVerifikasi($id_surat, $data);
    return $this->response->setStatusCode(200)->setBody('Konfirmasi berhasil');
  }
}
