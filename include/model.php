<?php
require 'database.php';

/// untuk login
function selectOneAccess($username, $password)
{
    $conn = koneksiDB();
    $res = [];
    $query = "SELECT * FROM tb_akses WHERE username='" . $username . "' AND password ='" . $password . "'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $res[] = $row;
    }

    return $res;
}

/// untuk select semua ke table acess
function selectAccess()
{
    $conn = koneksiDB();
    $res = [];
    $query = "SELECT * FROM tb_akses ta LEFT JOIN tb_karyawan tk ON ta.kar_id = tk.id";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $res[] = $row;
    }

    return $res;
}

/// untuk select semua table akses dan karyawan
function selectOneDataAll($id_kar, $username)
{
    $conn = koneksiDB();
    $res = [];
    $query = "SELECT * FROM tb_akses ta LEFT JOIN tb_karyawan tk ON ta.kar_id = tk.id WHERE tk.id = " . $id_kar . " AND ta.username='" . $username . "'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $res[] = $row;
    }

    return $res;
}

/// untuk insert ke table acess
/// @return last_insert_id
function insertAccess($username, $password, $kar_id, $level)
{
    //INSERT INTO `tb_akses` (`id`, `username`, `password`, `kar_id`, `level`, `date_inserted`) VALUES (NULL, 'admin', MD5('admin'), '1', 'admin', CURRENT_TIMESTAMP);
    $conn = koneksiDB();
    $query = "INSERT INTO tb_akses (username, password, kar_id, level) VALUES ('" . $username . "','" . $password . "'," . $kar_id . ",'" . $level . "')";

    $execute = mysqli_query($conn, $query);
    return $execute;
}

/// untuk update ke table acess
function updateAccess($username, $password)
{
    $conn = koneksiDB();
    $query = "UPDATE tb_akses SET password='" . $password . "' WHERE username='" . $username . "'";
    $execute = mysqli_query($conn, $query);
    return $execute;
}

/// untuk delete ke table acess
function deleteAccess($id_user)
{
    $conn = koneksiDB();
    $query = "DELETE FROM tb_akses WHERE id = ".$id_user;
    $execute = mysqli_query($conn, $query);
    return $execute;
}

///untuk insert data karyawan
function insertKaryawan($nik, $tgl_lahir, $jkel, $nama_karyawan, $size_seragam, $jrk_tempuh, $kilometer)
{
    $conn = koneksiDB();
    $tgl = date("Y-m-d", strtotime($tgl_lahir));
    $query = "INSERT INTO tb_karyawan (nik, tgl_lahir, jkel, nama_karyawan, size_seragam, jrk_tempuh, kilometer)  
    VALUES ('" . $nik . "', '" . $tgl . "', '" . $jkel . "', '" . $nama_karyawan . "', '" . $size_seragam . "', " . $jrk_tempuh . ", " . $kilometer . ")";

    var_dump($query);
    $execute = mysqli_query($conn, $query);
    $last_id = mysqli_insert_id($conn);
    return $last_id;
}

/// untuk select data karyawan
function selectOneKaryawan($_nik)
{
    $conn = koneksiDB();
    $res = [];
    $query = "SELECT * FROM tb_karyawan WHERE nik='" . $_nik . "'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $res[] = $row;
    }

    return $res;
}
