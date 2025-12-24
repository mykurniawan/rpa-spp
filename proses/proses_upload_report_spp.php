<?php
include "../connect.php";

// $id_wali      = mysqli_real_escape_string($connect, $_POST['id_wali']);
// $id_siswa     = mysqli_real_escape_string($connect, $_POST['id_siswa']);
$tgl_upload    = mysqli_real_escape_string($connect, $_POST['tgl_upload']);
$kelas        = mysqli_real_escape_string($connect, $_POST['kelas']);
$semester     = mysqli_real_escape_string($connect, $_POST['semester']);
// $jumlah_bayar = mysqli_real_escape_string($connect, $_POST['jumlah_bayar']);
// $catatan      = mysqli_real_escape_string($connect, $_POST['catatan']);

// ========== UPLOAD FILE ==========
$allowed_extensions = ['pdf'];
$upload_dir = '../assets/report_spp/';

if (!empty($_FILES['file_report']['name'])) {

    $file_name = $_FILES['file_report']['name'];
    $file_tmp  = $_FILES['file_report']['tmp_name'];
    $file_size = $_FILES['file_report']['size'];

    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Validasi ekstensi file
    if (!in_array($file_ext, $allowed_extensions)) {
        header("Location: ../page/kepala_tu/upload_report_spp.php?msg=invalid_file_type");
        exit();
    }

    // Maksimal 2MB
    if ($file_size > 2 * 1024 * 1024) {
        header("Location: ../page/kepala_tu/upload_report_spp.php?msg=file_too_large");
        exit();
    }

    // Buat nama file unik
    $new_file_name = "report_" . time() . "_" . rand(100,999) . "." . $file_ext;

    // Upload file
    if (!move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
        header("Location: ../page/kepala_tu/upload_report_spp.php?msg=upload_failed");
        exit();
    }

} else {
    header("Location: ../page/kepala_tu/upload_report_spp.php?msg=no_file_uploaded");
    exit();
}

// ========== SIMPAN KE DATABASE ==========
$query = "INSERT INTO t_report_spp (
              tgl_upload, kelas, semester, file_report
          ) VALUES (
              '$tgl_upload', '$kelas', '$semester', '$new_file_name'
          )";

if (mysqli_query($connect, $query)) {
    // header("Location: ../page/kepala_tu/pembayaran_spp.php?msg=payment_success");
    header("Location: /rpa-spp/page/kepala_tu/upload_report_spp.php?msg=input_success");
    exit();
} else {
    header("Location: ../page/kepala_tu/upload_report_spp.php?msg=payment_failed");
    exit();
}
?>
