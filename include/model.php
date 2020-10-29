<?php
require 'database.php';

/// untuk login
function selectOneAccess($username, $password)
{
    $conn = koneksiDB();
    $res = [];
    $query = "SELECT * FROM tb_akses INNER JOIN tb_karyawan ON tb_akses.kar_id = tb_karyawan.id
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
    if($keywords != null){
        $query = "SELECT * FROM tb_akses ta LEFT JOIN tb_karyawan tk ON ta.kar_id = tk.id
        WHERE tk.nama_karyawan LIKE '%".$keywords."%' OR tk.nik LIKE '%".$keywords."%'
        ";
    }else{
        $query= "SELECT * FROM tb_akses ta LEFT JOIN tb_karyawan tk ON ta.kar_id = tk.id";
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
    $query = "SELECT * FROM tb_akses ta LEFT JOIN tb_karyawan tk ON ta.kar_id = tk.id WHERE tk.id = " . $id_kar;

    if ($username != null) {
        $query = "SELECT * FROM tb_akses ta LEFT JOIN tb_karyawan tk ON ta.kar_id = tk.id WHERE tk.id = " . $id_kar . " AND ta.username='" . $username . "'";
    }
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
function updateAccess($_id_kar, $username, $password, $level)
{
    $conn = koneksiDB();
    $query = "UPDATE tb_akses SET password='" . $password . "', username='" . $username . "' ,level='" . $level . "'  
    WHERE kar_id='" . $_id_kar . "'";
    $execute = mysqli_query($conn, $query);
    return $execute;
}

/// update ke table karywawan
function updateKaryawan($_nik, $_nama, $_jkel, $_tgl_lahir, $_size_seragam, $_kilometer, $_jrkTem)
{
    $conn = koneksiDB();
    $query = "UPDATE tb_karyawan SET 
    tgl_lahir='" . $_tgl_lahir . "', jkel='" . $_jkel . "', nama_karyawan='" . $_nama . "', size_seragam='" . $_size_seragam . "', jrk_tempuh='" . $_jrkTem . "', kilometer='" . $_kilometer . "' WHERE nik='" . $_nik . "'";
    $execute = mysqli_query($conn, $query);
    return $execute;
}

/// untuk delete ke table acess
function deleteData($id_kar)
{
    $conn = koneksiDB();
    $query = "DELETE tb_akses, tb_karyawan FROM tb_akses INNER JOIN tb_karyawan ON tb_akses.kar_id = tb_karyawan.id WHERE tb_karyawan.id = '" . $id_kar . "'";
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
