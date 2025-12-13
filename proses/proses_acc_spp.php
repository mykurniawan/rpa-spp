<?php
// proses_acc_spp.php
include "../connect.php";

if (!isset($_POST['id_pembayaran'])) {
    header("Location: /rpa-spp/page/kepala_tu/acc_pembayaran_spp.php?msg=invalid_data");
    exit();
}

$id_pembayaran = intval($_POST['id_pembayaran']); // sanitize

$sql = "UPDATE t_pembayaran_spp SET tgl_validasi = NOW(), status_validasi = 'Valid' WHERE id_pembayaran = $id_pembayaran";
$result = mysqli_query($connect, $sql);

if ($result) {
    header("Location: /rpa-spp/page/kepala_tu/acc_pembayaran_spp.php?msg=acc_success");
    exit();
} else {
    header("Location: /rpa-spp/page/kepala_tu/acc_pembayaran_spp.php?msg=acc_failed");
    exit();
}
