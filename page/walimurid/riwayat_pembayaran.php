<?php
session_start();
echo "SESSION id_wali = " . $_SESSION['id_wali'] . "<br>";
if (!isset($_SESSION['login_status'])) {
    header("Location: ../../index.php?pesan=belum_login");
    exit();
}
?>
<?php include "../../connect.php";
$id_wali = $_SESSION['id_wali'];

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
    WHERE t_pembayaran_spp.id_wali = '$id_wali'
    ORDER BY t_pembayaran_spp.id_pembayaran DESC
");

// $data = mysqli_fetch_array($query);

if (!$query) {
    die("Query gagal dijalankan:" . mysqli_error($connect));
}

?>

<?php include "../../templates/sidebar/sidebar_wali.php"; ?>
<div class="page-heading">
    <?php
    // Notifikasi pesan sukses / gagal input data siswa (dismissible + auto-fade)
    if (isset($_GET['msg'])) {

        $msg = $_GET['msg'];
        if ($msg === 'input_success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Input pembayaran berhasil.<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
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
                <h5 class="card-title">Simple Datatable</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
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
                                    <td><?= htmlspecialchars($row['tanggal_bayar']) ?></td>
                                    <td><?= htmlspecialchars($row['kelas_pembayaran']) ?></td>
                                    <td><?= htmlspecialchars($row['semester']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_siswa']) ?></td>
                                    <td><?= htmlspecialchars($row['status_validasi']) ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-detail-pembayaran"
                                            data-bs-toggle="modal" data-bs-target="#detailPembayaranModal"
                                            data-id="<?= htmlspecialchars($row['id_pembayaran']) ?>"
                                            data-tanggal="<?= htmlspecialchars($row['tanggal_bayar']) ?>"
                                            data-kelas="<?= htmlspecialchars($row['kelas_pembayaran']) ?>"
                                            data-semester="<?= htmlspecialchars($row['semester']) ?>"
                                            data-nama="<?= htmlspecialchars($row['nama_siswa']) ?>"
                                            data-status="<?= htmlspecialchars($row['status_validasi']) ?>">
                                            Detail
                                        </button>
                                        <!-- <a href=""><span class="badge bg-success">Lihat</span></a> -->
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='10' class='text-center'>Belum ada riwayat pembayaran.</td></tr>";
                        }
                        ?>



                        <!-- <tr>
                            <td>Emmanuel</td>
                            <td>eget.lacus.Mauris@feugiatSednec.org</td>
                            <td>(016977) 8208</td>
                            <td>Saint-Remy-Geest</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr> -->
                    </tbody>
                </table>

                <!-- modal  -->
            

                <!-- Modal Detail Pembayaran -->
                <div class="modal fade" id="detailPembayaranModal" tabindex="-1" aria-labelledby="detailPembayaranModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailPembayaranModalTitle">Detail Pembayaran SPP</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-borderless mb-0">
                                    <tr><th>ID Pembayaran</th><td id="modal-id-pembayaran"></td></tr>
                                    <tr><th>Tanggal Bayar</th><td id="modal-tanggal-bayar"></td></tr>
                                    <tr><th>Kelas</th><td id="modal-kelas"></td></tr>
                                    <tr><th>Semester</th><td id="modal-semester"></td></tr>
                                    <tr><th>Nama Siswa</th><td id="modal-nama-siswa"></td></tr>
                                    <tr><th>Status</th><td id="modal-status"></td></tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

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
<!-- script modal  -->
<!-- script modal  -->
<script>
    // Script untuk mengisi modal detail pembayaran
    document.addEventListener('DOMContentLoaded', function() {
        var detailButtons = document.querySelectorAll('.btn-detail-pembayaran');
        detailButtons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                document.getElementById('modal-id-pembayaran').textContent = btn.getAttribute('data-id');
                document.getElementById('modal-tanggal-bayar').textContent = btn.getAttribute('data-tanggal');
                document.getElementById('modal-kelas').textContent = btn.getAttribute('data-kelas');
                document.getElementById('modal-semester').textContent = btn.getAttribute('data-semester');
                document.getElementById('modal-nama-siswa').textContent = btn.getAttribute('data-nama');
                document.getElementById('modal-status').textContent = btn.getAttribute('data-status');
            });
        });
    });
</script>