<?php
session_start();
if (!isset($_SESSION['login_status']) || $_SESSION['role'] !== "Staff Keuangan Yayasan") {
    header("Location: ../../index.php?msg=not_allowed");
    exit();
}
?>
<?php include "../../connect.php";

$query = mysqli_query($connect, " SELECT 
        t_report_spp.id_report AS id,
        t_report_spp.tgl_upload AS tgl_upload,
        t_report_spp.kelas AS kelas,
        t_report_spp.semester AS semester,
        t_report_spp.file_report AS file_report
    FROM t_report_spp
");

// $data = mysqli_fetch_array($query);

if (!$query) {
    die("Query gagal dijalankan:" . mysqli_error($connect));
}

?>

<?php include "../../templates/sidebar/sidebar_staff_keu.php"; ?>
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
                        <li class="breadcrumb-item active" aria-current="page">Laporan SPP</li>
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
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Tanggal Upload</th>
                            <th>Kelas</th>
                            <th>Semester</th>
                            <th>File Report</th>
                            <th>Preview</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['id']) ?></td>
                                    <td><?= htmlspecialchars($row['tgl_upload']) ?></td>
                                    <td><?= htmlspecialchars($row['kelas']) ?></td>
                                    <td><?= htmlspecialchars($row['semester']) ?></td>
                                    <td><?= htmlspecialchars($row['file_report']) ?></td>
                                    <td>
                                        <a href="/rpa-spp/page/staff_keuangan/review_report_spp.php?id=<?= (int)$row['id'] ?>"
                                            class="btn btn-info"
                                            target="_blank">
                                            Review PDF
                                        </a>
                                    </td>

                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='10' class='text-center'>Belum ada riwayat pembayaran.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
<?php include "../../templates/footer.php" ?>
<script>
    // Auto-fade and remove alerts after 4 seconds
    document.addEventListener('DOMContentLoaded', function() {
        var alerts = document.querySelectorAll('.alert');
        if (alerts.length) {
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        if (alert.parentNode) alert.parentNode.removeChild(alert);
                    }, 500);
                }, 4000);
            });
            // Remove the `msg` query parameter from URL so refreshing won't re-show the alert
            try {
                var url = new URL(window.location.href);
                if (url.searchParams.has('msg')) {
                    url.searchParams.delete('msg');
                    window.history.replaceState(null, document.title, url.pathname + url.search + url.hash);
                }
            } catch (e) {}
        }
    });
</script>