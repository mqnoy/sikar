<?php
session_start();
require 'include/model.php';


function login($_username, $_password)
{
    $data_akses = selectOneAccess($_username, $_password);

    // jika sukses di temukan maka masukan dalam session
    if ($data_akses != null) {
        foreach ($data_akses as $data_akses) {

            $select_karyawan = selectOneKaryawan(null, $data_akses['kar_id']);
            foreach ($select_karyawan as $data_karyawan) {
                $_SESSION['ses_username'] = $data_akses['username'];
                $_SESSION['ses_password'] = $data_akses['password'];
                $_SESSION['ses_level'] = $data_akses['level'];
                $_SESSION['ses_kar_id'] = $data_karyawan['id'];
                $_SESSION['ses_kar_nik'] = $data_karyawan['nik'];
                $_SESSION['is_logged'] = true;
            }
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

function updateSession($username, $password, $level, $nik)
{
    $_SESSION['ses_username'] = $username;
    $_SESSION['ses_password'] = $password;
    $_SESSION['ses_level'] = $level;
    $_SESSION['ses_kar_nik'] = $nik;
}

/// @param km
/// @return integer
function kalkulasi($raw_km)
{
    $const = 8000;
    $km = (int) $raw_km; //cast to int
    return $km * $const;
}

// fungsi untuk tampilkan data ke table 
function tampilDataAkses($keywords = null)
{
    if ($_SESSION['ses_level'] == 'admin') {
        $model = selectAccess($keywords);
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
        $lastID_insertKar = insertKaryawan($nik, $tgl_lahir, $jkel, $nama_karyawan);
        $lastID_insertAcc = insertAccess($username, md5($password), $level);
        if ($lastID_insertKar > 0 && $lastID_insertAcc > 0) {
            $insert_detail_data = insertDetailKaryawan($lastID_insertAcc, $lastID_insertKar, $size_seragam, $jrk_tempuh, $kilometer);
        }else{
            return false;
        }
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
