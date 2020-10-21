<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman utama</title>
</head>

<body>
    <div class="main">
        <h2>Halaman utama</h2>
        <div class="menu">
            <a href="logout.php">logout</a><?php if ($_SESSION['ses_level'] == 'admin') { ?>| <a href="?halaman=akses">halaman akses | <a href="?halaman=pegawai">list pegawai</a> <?php } ?>
        </div>
        <div class="content">
            <p>
                <h3>Selamat datang <?php echo $_SESSION['ses_username']; ?></h3>
                <?php
                $tampil_dataLengkap = tampilDataLengkap($_SESSION['ses_kar_id'], $_SESSION['ses_username']);
                foreach ($tampil_dataLengkap as $data_lengkap) {
                    $str_jkel = $data_lengkap['jkel'] == 'P' ? 'Perempuan' : 'Laki-laki';
                    $beauty_date =  date("d, F Y", strtotime($data_lengkap['tgl_lahir']));
                    echo "
                        Nama : $data_lengkap[nama_karyawan]<br/>
                        Tgl lahir : $beauty_date<br/>
                        Jenis kelamin : $str_jkel<br/>
                        Ukuran seragam : $data_lengkap[size_seragam]<br/>
                        Jarak tempuh : $data_lengkap[kilometer] Km ($data_lengkap[jrk_tempuh])<br/>
                        Hak akses : $data_lengkap[level]
                        ";
                }

                if ($_SESSION['ses_level'] == 'karyawan') {
                ?>
                    <br />
                    <a href="?halaman=pegawai&aksi=ubah_data_diri"><button>ubah data diri</button></a>
                <?php
                }
                ?>
            </p>

        </div>
    </div>
</body>

</html>