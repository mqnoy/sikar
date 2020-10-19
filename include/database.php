<?php

function koneksiDB()
{
    $db_host            = "localhost";
    $db_username        = "root";
    $db_userPassword    = "";
    $db_name            = "db_sikar";

    // koneksi dengan mysqli
    $mysqli = mysqli_connect(
        $db_host,
        $db_username,
        $db_userPassword,
        $db_name
    );
    return $mysqli;
}