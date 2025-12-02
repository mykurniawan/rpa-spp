<?php
session_start();
include "../connect.php";

$username = mysqli_real_escape_string($connect, $_POST['username']);
$password_plain = mysqli_real_escape_string($connect, $_POST['password']);

/* =====================================================
   1. CEK LOGIN WALI MURID
===================================================== */
$query_wali = "SELECT * FROM t_wali WHERE username='$username' LIMIT 1";
$result_wali = mysqli_query($connect, $query_wali);

if (mysqli_num_rows($result_wali) === 1) {

    $data = mysqli_fetch_assoc($result_wali);

    if (password_verify($password_plain, $data['password'])) {

        $_SESSION['login_status'] = true;
        $_SESSION['role'] = "wali";
        $_SESSION['id_wali'] = $data['id_wali'];
        $_SESSION['username'] = $data['username'];

        header("Location: ../page/walimurid/dashboard_wali.php?msg=login_success");
        exit();
    }
}

/* =====================================================
   2. CEK LOGIN PETUGAS TU
===================================================== */
$query_tu = "SELECT * FROM t_petugas_tu WHERE username='$username' LIMIT 1";
$result_tu = mysqli_query($connect, $query_tu);

if (mysqli_num_rows($result_tu) === 1) {

    $data = mysqli_fetch_assoc($result_tu);

    // NOTE: password TIDAK di-hash di database — kamu bisa update nanti
    if ($password_plain === $data['password']) {

        $_SESSION['login_status'] = true;
        $_SESSION['role'] = $data['role'];
        $_SESSION['id_tu'] = $data['id_tu'];
        $_SESSION['username'] = $data['username'];

        // ============================
        // Redirect berdasarkan role
        // ============================
        if ($data['role'] === 'Petugas TU') {
            header("Location: ../page/petugas_tu/dashboard_tu.php?msg=login_success");
        } elseif ($data['role'] === 'Petugas Administrasi') {
            header("Location: ../page/petugas_administrasi/dashboard_administrasi.php?msg=login_success");
        } else {
            header("Location: ../page/tu/dashboard_administrasi.php");
        }
        exit();
    }
}

/* =====================================================
   JIKA KEDUA TIDAK COCOK → LOGIN GAGAL
===================================================== */
header("Location: ../index.php?msg=login_failed");
exit();
