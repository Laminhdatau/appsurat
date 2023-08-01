<?php

use App\Models\M_userpegawai;

if (!function_exists('idUser')) {
    function idUser()
    {
        $userId = user_id();
        if ($userId) {
            return $userId;
        }

        return null;
    }
}

if (!function_exists('idPegawai')) {
    function idPegawai()
    {
        $m_userpegawai = new M_userpegawai();
        $userId = idUser();
        if ($userId) {
            $userPegawai = $m_userpegawai->where('id_user', $userId)->first();
            if ($userPegawai) {
                return $userPegawai['id_pegawai'];
            }
        }
        return null;
    }
}


if (!function_exists('idInstansi')) {
    function idInstansi()
    {
        $db = db_connect();
        $idPegawai = idPegawai();
        if ($idPegawai) {
            $pegawai = $db->query('SELECT * from v_pegawai where id_pegawai="' . $idPegawai . '"')->getRow();
            if ($pegawai) {
                return $pegawai->id_instansi;
            }
        }
        return null;
    }
}

if (!function_exists('idWilayah')) {
    function idWilayah()
    {
        $m_userpegawai = new M_userpegawai();

        $db = db_connect();
        $m_userpegawai = new M_userpegawai();
        $userId = idUser();
        if ($userId) {
            $userPegawai = $m_userpegawai->where('id_user', $userId)->first();
            if ($userPegawai) {

                return $userPegawai['id_wilayah'];
            }
        }
        return null;
    }
}

if (!function_exists('dataPegawai')) {
    function dataPegawai()
    {
        $db = db_connect();
        $pegawai = $db->query('SELECT * from v_pegawai')->getResult();
        if ($pegawai) {
            return $pegawai;
        }
        return null;
    }
}

if (!function_exists('dataPersonal')) {
    function dataPersonal()
    {
        $db = db_connect();
        $idp = idPegawai();
        $pegawai = $db->query('SELECT * from v_pegawai where id_pegawai="' . $idp . '"')->getRow();
        if ($pegawai) {
            return $pegawai;
        }
        return null;
    }
}

if (!function_exists('verifikator')) {
    function verifikator()
    {
        $db = db_connect();
        $idp = idPegawai();
        $verifikator = $db->query("SELECT v.id_surat_tugas,count(v.id_surat_tugas) as jum_surat,
        CASE 
           WHEN COUNT(DISTINCT(v.verifikator)) = 1 THEN MAX(v.verifikator)
           ELSE GROUP_CONCAT(v.verifikator SEPARATOR ',')
        END AS verifikator,
        COUNT(v.verifikator) AS jumlah_verifikator
 FROM t_surat_tugas v
 ,v_pegawai p 
 WHERE FIND_IN_SET(p.id_pegawai, v.verifikator) and
 FIND_IN_SET('" . $idp . "', v.verifikator)
 GROUP BY v.id_surat_tugas
 ORDER BY v.id_surat_tugas")->getRow();
        if ($verifikator) {
            return $verifikator;
        }
        return null;
    }
}


if (!function_exists('dataVerifikator')) {
    function dataVerifikator()
    {
        $db = db_connect();
        $dverif = $db->query("SELECT v.id_surat_tugas,
        CASE 
           WHEN COUNT(DISTINCT(v.verifikator)) = 1 THEN MAX(v.verifikator)
           ELSE GROUP_CONCAT(v.verifikator SEPARATOR ',')
        END AS verifikator,
        COUNT(v.verifikator) AS jumlah_verifikator
 FROM t_surat_tugas v
 INNER JOIN v_pegawai p ON FIND_IN_SET(p.id_pegawai, v.verifikator)
 GROUP BY v.id_surat_tugas
 ORDER BY v.id_surat_tugas")->getRow();
        if ($dverif) {
            return $dverif;
        }
        return null;
    }
}


if (!function_exists('t_verifikasi')) {
    function t_verifikasi()
    {
        $db = db_connect();
        $data = $db->query("select v.*,u.username from users u 
        ,t_verifikasi v 
        where v.id_user=u.id")->getRow();
        if ($data) {
            return $data;
        }
        return null;
    }
}

if (!function_exists('uprov')) {
    function uprov()
    {
        $idu = idUser();
        $db = db_connect();
        $data = $db->query("select v.*,u.username from users u 
        ,t_verifikasi v 
        where v.id_user=u.id and v.id_user='" . $idu . "'")->getRow();
        if ($data) {
            return $data;
        }
        return null;
    }
}


if (!function_exists('notifSurat')) {
    function notifSurat()
    {
        $idu = idUser();
        $db = db_connect();
        $data = $db->query("select v.*,u.username from users u 
        ,t_verifikasi v 
        where v.id_user=u.id and v.id_user='" . $idu . "'")->getRow();
        if ($data) {
            return $data;
        }
        return null;
    }
}
