<?php
session_start();

var_dump($_SESSION);
if (isset($_SESSION['is_logged']) && $_SESSION['is_logged']) {
    session_destroy();
    session_unset();
    header('Location: login.php?msg=logout');
    exit();
}
