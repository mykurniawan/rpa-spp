<?php
session_start();
include "../connect.php";

// ambil data dari form login
$username = mysqli_real_escape_string($connect, $_POST['username']);
$password = mysqli_real_escape_string($connect, $_POST['password']);

// cek uusername dan password di database
$query = "SELECT * FROM t_wali WHERE username='$username' AND password='$password' LIMIT 1";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    // simpan session 
    $_SESSION['id_wali'] = $data['id_wali'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['login_status'] = true;

    //redirect ke dashboard wali
    header("Location: ../page/walimurid/dashboard_wali.php");
    exit();
} else {
    // jika login gagal, tampilkan pesan error
    echo "<script>alert('Login gagal: Username atau password salah.'); window.location='../index.php';</script>";
    exit();
}
