<?php

if (isset($_POST['ubah_akses'])) {
    if (!isset($_POST['i_password'])) {
        // password tidak di ganti  
        echo "<script> alert('password tidak boleh kosong!')</script>";
    } else {
        //password di ganti
        
        // cast string to int
        $kilo = isset($_POST['i_kilo'])  || $_POST['i_kilo'] != "" ? $_POST['i_kilo'] : 0;
        $jrkTem = (int)$kilo * 800;

        $update_access = updateAccess($_POST['id_kar'], $_POST['i_username'], md5($_POST['i_password']), $_POST['i_level']);

        $update_karyawan = updateKaryawan($_POST['i_nik'], $_POST['i_nama'], $_POST['jkel'], $_POST['i_tgl_lahir'], $_POST['i_seragam'], $kilo, $jrkTem);

        if ($update_access && $update_karyawan) {
            echo "<script> alert('berhasil update')</script>";
        } else {
            echo "<script> alert('gagal update')</script>";
        }
    }

    if (!isset($_POST['i_level'])) {
        echo "silahkan tentukan levelnya";
        return;
    }
}

if (isset($_POST['tambah_akses'])) {
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
                        $_id = -1;
                        $_nik = "";
                        $_nama = "";
                        $_jkel = '';
                        $_tgl_lahir = "";
                        $_size_seragam = '';
                        $_kilometer = 0;
                        $_username = "";
                        $_password = "";
                        $_level = "";

                        if (isset($_GET['id'])) {
                            $_id = $_GET['id'];
                            $select_data = selectOneDataAll($_id, $_username);

                            //check result
                            if ($select_data != null) {
                                foreach ($select_data as $data) {
                                    $_nik = $data['nik'];
                                    $_nama = $data['nama_karyawan'];
                                    $_jkel = $data['jkel'];
                                    $_tgl_lahir = $data['tgl_lahir'];
                                    $_size_seragam = $data['size_seragam'];
                                    $_kilometer = $data['kilometer'];
                                    $_username = $data['username'];
                                    $_password = $data['password'];
                                    $_level = $data['level'];
                                }
                            }
                        }
                    ?>
                        <form action="?halaman=akses&aksi=ubah" method="post">
                            <input type="hidden" name="id_kar" value="<?= $_id ?>" />
                            <input type="hidden" name="i_nik" value="<?= $_nik ?>" />
                            <table border="0" width="500px">
                                <tr align="center">
                                    <td colspan="3">ubah data</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><input type="text" name="i_nama" value="<?= $_nama ?>" /></td>
                                </tr>
                                <tr>
                                    <td>Jenis kelamin</td>
                                    <td>:</td>
                                    <td>
                                        <input type="radio" value="P" name="jkel" <?php $_jkel === "P" ? "checked=\"checked\"" : "asd"; ?> />Perempuan &nbsp
                                        <input type="radio" value="L" name="jkel" <?php $_jkel === "L" ? "checked=\"checked\"" : "ss"; ?> />Laki-laki
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tgl Lahir</td>
                                    <td>:</td>
                                    <td><input type="date" value="<?= $_tgl_lahir ?>" name="i_tgl_lahir" /></td>
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
                                    <td><input type="number" value="<?= $_kilometer ?>" name="i_kilo" /></td>
                                </tr>
                                <tr>
                                    <td>username</td>
                                    <td>:</td>
                                    <td><input type="text" name="i_username" value="<?= $_username ?>" required /></td>
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
                                        <input type="submit" name="ubah_akses" value="ubah data" />
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
                } else {
                    echo "<tr><td>tidak ada data</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>