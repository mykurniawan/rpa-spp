<?php 
session_start();
include "../connect.php";

// ambil data dari form login
$username = mysqli_real_escape_string($connect, $_POST['username']);
$password_plain = mysqli_real_escape_string($connect, $_POST['password']);

// cek username di database (password tidak dibandingkan di query)
$query = "SELECT * FROM t_wali WHERE username='$username' LIMIT 1";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) === 1) {

    $data = mysqli_fetch_assoc($result);

    // verifikasi password hash
    if (password_verify($password_plain, $data['password'])) {

        // simpan session 
        $_SESSION['id_wali'] = $data['id_wali'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['login_status'] = true;

        // redirect ke dashboard wali
        header("Location: ../page/walimurid/dashboard_wali.php?msg=login_success");
        exit();

    } else {
        // password salah
        header("Location: ../index.php?msg=login_failed");
        exit();
    }

} else {
    // username tidak ditemukan
    header("Location: ../index.php?msg=login_failed");
    exit();
}


?>