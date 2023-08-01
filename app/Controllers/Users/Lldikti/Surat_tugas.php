<?php

namespace App\Controllers\Users\Lldikti;

use App\Models\M_reff;
use App\Models\M_surgas;
use App\Models\M_userpegawai;
use App\Models\M_surgas_pegawai;
use App\Models\M_pegawai;
use App\Models\M_status;
use App\Models\M_kop;
use Ramsey\Uuid\Uuid;
use CodeIgniter\Controller;
use RuntimeException;

use CodeIgniter\HTTP\URI;


use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Dompdf\Dompdf;
use App\Controllers\BaseController;
use App\Models\M_surat;
use App\Models\M_verifikasi;

class Surat_tugas extends BaseController
{


    public function index()
    {

        $m_reff = new M_reff();

        $m_surgas = new M_surgas();
        $m_pegawai = new M_pegawai();
        $kodeSurat = $m_reff->findAll();
        $idUser = idUser();
        $idPegawai = idPegawai();
        $isAdmdikti = in_groups('admdikti');
        $verifikator = verifikator();

        
        if ($idUser == '16') {
            $active = "WHERE st.is_active='1'";
        } else if (!$isAdmdikti || $isAdmdikti) {
            $active = "WHERE st.created_by='$idUser'";
        } else if ($verifikator->verifikator) {
            $active = "WHERE FIND_IN_SET('$idPegawai', st.verifikator)";
        } else {
            $active = '';
        }


        $querySurgas = $m_surgas->query("SELECT
        st.*,
        j.jenis_surat,
        n.nomor_surat,
        n.perihal,
        GROUP_CONCAT(DISTINCT p.id_pegawai) AS ids_pegawai,
        GROUP_CONCAT(DISTINCT p.nama_lengkap SEPARATOR '<br> ') AS nama_pegawai,
        IF(COUNT(DISTINCT v.id_status) = 1, MAX(v.id_status), GROUP_CONCAT(DISTINCT v.id_status ORDER BY v.id_status)) AS id_status
    FROM
        t_surat_tugas st
        LEFT JOIN t_surat_tugas_pegawai tp ON tp.id_surat_tugas = st.id_surat_tugas
        LEFT JOIN db_pegawai.t_pegawai p ON FIND_IN_SET(p.id_pegawai, tp.id_pegawai_string) > 0
        JOIN t_jenis_surat j ON j.id_jenis_surat = st.id_jenis_surat
        LEFT JOIN t_reff_surat n ON n.nomor_surat = SUBSTRING_INDEX(SUBSTRING_INDEX(st.id_nomor_surat, '/', -2), '/', 1)
        LEFT JOIN t_verifikasi v on v.id_surat=st.id_surat_tugas
        LEFT JOIN t_status s on s.id_status=v.id_status
        " . $active . "
    GROUP BY
        st.id_surat_tugas, n.id_reff_surat, v.id_surat
    order by create_at desc
    
    ");



        $surgas = $querySurgas->getResultArray();
        $pegawai = $m_pegawai->where('id_pegawai !=', 0)->findAll();
        $pegawaiverify = $m_pegawai->where('id_pegawai in(select id_pegawai from db_persuratan.t_user_pegawai)')->findAll();


        $data = [
            'title' => "Surat Tugas",
            'kodeSurat' => $kodeSurat,
            'surgas' => $surgas,
            'pegawai' => $pegawai,
            'pegawaiverif' => $pegawaiverify
        ];



        return view('public/lldikti/surat_tugas', $data);
    }


    public function createSurgas()
    {
        $m_surgas = new M_surgas();
        $uuid = Uuid::uuid4()->toString();
        $nosur = $this->request->getPost('kodesurat');
        $lastSurat = $m_surgas->getLastSurat();
        $maximumNumber = intval($lastSurat);

        $no = $maximumNumber + 1;


        $isUnique = $m_surgas->checkUniqueNomorSurat($no);

        while (!$isUnique) {
            $no++;
            $isUnique = $m_surgas->checkUniqueNomorSurat($no);
        }

        $no = str_pad($no, 2, '0', STR_PAD_LEFT);


        $data = [
            'id_surat_tugas' => $uuid,
            'id_jenis_surat' => 6,
            'id_nomor_surat' =>  $no . '/LL16/' . $nosur . '/' . date('Y'),
            'tgl_mulai' => $this->request->getPost('tgl_mulai'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'tujuan_surat' => $this->request->getPost('tujuan'),
            'tempat_pelaksanaan' => $this->request->getPost('lokasi'),
            'tembusan' => $this->request->getPost('tembusan'),
            'id_pejabat' => $this->request->getPost('id_pejabat'),
            'dasar' => $this->request->getPost('dasar'),
            'is_active' => 0,
            'created_by' => idUser()
        ];

        $m_surgas->saveSurgas($data);



        return redirect()->to('surattugas');
    }

    public function updateSurgas($id)
    {
        $m_surgas = new M_surgas();
        $nosur = $this->request->getPost('kodesurat');
        $lastSurat = $m_surgas->getLastSurat();
        $maximumNumber = intval($lastSurat);

        $no = $maximumNumber + 1;
        $isUnique = $m_surgas->checkUniqueNomorSurat($no);

        while (!$isUnique) {
            $no++;
            $isUnique = $m_surgas->checkUniqueNomorSurat($no);
        }

        $no = str_pad($no, 2, '0', STR_PAD_LEFT);


        $data = [
            'id_jenis_surat' => 6,
            'id_nomor_surat' =>  $no . '/LL16/' . $nosur . '/' . date('Y'),
            'tgl_mulai' => $this->request->getPost('tgl_mulai'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'tujuan_surat' => $this->request->getPost('tujuan'),
            'tempat_pelaksanaan' => $this->request->getPost('lokasi'),
            'tembusan' => $this->request->getPost('tembusan'),
            'id_pejabat' => $this->request->getPost('id_pejabat'),
            'is_active' => 0,
        ];

        $m_surgas->updateSurgas($id, $data);



        return redirect()->to('surattugas');
    }

    public function BookingNumber()
    {
        $m_surgas = new M_surgas();
        $uuid = Uuid::uuid4()->toString();
        $nosur = $this->request->getPost('kodesurat');
        $lastSurat = $m_surgas->getLastSurat();
        $maximumNumber = intval($lastSurat);

        $no = $maximumNumber + 1;
        $isUnique = $m_surgas->checkUniqueNomorSurat($no);

        while (!$isUnique) {
            $no++;
            $isUnique = $m_surgas->checkUniqueNomorSurat($no);
        }

        $no = str_pad($no, 2, '0', STR_PAD_LEFT);
        $data = [
            'id_surat_tugas' => $uuid,
            'id_jenis_surat' => 6,
            'id_nomor_surat' =>  $no . '/LL16/' . $nosur . '/' . date('Y'),
            'is_active' => 0,
            'created_by' => idUser()
        ];

        $m_surgas->saveSurgas($data);
        return redirect()->to('surattugas');
    }

    public function addPegawaiSpt()
    {
        $id_surat = $this->request->getPost('id_surat_tugas');
        $id_pegawai_string = $this->request->getPost('pegawai');
        $id_pegawai_array = implode(",", $id_pegawai_string);
        $m_surgas_pegawai = new M_surgas_pegawai();
        $m_surgas = new M_surgas();
        $data = [
            'id_surat_tugas' => $id_surat,
            'id_pegawai_string' => $id_pegawai_array
        ];

        $m_surgas_pegawai->saveSurgasPegawai($data);

        return redirect()->to('surattugas');
    }

    public function updatePegawaiSpt()
    {
        $id = $this->request->getPost('id_surat_tugas');
        $id_pegawai_string = $this->request->getPost('pegawai');
        $id_pegawai_array = implode(",", $id_pegawai_string);
        $m_surgas_pegawai = new M_surgas_pegawai();
        $data = [
            'id_pegawai_string' => $id_pegawai_array
        ];
        $m_surgas_pegawai->where('id_surat_tugas', $id);
        $m_surgas_pegawai->set($data)->update();
        return redirect()->to('surattugas');
    }

    public function addverifikator()
    {
        $verify = $this->request->getPost('verify');
        $verifyarray = implode(",", $verify);
        $id_surat = $this->request->getPost('id_surat_tugas');
        $m_surgas = new M_surgas();
        $dataStatus = [
            'tanggal_terbit' => date('Y-m-d H:i:s'),
            'verifikator' => $verifyarray
        ];
        $m_surgas->updateSurgas($id_surat, $dataStatus);
        return redirect()->to('surattugas');
    }


    public function verify()
    {
        $m_verif = new M_verifikasi();
        $m_surgas = new M_surgas();
        $userId = idUser();
        $id_surat = $this->request->getPost('id_surat_tugas');
        $uprov = $this->request->getPost('uprov');

        $data = [
            'id_surat' => $id_surat,
            'id_status' => $uprov,
            'id_user' => $userId
        ];

        $m_verif->createVerifikasi($data);

        switch ($uprov) {
            case '12':
                $surgas = [
                    'is_active' => '1'
                ];
                $m_surgas->updateSurgas($id_surat, $surgas);
            default:
                break;
        }
        return redirect()->to('surattugas');
    }

    public function tandaTangan()
    {
        $m_surgas = new M_surgas();
        $m_verif = new M_verifikasi();
        $id_surat = $this->request->getPost('id_surat_tugas');
        $status = $this->request->getPost('status');
        switch ($status) {
            case '1':
                $qrCodeText = base_url('lihatTte/' . $id_surat);
                $qrCodeSize = 150;
                $qrCode = QrCode::create($qrCodeText)
                    ->setEncoding(new Encoding('UTF-8'))
                    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                    ->setSize($qrCodeSize)
                    ->setForegroundColor(new Color(0, 0, 0))
                    ->setBackgroundColor(new Color(255, 255, 255));

                $logo = Logo::create(FCPATH . '/favicon.ico')
                    ->setResizeToWidth(20);

                // Create writer and write QR code
                $writer = new PngWriter();
                $result = $writer->write($qrCode, $logo);

                // Save QR code as image file
                $qrCodeImagePath = 'assets/docsurgas/qrcode/' . $id_surat . '.jpg';
                $result->saveToFile($qrCodeImagePath);

                $dataStatus = [
                    'tanggal_terbit' => date('Y-m-d H:i:s'),
                    'id_penandatangan' => idPegawai(),
                    'is_active' => 1,
                    'qr_code_image_path' => $qrCodeImagePath
                ];

                $m_surgas->updateSurgas($id_surat, $dataStatus);

                $stts = [
                    'id_surat' => $id_surat,
                    'id_status' => $status,
                    'id_user' => idUser()
                ];

                $m_verif->createVerifikasi($stts);


                break;
            case '2':
                $stts = [
                    'id_surat' => $id_surat,
                    'id_status' => $status,
                    'id_user' => idUser()
                ];

                $m_verif->createVerifikasi($stts);

                break;
            case '3':

                $stts = [
                    'id_surat' => $id_surat,
                    'id_status' => $status,
                    'id_user' => idUser()
                ];

                $m_verif->createVerifikasi($stts);
                break;
            default:
                break;
        }
        return redirect()->to('surattugas');
    }



    public function showDocumentTte()
    {
        $segment2 = $this->request->uri->getSegment(2);
        $m_surgas = new M_surgas();
        $surgasquery = $m_surgas->query("SELECT
        st.id_surat_tugas,
        st.id_nomor_surat,
        st.tanggal_terbit,
        tp.id_pegawai_string,
        p.nama_lengkap AS penandatangan,
        p.jabatan,
        st.tujuan_surat,
        st.tempat_pelaksanaan,
        GROUP_CONCAT(ps.nama_lengkap SEPARATOR '<br> ') AS pegawaistring
    FROM
        t_surat_tugas st
    LEFT JOIN
        db_pegawai.t_pegawai p ON p.id_pegawai = st.id_penandatangan
    LEFT JOIN
        t_surat_tugas_pegawai tp ON tp.id_surat_tugas = st.id_surat_tugas
    LEFT JOIN 
        db_pegawai.t_pegawai ps ON FIND_IN_SET(ps.id_pegawai, tp.id_pegawai_string) > 0
       WHERE
        st.id_surat_tugas IN ('" . $segment2 . "')
    GROUP BY
        st.id_surat_tugas, st.id_nomor_surat, st.tanggal_terbit,tp.id_pegawai_string, p.nama_lengkap, p.jabatan;");


        $surgas = $surgasquery->getRow();

        $tanggal_terbit = $surgas->tanggal_terbit;

        $tgl = date('d', strtotime($tanggal_terbit));
        $bln = date('m', strtotime($tanggal_terbit));
        $thn = date('Y', strtotime($tanggal_terbit));

        $bulanarray = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );
        $bulan = $bulanarray[$bln];
        $data = [
            'title' => "Tanda Tangan",
            'surgas' => $surgas,
            'tglterbit' => $tgl . ' ' . $bulan . ' ' . $thn

        ];
        return view('public/data-qrcode', $data);
    }


    public function SeeTo($idSurat)
    {
        $email = user()->email;
        $m_surgas = new M_surgas();
        $m_surgas->tambahDilihatOleh($idSurat, $email);
        return $this->response->setJSON(['message' => 'Pengguna ditambahkan ke daftar dilihat']);
    }




    public function DetailSuratPdf($id)
    {
        helper('dompdf');
        $m_surgas = new M_surgas();
        $m_kop = new M_kop();

        $querySurgas = $m_surgas->query("SELECT
        st.*,
        j.jenis_surat,
        n.nomor_surat,
        n.perihal,
        GROUP_CONCAT(p.id_pegawai) AS ids_pegawai,
        GROUP_CONCAT(p.jabatan SEPARATOR '<br>') AS jbtpegawai,
        GROUP_CONCAT(p.nama_lengkap SEPARATOR '<br> ') AS nama_pegawai,
        GROUP_CONCAT(p.nip SEPARATOR '<br> ') AS nip_pegawai,
        GROUP_CONCAT(p.pangkat SEPARATOR '<br> ') AS pangkat_pegawai,
        GROUP_CONCAT(p.golongan SEPARATOR '<br> ') AS gol_pegawai
    FROM
        t_surat_tugas st
        LEFT JOIN t_surat_tugas_pegawai tp ON tp.id_surat_tugas = st.id_surat_tugas
        LEFT JOIN db_pegawai.t_pegawai p ON FIND_IN_SET(p.id_pegawai, tp.id_pegawai_string) > 0
        JOIN t_jenis_surat j ON j.id_jenis_surat = st.id_jenis_surat
        LEFT JOIN t_reff_surat n ON n.nomor_surat = SUBSTRING_INDEX(SUBSTRING_INDEX(st.id_nomor_surat, '/', -2), '/', 1)
        where st.id_surat_tugas = '" . $id . "'
    GROUP BY
        st.id_surat_tugas,n.id_reff_surat
    ORDER BY
            month(st.tanggal_terbit)=month(now());
    ");

        $queryPenanda = $m_surgas->query("SELECT
    st.id_surat_tugas,st.id_penandatangan,p.nama_lengkap as nama_penanda,p.nip as np
FROM
    t_surat_tugas st
    LEFT JOIN db_pegawai.t_pegawai p ON p.id_pegawai=st.id_penandatangan
    where st.id_surat_tugas = '" . $id . "'");

        $surgas = $querySurgas->getRow();
        $tanda = $queryPenanda->getRow();

        $kop = $m_kop->findAll();
        $kopRow = array_shift($kop);


        $tanggal_terbit = $surgas->create_at;
        $tgl_mulai = $surgas->tgl_mulai;
        $tgl_selesai = $surgas->tgl_selesai;

        $namap = $surgas->nama_pegawai;
        $jbp = $surgas->jbtpegawai;
        $nip = $surgas->nip_pegawai;
        $pangkatp = $surgas->pangkat_pegawai;
        $golp = $surgas->gol_pegawai;

        $array_nama = explode("<br>", $namap);
        $array_jbp = explode("<br>", $jbp);
        $array_nip = explode("<br>", $nip);
        $array_pangkat = explode("<br>", $pangkatp);
        $array_gol = explode("<br>", $golp);


        // Buat array dalam array
        $data_pegawai = array();

        for ($i = 0; $i < count($array_nama); $i++) {
            $data_pegawai[] = array(
                'namap' => trim($array_nama[$i]),
                'jabatanp' => trim($array_jbp[$i]),
                'nipp' => trim($array_nip[$i]),
                'pangkatp' => trim($array_pangkat[$i]),
                'golonganp' => trim($array_gol[$i])
            );
        }

        // UNTUK TTD
        $tglttd = date('d', strtotime($tanggal_terbit));
        $blnttd = date('m', strtotime($tanggal_terbit));
        $thnttd = date('Y', strtotime($tanggal_terbit));

        // UNTUK TGL MULAI
        $tglm = date('d', strtotime($tgl_mulai));
        $bulm = date('m', strtotime($tgl_mulai));
        $tahm = date('Y', strtotime($tgl_mulai));

        // UNTUK TGL MULAI
        $tgls = date('d', strtotime($tgl_selesai));
        $buls = date('m', strtotime($tgl_selesai));
        $tahs = date('Y', strtotime($tgl_selesai));

        // Untuk TTD
        $bulan_array = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        $bulanttd = $bulan_array[$blnttd];
        $bulanmulai = $bulan_array[$bulm];
        $bulanselesai = $bulan_array[$buls];

        $gambarloop = $surgas->qr_code_image_path;
        $imageLoop = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/' . $gambarloop);
        $base64Loop = 'data:image/jpeg;base64,' . base64_encode($imageLoop);

        $imagePath = '/assets/img/tutwuri.png';
        $imageData = file_get_contents($_SERVER['DOCUMENT_ROOT'] . $imagePath);
        $base64Image = 'data:image/jpeg;base64,' . base64_encode($imageData);
        $data = [
            'surgas' => $surgas,
            'tte' => $tanda,
            'kopgambar' => $base64Image,
            'ttel' => $base64Loop,
            'tglttd' => $tglttd . ' ' . $bulanttd . ' ' . $thnttd,
            'tglmulai' => $tglm . ' ' . $bulanmulai . ' ' . $tahm,
            'tglselesai' => $tgls . ' ' . $bulanselesai . ' ' . $tahs,
            'tpegawai' => $data_pegawai,
            'kopr' => $kopRow
        ];

        // return view('public/lldikti/detail_surat_tugas',  $data);

        $html = view('public/lldikti/detail_surat_tugas',  $data);


        pdf_create($html, 'SPT-LLDIKTI-' . $surgas->nama_pegawai . '', true, 'A4', 'portrait');
    }


    public function getKodeSurat()
    {
        $keyword = $this->request->getVar('keyword');
        $kodeSuratModel = new M_reff(); // Gantikan 'KodeSuratModel' dengan model Anda yang sesuai
        $results = $kodeSuratModel->searchKodeSurat($keyword); // Buat metode 'searchKodeSurat()' pada model Anda
        return $this->response->setJSON($results);
    }



    public function addDasar()
    {
        $id = $this->request->getPost('id_surat_tugas');
        $dasar = $this->request->getPost('dasar');
        $dasarArray = implode('<br>', $dasar);

        $m_surgas = new M_surgas();
        $data = [
            'dasar' => $dasarArray
        ];

        $results = $m_surgas->updateSurgas($id, $data);

        return $this->response->setJSON($results);
    }
}
