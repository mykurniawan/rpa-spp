<?php
session_start();
if (!isset($_SESSION['login_status']) || $_SESSION['role'] !== "Staff Keuangan Yayasan" and $_SESSION['role'] !== "Kepala TU") {
    header("Location: ../../index.php?msg=not_allowed");
    exit();
}
?>
<?php include "../../connect.php";

$id = (int)$_GET['id'];

$query = mysqli_query($connect, "SELECT 
    file_report as nama_file 
    FROM t_report_spp 
    WHERE id_report = $id
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die('Report tidak ditemukan');
}

$file = '../../assets/report_spp/' . $data['nama_file'];

if (!file_exists($file)) {
    die('File tidak tersedia');
}

// $data = mysqli_fetch_array($query);

if (!$query) {
    die("Query gagal dijalankan:" . mysqli_error($connect));
}

?>

<?php include "../../templates/sidebar/sidebar_kepala_tu.php"; ?>


<link rel="stylesheet" href="../../assets/report_spp/style_for_report_spp.css">
<div class="page-heading">
    <?php
    if (isset($_GET['msg'])) {

        $msg = $_GET['msg'];
        if ($msg === 'login_success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Login Berhasil (Selamat Datang).<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
        }
    }
    ?>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Riwayat Laporan SPP</h3>
                <p class="text-subtitle text-muted">laporan spp</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Review Laporan SPP</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Laporan SPP</h5>
            </div>
            <div class="card-body">
                <div class="pdf-header">
                    <h5>📄 Review Report Pembayaran SPP</h5>

                    <div>
                        <a href="<?= $file ?>" class="btn btn-download btn-sm" download>
                            ⬇ Download PDF
                        </a>
                        <a href="javascript:window.close()" class="btn btn-secondary btn-sm ms-2">
                            ✖ Tutup
                        </a>
                    </div>
                </div>

                <!-- PDF VIEWER -->
                <iframe
                    src="<?= $file ?>"
                    class="pdf-viewer">
                </iframe>
            </div>
        </div>

    </section>
</div>
<?php include "../../templates/footer.php" ?>