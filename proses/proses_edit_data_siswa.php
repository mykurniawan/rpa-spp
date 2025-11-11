<?php
include "../connect.php";

if (isset($_POST['id_siswa'])) {
    $id_siswa = $_POST['id_siswa'];
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    // $status = $_POST['status'];

    $query = mysqli_query($connect, "UPDATE t_siswa SET nama='" . mysqli_real_escape_string($connect, $nama) . "', nis='" . mysqli_real_escape_string($connect, $nis) . "', kelas='" . mysqli_real_escape_string($connect, $kelas) . "' WHERE id_siswa='" . mysqli_real_escape_string($connect, $id_siswa) . "'");
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
