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
                    <td>username</td>
                    <td>level</td>
                    <td>aksi</td>
                </tr>
                <tr>
                    <?php
                    $show_dataAkses = tampilDataAkses();
                    if ($show_dataAkses != null) {
                        foreach ($show_dataAkses as $data_akses) {
                            echo "<td>$data_akses[id]</td>";
                            echo "<td>$data_akses[username]</td>";
                            echo "<td>$data_akses[level]</td>";
                            echo "<td> <a href=\"\" ubah | hapus </td>";
                        }
                    }
                    ?>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>