<?php

namespace App\Controllers\Users\Pts;

use App\Models\M_surat;

use App\Controllers\BaseController;

class Surat_masukp extends BaseController
{


  public function index($id_instansi = null, $id_wilayah = null)
  {

    $M_surat = new M_surat();
    $instansiId = idInstansi();
    $wilayahId = idWilayah();
    $idInstansiParam = (isset($id_instansi) && !empty($id_instansi)) ? $id_instansi : "'" . $instansiId . "'";
    $idWilayahParam = (isset($id_wilayah) && !empty($id_wilayah)) ? $id_wilayah : "'" . $wilayahId . "'";

    // dd($idInstansiParam);

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
    st.status,
    st.id_status,
    sl.tembusan,
    sl.filex
    FROM
    t_surat sl
    LEFT JOIN t_instansi i ON sl.id_instansi = i.id_instansi
    LEFT JOIN t_template_wil tw ON sl.id_surat = tw.id_surat
    LEFT JOIN t_instansi a ON FIND_IN_SET(a.id_instansi, tw.id_template_wil) OR a.id_wilayah = tw.id_wilayah
    JOIN t_sifat s ON sl.id_sifat = s.id_sifat
    JOIN t_jenis_surat j ON sl.id_jenis_surat = j.id_jenis_surat
    LEFT JOIN t_verifikasi v on v.id_surat=sl.id_surat
    LEFT JOIN t_status st ON st.id_status = v.id_status
    WHERE
    sl.id_jenis_surat = '1'
    and sl.stts_confirm='1'
    AND tw.id_surat IS NOT NULL
    AND (
  (tw.id_template_wil IS NULL AND FIND_IN_SET(" . $idWilayahParam . ", tw.id_wilayah) > 0) 
 OR
  (FIND_IN_SET(" . $idInstansiParam . ", tw.id_template_wil) > 0 AND tw.id_wilayah IS NULL)
)
    GROUP BY
    sl.id_surat,
    sl.perihal,
    sl.nomor_surat,
    s.sifat,
    sl.tgl_surat,
    j.jenis_surat,
    i.nm_instansi,
    st.status,
    st.id_status,
    sl.tembusan,
    sl.filex");


    $users = $query->getResultArray();




    $data = [
      'title' => 'Surat Masuk PTS',
      'sumas' => $users
    ];



    return view('public/pts/surat_masuk', $data);
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

  public function get_notifikasip()
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
}
