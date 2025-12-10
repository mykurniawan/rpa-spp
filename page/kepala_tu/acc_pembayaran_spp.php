<?php
session_start();
if (!isset($_SESSION['login_status']) || $_SESSION['role'] !== "Kepala TU") {
    header("Location: ../../index.php?msg=not_allowed");
    exit();
}
?>
<?php include "../../connect.php";
// $id_wali = $_SESSION['id_wali'];

$query = mysqli_query($connect, " SELECT 
        t_pembayaran_spp.id_pembayaran AS id_pembayaran,
        t_pembayaran_spp.id_wali AS id_wali,
        t_pembayaran_spp.tgl_bayar AS tanggal_bayar,
        t_pembayaran_spp.semester AS semester,
        t_pembayaran_spp.kelas AS kelas_pembayaran,
        t_pembayaran_spp.status_validasi AS status_validasi,
        t_siswa.nama AS nama_siswa
    FROM t_pembayaran_spp
    LEFT JOIN t_siswa 
        ON t_pembayaran_spp.id_siswa = t_siswa.id_siswa
    ORDER BY t_pembayaran_spp.id_pembayaran DESC
");

// $data = mysqli_fetch_array($query);

if (!$query) {
    die("Query gagal dijalankan:" . mysqli_error($connect));
}

?>

<?php include "../../templates/sidebar/sidebar_kepala_tu.php"; ?>
<div class="page-heading">
    <?php
    // Notifikasi pesan sukses / gagal input data siswa (dismissible + auto-fade)
    if (isset($_GET['msg'])) {

        $msg = $_GET['msg'];
        if ($msg === 'input_success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">ACC pembayaran berhasil.<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
        }
    }
    ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Riwayat Pembayaran</h3>
                <p class="text-subtitle text-muted">Riwayat pembayaran SPP atas nama (siswa)</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Pembayaran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Pembayaran SPP</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Tanggal Bayar</th>
                            <th>Kelas</th>
                            <th>Semester</th>
                            <th>Nama Siswa</th>
                            <th>Status</th>
                            <th>Detail</th>
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
                                    <td><?= htmlspecialchars($row['id_pembayaran']) ?></td>
                                    <td><?= htmlspecialchars($row['tanggal_bayar']) ?></td>
                                    <td><?= htmlspecialchars($row['kelas_pembayaran']) ?></td>
                                    <td><?= htmlspecialchars($row['semester']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_siswa']) ?></td>
                                    <td id="row-status-<?= htmlspecialchars($row['id_pembayaran']) ?>">
                                        <?= htmlspecialchars($row['status_validasi']) ?>
                                    </td>
                                    <td>
                                        <a href="/rpa-spp/page/kepala_tu/form_acc_spp.php?id=<?= htmlspecialchars($row['id_pembayaran']) ?>"
                                            class="btn btn-success" role="button">
                                            ACC
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

                <!-- modal  -->


                <!-- Modal Detail Pembayaran -->
                <!-- Modal: form POST -->
                <!-- <div class="modal fade" id="detailPembayaranModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="/rpa-spp/proses/proses_acc_spp.php" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Pembayaran SPP</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" name="id" id="input-id-pembayaran" value="">

                                    <div class="mb-2">
                                        <label class="form-label">Tanggal Bayar</label>
                                        <input type="text" id="input-tanggal-bayar"  class="form-control" disabled>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Kelas</label>
                                        <input type="text" id="input-kelas" class="form-control" disabled>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Semester</label>
                                        <input type="text" id="input-semester" class="form-control" disabled>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Nama Siswa</label>
                                        <input type="text" id="input-nama-siswa" class="form-control" disabled>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Status</label>
                                        <input type="text" id="input-status" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="acc" class="btn btn-primary">ACC</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->


                <!-- modal  -->
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






<!-- modal acc  -->