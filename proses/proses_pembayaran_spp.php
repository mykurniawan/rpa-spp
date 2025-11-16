<?php
include "../connect.php";

$id_wali      = mysqli_real_escape_string($connect, $_POST['id_wali']);
$id_siswa     = mysqli_real_escape_string($connect, $_POST['id_siswa']);
$tgl_bayar    = mysqli_real_escape_string($connect, $_POST['tgl_bayar']);
$jumlah_bayar = mysqli_real_escape_string($connect, $_POST['jumlah_bayar']);
$catatan      = mysqli_real_escape_string($connect, $_POST['catatan']);

// ========== UPLOAD FILE ==========
$allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
$upload_dir = '../assets/kwitansi/';

if (!empty($_FILES['kwitansi']['name'])) {

    $file_name = $_FILES['kwitansi']['name'];
    $file_tmp  = $_FILES['kwitansi']['tmp_name'];
    $file_size = $_FILES['kwitansi']['size'];

    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Validasi ekstensi file
    if (!in_array($file_ext, $allowed_extensions)) {
        header("Location: ../page/walimurid/pembayaran_spp.php?msg=invalid_file_type");
        exit();
    }

    // Maksimal 2MB
    if ($file_size > 2 * 1024 * 1024) {
        header("Location: ../page/walimurid/pembayaran_spp.php?msg=file_too_large");
        exit();
    }

    // Buat nama file unik
    $new_file_name = "kwitansi_" . time() . "_" . rand(100,999) . "." . $file_ext;

    // Upload file
    if (!move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
        header("Location: ../page/walimurid/pembayaran_spp.php?msg=upload_failed");
        exit();
    }

} else {
    header("Location: ../page/walimurid/pembayaran_spp.php?msg=no_file_uploaded");
    exit();
}

// ========== SIMPAN KE DATABASE ==========
$query = "INSERT INTO t_pembayaran_spp (
              id_wali, id_siswa, tgl_bayar, jumlah_bayar, kwitansi, catatan
          ) VALUES (
              '$id_wali', '$id_siswa', '$tgl_bayar', '$jumlah_bayar', '$new_file_name', '$catatan'
          )";

if (mysqli_query($connect, $query)) {
    header("Location: ../page/walimurid/pembayaran_spp.php?msg=payment_success");
    exit();
} else {
    header("Location: ../page/walimurid/pembayaran_spp.php?msg=payment_failed");
    exit();
}
?>
