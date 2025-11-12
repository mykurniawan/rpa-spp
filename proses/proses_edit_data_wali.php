<?php
include "../connect.php";

if (isset($_POST['id_wali'])) {
    $id_wali = $_POST['id_wali'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $jk = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $no_telpon = $_POST['no_telpon'];
    // $kelas = $_POST['kelas'];
    $email = $_POST['email'];
    $id_siswa = $_POST['id_siswa'];

    $query = mysqli_query($connect, "UPDATE t_wali SET username='" . mysqli_real_escape_string($connect, $username) . "', 
        password='" . mysqli_real_escape_string($connect, $password) . "', 
        nama='" . mysqli_real_escape_string($connect, $nama) . "',
        jenis_kelamin='" . mysqli_real_escape_string($connect, $jk) . "', 
        tempat_lahir='" . mysqli_real_escape_string($connect, $tempat_lahir) . "', 
        tgl_lahir='" . mysqli_real_escape_string($connect, $tgl_lahir) . "', 
        alamat='" . mysqli_real_escape_string($connect, $alamat) . "',
        no_telpon='" . mysqli_real_escape_string($connect, $no_telpon) . "', 
        email='" . mysqli_real_escape_string($connect, $email) . "', 
        id_siswa='" . mysqli_real_escape_string($connect, $id_siswa) . "'   
    WHERE id_wali='" . mysqli_real_escape_string($connect, $id_wali) . "'");

    if ($query) {
        // Redirect to the admin page showing the list after successful edit
        header("Location: /rpa-spp/page/petugas_tu/dashboard_tu.php?msg=edit_sukses");
        exit();
    } else {
        header("Location: /rpa-spp/page/petugas_tu/edit_wali.php?msg=edit_gagal");
        exit();
    }
} else {
    header("Location: /rpa-spp/page/petugas_tu/edit_siswa.php");
    exit();
}
