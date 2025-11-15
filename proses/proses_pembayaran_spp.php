<?php 
include "../connect.php";

$tgl_bayar   = mysqli_real_escape_string($connect, $_POST['tgl_bayar']);
$bulan_dibayar = mysqli_real_escape_string($connect, $_POST['bulan_dibayar']);
// $kwitansi = mysqli_real_escape_string($connect, $_POST['kwitansi']);
$jumlah_bayar  = mysqli_real_escape_string($connect, $_POST['jumlah_bayar']);   

// upload kwitansi
$allowed_extensions = array('jpg', 'jpeg', 'png', 'pdf');
$upload_dir = '../assets/kwitansi/';

if(!empty($_FILES['kwitansi']['name'])) {
    $file_name = $_FILES['kwitansi']['name'];
    $file_tmp = $_FILES['kwitansi']['tmp_name'];
    $file_size = $_FILES['kwitansi']['size'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if(in_array($file_ext, $allowed_extensions)) {
        if($file_size <= 2 * 1024 * 1024) { // 2MB limit
            $new_file_name = uniqid() . '.' . $file_ext;
            move_uploaded_file($file_tmp, $upload_dir . $new_file_name);
            $kwitansi = $new_file_name;
        } else {
            header("Location: ../page/walimurid/pembayaran_spp.php?msg=file_too_large");
            exit();
        }
    } else {
        header("Location: ../page/walimurid/pembayaran_spp.php?msg=invalid_file_type");
        exit();
    }
} else {
    header("Location: ../page/walimurid/pembayaran_spp.php?msg=no_file_uploaded");
    exit();
}

// buat nama file unik 
$new_file_name = "kwitansi_" . time() .".". rand(100,999).".".$file_ext;

// upload file 
if(move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
    $kwitansi = $new_file_name;
} else {
    header("Location: ../page/walimurid/pembayaran_spp.php?msg=upload_failed");
    exit();
}



$query = "INSERT INTO t_pembayaran_spp (
                tgl_bayar, bulan_dibayar, kwitansi, jumlah_bayar
          ) VALUES (
                '$tgl_bayar', '$bulan_dibayar', '$new_file_name', '$jumlah_bayar'
          )";

if (mysqli_query($connect, $query)){
    header("Location: ../page/walimurid/pembayaran_spp.php?msg=payment_success");
    exit();
    } else {
    header("Location: ../page/walimurid/pembayaran_spp.php?msg=payment_failed");
    exit();
};

header("Location: ../page/walimurid/pembayaran_spp.php");
?>