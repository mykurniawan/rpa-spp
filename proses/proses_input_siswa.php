<?php 
include '../connect.php';

$nis                 = mysqli_real_escape_string($connect, $_POST['nis']);
$nama                = mysqli_real_escape_string($connect, $_POST['nama']);
$jenis_kelamin       = mysqli_real_escape_string($connect, $_POST['jk']);
$tempat_lahir        = mysqli_real_escape_string($connect, $_POST['tempat_lahir']);
$tgl_lahir           = mysqli_real_escape_string($connect, $_POST['tgl_lahir']);
$alamat              = mysqli_real_escape_string($connect, $_POST['alamat']);
$kelas               = mysqli_real_escape_string($connect, $_POST['kelas']);
$nama_walimurid      = mysqli_real_escape_string($connect, $_POST['nama_walimurid']);
$pekerjaan_walimurid = mysqli_real_escape_string($connect, $_POST['pekerjaan_walimurid']);
$asal_sekolah        = mysqli_real_escape_string($connect, $_POST['asal_sekolah']);


$query = "INSERT INTO t_siswa (
                nis, nama, jk, tempat_lahir, tgl_lahir, alamat,
                nama_wali, kelas, pekerjaan_wali, asal_sekolah
          ) VALUES (
                '$nis', '$nama', '$jenis_kelamin', '$tempat_lahir', '$tgl_lahir', '$alamat',
                 '$nama_walimurid', '$kelas', '$pekerjaan_walimurid', '$asal_sekolah'
          )";


if (mysqli_query($connect, $query)) {
    echo "<script>
            alert('Data siswa berhasil disimpan!');
            window.location.href = '../page/petugas_administrasi/dashboard_administrasi.php'; // ubah sesuai halaman tujuanmu
          </script>";
} else {
    echo "<script>
            alert('Gagal menyimpan data: " . mysqli_error($connect) . "');
            window.history.back();
          </script>";
}


mysqli_close($connect);
?>