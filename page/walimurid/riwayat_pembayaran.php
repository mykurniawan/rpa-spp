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

$query = mysqli_query($connect, "SELECT 
        t_pembayaran_spp.id_pembayaran AS id_pembayaran,
        t_pembayaran_spp.id_wali AS id_wali,
        t_pembayaran_spp.tgl_bayar AS tanggal_bayar,
        t_pembayaran_spp.semester AS semester,
        t_pembayaran_spp.status_validasi AS status_validasi,
        t_siswa.nama AS nama_siswa,
        t_siswa.kelas AS kelas_siswa
    FROM t_pembayaran_spp
    LEFT JOIN t_siswa ON t_pembayaran_spp.id_siswa = t_siswa.id_siswa
    WHERE t_pembayaran_spp.id_wali = '$id_wali'
");

// $data = mysqli_fetch_array($query);

if (!$query) {
    die("Query gagal dijalankan:" . mysqli_error($connect));
}

?>

<?php include "../../templates/sidebar/sidebar_wali.php"; ?>
<div class="page-heading">
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
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Simple Datatable
                </h5>
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
                                    <td><?= htmlspecialchars($row['kelas_siswa']) ?></td>
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