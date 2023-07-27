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
    }

    return null;
}


if (!function_exists('dataPegawai')) {
    function dataPegawai()
    {
        $db = db_connect();
        $m_userpegawai = new M_userpegawai();

        $userId = idUser();
        if ($userId) {
            $userPegawai = $m_userpegawai->where('id_user', $userId)->first();
            if ($userPegawai) {
                $pegawaiId = $userPegawai['id_pegawai'];
                $pegawai = $db->query('SELECT * from v_pegawai where id_pegawai="' . $pegawaiId . '"')->getResult();
                if ($pegawai) {
                    return $pegawai;
                }
            }
        }

        return null;
    }
}
