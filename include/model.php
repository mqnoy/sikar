<?php
require 'database.php';

/// untuk login
function selectOneAccess($username, $password)
{
    $conn = koneksiDB();
    $res = [];
    $query = "SELECT * FROM tb_akses INNER JOIN tb_detail_karyawan ON tb_akses.id = tb_detail_karyawan.akses_id
    WHERE tb_akses.username='" . $username . "' AND tb_akses.password ='" . $password . "'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $res[] = $row;
    }

    return $res;
}

/// untuk select semua ke table acess
function selectAccess($keywords = null)
{
    $conn = koneksiDB();
    $res = [];
    if ($keywords != null) {
        $query = "SELECT * FROM tb_detail_karyawan dtk LEFT JOIN tb_karyawan tk ON dtk.kar_id = tk.id  
        LEFT JOIN tb_akses ta ON dtk.akses_id = ta.id 
        WHERE tk.nama_karyawan LIKE '%" . $keywords . "%' OR tk.nik LIKE '%" . $keywords . "%'
        ";
    } else {
        $query = "SELECT * FROM tb_detail_karyawan dtk LEFT JOIN tb_karyawan tk ON dtk.kar_id = tk.id  
        LEFT JOIN tb_akses ta ON dtk.akses_id = ta.id ";
    }

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
    $query = "SELECT * FROM tb_detail_karyawan dtk LEFT JOIN tb_karyawan tk ON dtk.kar_id = tk.id  
    LEFT JOIN tb_akses ta ON dtk.akses_id = ta.id  WHERE tk.id = " . $id_kar;

    if ($username != null) {
        $query = "SELECT * FROM tb_detail_karyawan dtk LEFT JOIN tb_karyawan tk ON dtk.kar_id = tk.id  
        LEFT JOIN tb_akses ta ON dtk.akses_id = ta.id WHERE tk.id = " . $id_kar . " AND ta.username='" . $username . "'";
    }

    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $res[] = $row;
    }

    return $res;
}

/// untuk insert ke table acess
/// @return last_insert_id
function insertAccess($username, $password, $level)
{
    $conn = koneksiDB();
    $query = "INSERT INTO tb_akses (username, password, level) VALUES ('" . $username . "','" . $password . "','" . $level . "')";

    $execute = mysqli_query($conn, $query);
    $last_id = mysqli_insert_id($conn);
    return $last_id;
}

/// untuk update ke table acess
function updateAccess($_id_kar, $username, $password, $level)
{
    $conn = koneksiDB();
    $query = "UPDATE tb_detail_karyawan tdk 
    JOIN tb_karyawan tk ON tdk.kar_id = tk.id 
    JOIN tb_akses ta ON tdk.akses_id = ta.id
    SET ta.password='" . $password . "', ta.username='" . $username . "' ,ta.level='" . $level . "'  
    WHERE tdk.kar_id='" . $_id_kar . "'";
    $execute = mysqli_query($conn, $query);
    return $execute;
}

/// update ke table karywawan
function updateKaryawan($_nik, $_nama, $_jkel, $_tgl_lahir, $_size_seragam, $_kilometer, $_jrkTem)
{
    $conn = koneksiDB();
    $query = "UPDATE tb_detail_karyawan tdk 
    JOIN tb_karyawan tk ON tdk.kar_id = tk.id 
    JOIN tb_akses ta ON tdk.akses_id = ta.id 
    SET tk.tgl_lahir='" . $_tgl_lahir . "', tk.jkel='" . $_jkel . "', tk.nama_karyawan='" . $_nama . "', tdk.size_seragam='" . $_size_seragam . "', tdk.jrk_tempuh='" . $_jrkTem . "', tdk.kilometer='" . $_kilometer . "'  
    WHERE tk.nik='" . $_nik . "'";
    $execute = mysqli_query($conn, $query);
    return $execute;
}

/// untuk delete ke table acess
function deleteData($id_kar)
{
    $conn = koneksiDB();
    $query = "DELETE tb_detail_karyawan,tb_akses, tb_karyawan FROM tb_detail_karyawan 
    INNER JOIN tb_karyawan ON tb_detail_karyawan.kar_id = tb_karyawan.id 
    INNER JOIN tb_akses ON tb_detail_karyawan.akses_id = tb_akses.id 
    WHERE tb_karyawan.id = '" . $id_kar . "'";
    $execute = mysqli_query($conn, $query);
    return $execute;
}

///untuk insert data karyawan
function insertKaryawan($nik, $tgl_lahir, $jkel, $nama_karyawan)
{
    $conn = koneksiDB();
    $tgl = date("Y-m-d", strtotime($tgl_lahir));
    $query = "INSERT INTO tb_karyawan (nik, tgl_lahir, jkel, nama_karyawan)  
    VALUES ('" . $nik . "', '" . $tgl . "', '" . $jkel . "', '" . $nama_karyawan . "')";

    $execute = mysqli_query($conn, $query);
    $last_id = mysqli_insert_id($conn);
    return $last_id;
}

/// untuk select data karyawan
function selectOneKaryawan($_nik = null, $_id = -1)
{
    $conn = koneksiDB();
    $res = [];
    
    if($_nik != null && $_id == -1){
        $query = "SELECT * FROM tb_karyawan WHERE nik='" . $_nik . "'";
    }else{
        $query = "SELECT * FROM tb_karyawan WHERE id='" . $_id . "'";
    }
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $res[] = $row;
    }

    return $res;
}

/// untuk select semua data karyawan
function selectKaryawan()
{
    $conn = koneksiDB();
    $res = [];
    $query = "SELECT * FROM tb_karyawan";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $res[] = $row;
    }

    return $res;
}

///untuk insert data detail karyawan
function insertDetailKaryawan($id_access, $id_karyawan, $size_seragam, $jrk_tempuh, $kilometer)
{
    $conn = koneksiDB();
    $query = "INSERT INTO tb_detail_karyawan (kar_id, akses_id, size_seragam, jrk_tempuh, kilometer)  
    VALUES ('" . $id_karyawan . "', '" . $id_access . "', '" . $size_seragam . "', " . $jrk_tempuh . ", " . $kilometer . ")";

    $execute = mysqli_query($conn, $query);
    return $execute;
}
