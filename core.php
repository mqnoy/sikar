<?php
session_start();
require 'include/model.php';


function login($_username, $_password)
{
    $model = selectOneAccess($_username, $_password);

    // jika sukses di temukan maka masukan dalam session
    if ($model != null) {
        foreach ($model as $data_akses) {
            var_dump($data_akses);
            $_SESSION['ses_username'] = $data_akses['username'];
            $_SESSION['ses_password'] = $data_akses['password'];
            $_SESSION['ses_level'] = $data_akses['level'];
            $_SESSION['ses_kar_id'] = $data_akses['kar_id'];
            $_SESSION['is_logged'] = true;
        }

        if (isset($_SESSION['is_logged']) && isset($_SESSION['ses_username']) && isset($_SESSION['ses_password'])) {
            header('Location: index.php?halaman=utama'); // berhasil login
        } else {
            header('Location: login.php?msg=sesi_gagal'); // gagal set sessi
        }
    } else {
        header('Location: login.php?msg=akses_gagal'); //username atau password salah
    }
}

// fungsi untuk tampilkan data ke table 
function tampilDataAkses()
{
    if ($_SESSION['ses_level'] == 'admin') {
        $model = selectAccess();
        return $model;
    }
}

// fungsi untuk tampilkan data ke table 
function tampilDataKaryawan()
{
    if ($_SESSION['ses_level'] == 'admin') {
        $model = selectKaryawan();
        return $model;
    }
}

// fungsi untuk tampilkan data ke halaman utama 
function tampilDataLengkap($id_kar, $username)
{
    $model = selectOneDataAll($id_kar, $username);
    return $model;
}

/// fungi untuk insert data akses
function tambahDataAkses($nik, $tgl_lahir, $jkel, $nama_karyawan, $size_seragam, $jrk_tempuh, $username, $password, $level, $kilometer)
{
    if ($_SESSION['ses_level'] == 'admin') {
        $lastID_insertKar = insertKaryawan($nik, $tgl_lahir, $jkel, $nama_karyawan, $size_seragam, $jrk_tempuh, $kilometer);
        insertAccess($username, md5($password), $lastID_insertKar, $level);
    }
}

/// untuk check data karyawan , sebelum insert
function checkDataKaryawan($nik)
{
    if ($_SESSION['ses_level'] == 'admin') {
        $data_karyawan = selectOneKaryawan($nik);
        return $data_karyawan;
    }
}
