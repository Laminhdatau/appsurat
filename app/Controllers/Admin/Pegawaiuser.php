<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_user;
use App\Models\M_userpegawai;
use App\Models\M_wilayah;

class Pegawaiuser extends BaseController
{

    public function index()
    {
        $M_user = new M_user();
        $M_wilayah = new M_wilayah();
        $db = db_connect();
        $user = $M_user->findAll();
        $wilayah = $M_wilayah->findAll();
        $dpdikti = $db->query("SELECT p.id_pegawai,p.nama_lengkap,p.jabatan,p.nip,p.id_instansi,i.nm_instansi,w.id_wilayah,w.wilayah,u.email,u.username,u.user_image
        FROM v_pegawai p
        , t_user_pegawai up 
        , t_instansi i
        , users u
        ,t_wilayah w
        WHERE p.id_instansi=i.id_instansi
        and i.id_wilayah=up.id_wilayah
        and u.id=up.id_user
        and p.id_pegawai=up.id_pegawai
        and w.id_wilayah=up.id_wilayah
        and i.id_wilayah=w.id_wilayah
        and p.id_instansi = '0'
        ")->getResultArray();

     

        $pegawai = $db->query("SELECT * FROM v_pegawai where id_instansi ='0' and id_pegawai not in (SELECT id_pegawai from t_user_pegawai)")->getResultArray();

        $data = [
            'title' => 'User Pegawai',
            'users' => $user,
            'datadikti' => $dpdikti,
            'wilayah' => $wilayah,
            'pegawai' => $pegawai
        ];

        return view('private/manuser/userpegawail', $data);
    }





    public function userpegawaip()
    {
        $M_user = new M_user();
        $M_wilayah = new M_wilayah();
        $db = db_connect();
        $user = $M_user->findAll();
        $wilayah = $M_wilayah->findAll();


        $dppts = $db->query("SELECT p.id_pegawai,p.nama_lengkap,p.jabatan,p.nip,p.id_instansi,i.nm_instansi,w.id_wilayah,w.wilayah,u.email,u.username,u.user_image
        FROM v_pegawai p
        , t_user_pegawai up 
        , t_instansi i
        , users u
        ,t_wilayah w
        WHERE p.id_instansi=i.id_instansi
        and i.id_wilayah=up.id_wilayah
        and u.id=up.id_user
        and p.id_pegawai=up.id_pegawai
        and w.id_wilayah=up.id_wilayah
        and i.id_wilayah=w.id_wilayah
        and p.id_instansi != '0'")->getResultArray();

        $pegawai = $db->query("SELECT * FROM v_pegawai where id_instansi !='0' and id_pegawai not in (SELECT id_pegawai from t_user_pegawai)")->getResultArray();

        $data = [
            'title' => 'User Pegawai PTS',
            'users' => $user,
            'datapts' => $dppts,
            'wilayah' => $wilayah,
            'pegawai' => $pegawai
        ];

        return view('private/manuser/userpegawaip', $data);
    }

    public function addPegawaiUserp()
    {
        $user = $this->request->getPost('user');
        $pegawai = $this->request->getPost('pegawai');
        $wilayah = $this->request->getPost('wilayah');

        $M_userpegawai = new M_userpegawai();
        $data = [
            'id_user' => $user,
            'id_pegawai' => $pegawai,
            'id_wilayah' => $wilayah
        ];

        $M_userpegawai->insert($data);
        return redirect()->to('pegawaiuserp');
    }


    public function addPegawaiUserl()
    {
        $user = $this->request->getPost('user');
        $pegawai = $this->request->getPost('pegawai');
        $wilayah = $this->request->getPost('wilayah');

        $M_userpegawai = new M_userpegawai();
        $data = [
            'id_user' => $user,
            'id_pegawai' => $pegawai,
            'id_wilayah' => $wilayah
        ];

        $M_userpegawai->insert($data);
        return redirect()->to('pegawaiuserl');
    }

    public function removePegawaiUserp($id)
    {
        $M_userpegawai = new M_userpegawai();
        $M_userpegawai->delete($id);

        return redirect()->to('pegawaiuserp');
    }

    public function removePegawaiUserl($id)
    {
        $M_userpegawai = new M_userpegawai();
        $M_userpegawai->delete($id);

        return redirect()->to('pegawaiuserl');
    }
}
