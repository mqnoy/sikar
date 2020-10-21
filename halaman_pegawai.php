<?php

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
            <a href="index.php?halaman=utama">Halaman utama</a> | <a href="?halaman=akses&aksi=tambah">tambah data</a>
        </div>
        <div class="content">

            <table border="1">
                <tr>
                    <td>id</td>
                    <td>nik</td>
                    <td>nama</td>
                    <td>tgl lahir</td>
                </tr>

                <?php
                $show_dataAkses = tampilDataKaryawan();
                if ($show_dataAkses != null) {
                    foreach ($show_dataAkses as $data_akses) {

                        $tgl = date("d, F Y", strtotime($data_akses['tgl_lahir']));
                        echo "<tr>";
                        echo "<td>$data_akses[id]</td>";
                        echo "<td>$data_akses[nik]</td>";
                        echo "<td>$data_akses[nama_karyawan]</td>";
                        echo "<td>$tgl</td>";
                        echo "</tr>";
                    }
                }
                ?>

            </table>
        </div>
    </div>
</body>

</html>