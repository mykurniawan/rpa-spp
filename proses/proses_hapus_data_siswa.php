<?php
include "../connect.php";

if (isset($_GET['id'])) {
    $id_siswa = $_GET['id'];
    // Query hapus data siswa
    $query = mysqli_query($connect, "DELETE FROM t_siswa WHERE id_siswa='" . mysqli_real_escape_string($connect, $id_siswa) . "'");
    if ($query) {
        // Redirect kembali ke halaman edit_siswa.php dengan pesan sukses
        header("Location: /rpa-spp/page/petugas_administrasi/edit_siswa.php?msg=hapus_sukses");
        exit();
    } else {
        // Redirect dengan pesan error
        header("Location: /rpa-spp/page/petugas_administrasi/edit_siswa.php?msg=hapus_gagal");
        exit();
    }
} else {
    // Jika tidak ada id, redirect ke halaman edit_siswa.php
    header("Location: edit_siswa.php");
    exit();
}
?>