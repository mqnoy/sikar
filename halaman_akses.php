<?php

if (isset($_POST['ubah_akses'])) {
}

if (isset($_POST['tambah_akses'])) {
    var_dump($_POST);
    // cek nik apakah kosong
    if (count(trim($_POST['i_nik'])) <= 0) {

        return;
    }

    $nik = $_POST['i_nik'];
    $nama_karyawan = $_POST['i_nama'];
    $tgl_lahir = $_POST['i_tgl_lahir'];
    $jkel = $_POST['jkel'];
    $size_seragam = $_POST['i_seragam'];
    $kilometer = $_POST['i_kilo'];

    // hak akses
    $username = $_POST['i_username'];
    $password = $_POST['i_password'];
    $level = $_POST['i_level'];

    $kalkulasi = $kilometer * 8000;

    //check nik apakah sudah ada
    $check_nik = checkDataKaryawan($nik);

    if ($check_nik != null) {
        echo "sudah ada data";
    } else {
        $tambah_data = tambahDataAkses($nik, $tgl_lahir, $jkel, $nama_karyawan, $size_seragam, $kalkulasi, $username, $password, $level, $kilometer);
        var_dump($tambah_data);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman akses</title>
</head>

<body>
    <div class="main">
        <h2>Halaman akses</h2>
        <div class="menu">
            <a href="index.php?halaman=utama">Halaman utama</a> | <a href="?halaman=akses&aksi=tambah">tambah data</a>
        </div>
        <div class="content">
            <?php
            if (isset($_GET['aksi'])) {
                $aksi = $_GET['aksi'];
                switch ($aksi) {
                    case 'tambah':
            ?>
                        <form action="?halaman=akses&aksi=tambah" method="post">
                            <table border="0" width="500px">
                                <tr align="center">
                                    <td colspan="3">tambah data</td>
                                </tr>
                                <tr>
                                    <td>Nik</td>
                                    <td>:</td>
                                    <td><input type="text" name="i_nik" required /></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><input type="text" name="i_nama" /></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>
                                        <input type="radio" value="P" name="jkel" />Perempuan &nbsp
                                        <input type="radio" value="L" name="jkel" />Laki-laki
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tgl Lahir</td>
                                    <td>:</td>
                                    <td><input type="date" name="i_tgl_lahir" /></td>
                                </tr>
                                <tr>
                                    <td>Ukuran seragam</td>
                                    <td>:</td>
                                    <td>
                                        <select name="i_seragam">
                                            <option value="0">- pilih -</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kilometer</td>
                                    <td>:</td>
                                    <td><input type="number" name="i_kilo" /></td>
                                </tr>
                                <tr>
                                    <td>username</td>
                                    <td>:</td>
                                    <td><input type="text" name="i_username" required /></td>
                                </tr>
                                <tr>
                                    <td>password</td>
                                    <td>:</td>
                                    <td><input type="password" name="i_password" required /></td>
                                </tr>
                                <tr>
                                    <td>level</td>
                                    <td>:</td>
                                    <td>
                                        <select name="i_level">
                                            <option value="">- pilih -</option>
                                            <option value="admin">admin</option>
                                            <option value="karyawan">karyawan</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr align="right">
                                    <td colspan="3">
                                        <input type="reset" value="clear" />
                                        <input type="submit" name="tambah_akses" value="simpan data" />
                                    </td>
                                </tr>
                        </form>

                    <?php
                        break;
                    case 'ubah':
                    ?>
                        <form action="?halaman=akses&aksi=tambah" method="post">
                            <table border="1" width="500px">
                                <tr align="center">
                                    <td colspan="3">ubah data</td>
                                </tr>
                                <tr>
                                    <td>Nik</td>
                                    <td>:</td>
                                    <td><input type="text" name="i_nik" /></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><input type="text" name="i_nama" /></td>
                                </tr>
                                <tr>
                                    <td>username</td>
                                    <td>:</td>
                                    <td><input type="text" name="i_username" /></td>
                                </tr>
                                <tr>
                                    <td>password</td>
                                    <td>:</td>
                                    <td><input type="password" name="i_password" /></td>
                                </tr>
                                <tr>
                                    <td>level</td>
                                    <td>:</td>
                                    <td>
                                        <select name="i_level">
                                            <option value="">- pilih -</option>
                                            <option value="admin">admin</option>
                                            <option value="karyawan">karyawan</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr align="right">
                                    <td colspan="3">
                                        <input type="reset" value="clear" />
                                        <input type="submit" name="tambah_akses" value="simpan data" />
                                    </td>
                                </tr>
                        </form>

            <?php
                        break;

                    default:
                        # code...
                        break;
                }
            }
            ?>
            <table border="1">
                <tr>
                    <td>id</td>
                    <td>nama karyawan</td>
                    <td>tanggal lahir</td>
                    <td>username</td>
                    <td>level</td>
                    <td>aksi</td>
                </tr>
                <?php
                $show_dataAkses = tampilDataAkses();
                if ($show_dataAkses != null) {
                    foreach ($show_dataAkses as $data_akses) {
                        echo "<tr>";
                        echo "<td>$data_akses[id]</td>";
                        echo "<td>$data_akses[nama_karyawan]</td>";
                        echo "<td>$data_akses[tgl_lahir]</td>";
                        echo "<td>$data_akses[username]</td>";
                        echo "<td>$data_akses[level]</td>";
                        echo "<td> <a href=\"?halaman=akses&aksi=ubah&id=$data_akses[id]\"> ubah</a> | <a href=\"?halaman=akses&aksi=hapus&id=$data_akses[id]\"> hapus</a> </td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td>tidak ada data</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>