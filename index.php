<?php
require 'core.php';

if (!isset($_SESSION['is_logged']) && !isset($_SESSION['ses_username']) && !isset($_SESSION['ses_password'])) {
    header('Location: login.php?msg=blm_login'); // belum login
    return;
}

if (isset($_GET['halaman'])) {
    $halaman = $_GET['halaman'];
    switch ($halaman) {
        case 'akses':
            # code...
            if ($_SESSION['ses_level'] == 'admin') {
                include_once "halaman_akses.php";
            } else {
                echo "anda tidak mempunyai hak akses admin";
            }
            break;
        case 'pegawai':
            # code...
            include_once "halaman_pegawai.php";
            break;
        default:
            include_once 'halaman_utama.php';
            break;
    }
}
