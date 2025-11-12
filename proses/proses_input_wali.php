<?php
include '../connect.php';

$username            = mysqli_real_escape_string($connect, $_POST['username']);
$password            = mysqli_real_escape_string($connect, $_POST['password']);
$nama                = mysqli_real_escape_string($connect, $_POST['nama']);
$jenis_kelamin       = mysqli_real_escape_string($connect, $_POST['jk']);
$tempat_lahir        = mysqli_real_escape_string($connect, $_POST['tempat_lahir']);
$tgl_lahir           = mysqli_real_escape_string($connect, $_POST['tgl_lahir']);
$alamat              = mysqli_real_escape_string($connect, $_POST['alamat']);
$no_telepon          = mysqli_real_escape_string($connect, $_POST['no_telepon']);
$email               = mysqli_real_escape_string($connect, $_POST['email']);
$id_siswa            = mysqli_real_escape_string($connect, $_POST['id_siswa']);


$query = "INSERT INTO t_wali (
                username, password, nama, jenis_kelamin, tempat_lahir, tgl_lahir, alamat,
                no_telpon, email, id_siswa
          ) VALUES (
                '$username', '$password', '$nama', '$jenis_kelamin', '$tempat_lahir', '$tgl_lahir', '$alamat',
                '$no_telepon', '$email', '$id_siswa'
          )";



if (mysqli_query($connect, $query)) {
  header("Location: /rpa-spp/page/petugas_tu/dashboard_tu.php?msg=input_sukses");
  exit();
} else {
  header("Location: /rpa-spp/page/petugas_tu/dashboard_tu.php?msg=input_gagal");
  exit();
}


mysqli_close($connect);
