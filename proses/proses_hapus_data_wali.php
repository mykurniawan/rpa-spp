<?php
include "../connect.php";

if (isset($_GET['id'])) {
    $id_wali = $_GET['id'];
    // Query hapus data wali
    $query = mysqli_query($connect, "DELETE FROM t_wali WHERE id_wali='" . mysqli_real_escape_string($connect, $id_wali) . "'");
    if ($query) {
        // Redirect kembali ke halaman edit_wali.php dengan pesan sukses
        header("Location: /rpa-spp/page/petugas_tu/edit_wali.php?msg=hapus_sukses");
        exit();
    } else {
        // Redirect dengan pesan error
        header("Location: /rpa-spp/page/petugas_tu/edit_wali.php?msg=hapus_gagal");
        exit();
    }
} else {
    header("Location: edit_wali.php");
    exit();
}
?>