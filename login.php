<?php
require 'core.php';
$message = "";

if (isset($_POST['submit'])) {
    $username = $_POST['i_username'];
    $password = md5($_POST['i_password']);

    // aksi login 
    $func_login = login($username, $password);
}

if (isset($_SESSION['is_logged']) && isset($_SESSION['ses_username']) && isset($_SESSION['ses_password'])) {
    header('Location: index.php?halaman=utama'); // berhasil login
}

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    switch ($msg) {
        case 'akses_gagal':
            # code...
            $message = "username atau password salah";
            break;

            case 'logout':
                # code...
                $message = "berhasil logout :)";
                break;

        default:
            # code...
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="main">
        <div class="message" style="color:blue;font-style:italic;"><?php echo $message; ?></div>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><input type="text" name="i_username" placeholder="Masukkan username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="i_password" placeholder="Masukkan password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" name="submit" value="login"></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>