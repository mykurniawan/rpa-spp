<?php
include "../connect.php";

if (isset($_POST['id_siswa'])) {
    $id_siswa = $_POST['id_siswa'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $nama_wali = $_POST['nama_wali'];
    $kelas = $_POST['kelas'];
    $pekerjaan_wali = $_POST['pekerjaan_wali'];
    $asal_sekolah = $_POST['asal_sekolah'];

    $query = mysqli_query($connect, "UPDATE t_siswa SET nama='" . mysqli_real_escape_string($connect, $nama) . "', nis='" . mysqli_real_escape_string($connect, $nis) . "', kelas='" . mysqli_real_escape_string($connect, $kelas) . "', 
        jk='" . mysqli_real_escape_string($connect, $jk) . "', tempat_lahir='" . mysqli_real_escape_string($connect, $tempat_lahir) . "', tgl_lahir='" . mysqli_real_escape_string($connect, $tgl_lahir) . "', alamat='" . mysqli_real_escape_string($connect, $alamat) . "',
        nama_wali='" . mysqli_real_escape_string($connect, $nama_wali) . "', pekerjaan_wali='" . mysqli_real_escape_string($connect, $pekerjaan_wali) . "', asal_sekolah='" . mysqli_real_escape_string($connect, $asal_sekolah) . "'   
    WHERE id_siswa='" . mysqli_real_escape_string($connect, $id_siswa) . "'");
    
    if ($query) {
        // Redirect to the admin page showing the list after successful edit
        header("Location: /rpa-spp/page/petugas_administrasi/edit_siswa.php?msg=edit_sukses");
        exit();
    } else {
        header("Location: /rpa-spp/page/petugas_administrasi/edit_siswa.php?msg=edit_gagal");
        exit();
    }
} else {
    header("Location: /rpa-spp/page/petugas_administrasi/edit_siswa.php");
    exit();
}
