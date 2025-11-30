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
                                <a href=""><span class="badge bg-success">Lihat</span></a>
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