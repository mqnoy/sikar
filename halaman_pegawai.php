<?php
if ($_SESSION['ses_level'] != "karyawan") {
    echo "kamu tidak mempunyai akses halaman ini!";
    return;
}

if(isset($_POST['ubah_data_kar'])){
    var_dump($_POST);
    $_nama = $_POST['i_nama'];
    $username = $_SESSION['ses_username'];
    $password = md5($_POST['i_password']);
    $_id_kar = $_SESSION['ses_kar_id'];
    $level = $_SESSION['ses_level'];
    $_nik = $_SESSION['ses_kar_nik'];
    $_jkel = $_POST['jkel'];
    $_tgl_lahir = $_POST['i_tgl_lahir'];
    $_size_seragam = $_POST['i_seragam'];
    $_kilometer = $_POST['i_kilo'];
    $_jrkTem = kalkulasi($_kilometer);

    $update_access = updateAccess($_id_kar, $username, $password, $level);
    $update_karyawan = updateKaryawan($_nik, $_nama, $_jkel, $_tgl_lahir, $_size_seragam, $_kilometer, $_jrkTem, $_nik);
    if($update_access && $update_karyawan){
        echo "<script> alert('sukses update data')</script>";
        $update_sesi = updateSession($username, $password, $level, $_nik);
    }else{
        echo "<script> alert('gagal update data')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman pegawai</title>
</head>

<body>
    <div class="main">
        <h2>Halaman pegawai</h2>
        <div class="menu">
            <a href="index.php?halaman=utama">Halaman utama</a>
        </div>
        <div class="content">
            <?php
            $_id = $_SESSION['ses_kar_id'];
            $_nik = "";
            $_nama = "";
            $_jkel = '';
            $_tgl_lahir = "";
            $_size_seragam = '';
            $_kilometer = 0;
            $_username = "";

            $show_data_one = selectOneDataAll($_SESSION['ses_kar_id'], $_SESSION['ses_username']);
            if ($show_data_one != null) {
                foreach ($show_data_one as $data) {

                    $tgl = date("d, F Y", strtotime($data['tgl_lahir']));
                    $_nik = $data['nik'];
                    $_nama = $data['nama_karyawan'];
                    $_jkel = $data['jkel'];
                    $_tgl_lahir = $data['tgl_lahir'];
                    $_size_seragam = $data['size_seragam'];
                    $_kilometer = $data['kilometer'];
                    $_username = $data['username'];
                }
            }
            ?>
            <form action="?halaman=pegawai&aksi=ubah" method="post">
                <input type="hidden" name="id_kar" value="<?= $_id ?>" />
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
                            <input type="radio" value="P" name="jkel" <?php $_jkel == 'P' ? "checked=\"checked\"" : "asd"; ?> />Perempuan &nbsp
                            <input type="radio" value="L" name="jkel" <?php $_jkel == 'L' ? "checked=\"checked\"" : "ss"; ?> />Laki-laki
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
                        <td>password</td>
                        <td>:</td>
                        <td><input type="password" name="i_password" required /></td>
                    </tr>
                    <tr align="right">
                        <td colspan="3">
                            <input type="submit" name="ubah_data_kar" value="ubah data" />
                        </td>
                    </tr>
            </form>
        </div>
    </div>
</body>

</html>