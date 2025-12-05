<?php
include "../connect.php";

$id_pembayaran = $_POST['id_pembayaran'];
$query = mysqli_query($connect, "UPDATE t_pembayaran_spp SET status_validasi='Valid' WHERE id_pembayaran='$id_pembayaran'");

if ($query) {
    echo ("Location:/rpa-spp/page/kepala_tu/acc_pembayaran_spp.php?msg=acc_success");
    exit();
} else {
    echo ("Location:/rpa-spp/page/kepala_tu/acc_pembayaran_spp.php?msg=acc_failed");
    exit();
}
