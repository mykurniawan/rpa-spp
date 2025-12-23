<?php
session_start();
if (!isset($_SESSION['login_status']) || $_SESSION['role'] !== "wali") {
    header("Location: ../../index.php?msg=not_allowed");
    exit();
}
?>
<?php include "../../connect.php";


$id_wali = $_SESSION['id_wali'];

// Ambil nama wali berdasarkan id_wali
$query = mysqli_query($connect, "SELECT 
    t_wali.nama as nama_wali,
    t_siswa.nis as nis_siswa,
    t_siswa.nama as nama_siswa,
    t_siswa.kelas as kelas_siswa,
    t_siswa.jk as jk_siswa,
    t_siswa.tempat_lahir as tempat_lahir,
    t_siswa.tgl_lahir as tgl_lahir,
    t_siswa.alamat as alamat_siswa
    FROM t_wali LEFT JOIN t_siswa ON t_wali.id_siswa = t_siswa.id_siswa WHERE t_wali.id_wali='$id_wali'");
$data = mysqli_fetch_assoc($query);

$nama_wali = $data['nama_wali'];
if (!$query) {
    die("Query gagal dijalankan: " . mysqli_error($connect));
}
?>


<?php include "../../templates/sidebar/sidebar_wali.php"; ?>

<div class="page-heading">
    <?php
    // Notifikasi pesan sukses / gagal input data siswa (dismissible + auto-fade)
    if (isset($_GET['msg'])) {

        $msg = $_GET['msg'];
        if ($msg === 'login_success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Login Berhasil (Selamat Datang).<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
        }
    }
    ?>
    <h3>Selamat datang <?= $data['nama_wali'] ?> di sistem pembayaran spp MI Al-Huda</h3>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <!-- <i class="iconly-boldShow"></i>  -->
                                        <i class="iconly-boldWallet"></i>
                                    </div> 
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Biaya SPP</h6>
                                    
                                    <h6 class="font-extrabold mb-0">Rp. 300.000 </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Nama : <?= $data['nama_siswa'] ?></h6>
                                    <h6 class="font-extrabold mb-0">NISN : <?= $data['nis_siswa'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <!-- <i class="iconly-boldAdd-User"></i> -->
                                        <i class="iconly-boldCategory"></i>

                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">MI AL-Huda</h6>
                                    <h6 class="font-extrabold mb-0">Kelas :<?= $data['kelas_siswa'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Riwayat Pembayaran</h6>
                                    <h6 class="font-extrabold mb-0"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>

            <!-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Visit</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <!-- <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Siswa</h4>
                        </div>
                        <div class="card-body">
                            <h4>NIS : <?= $data['nis_siswa'] ?></h4>
                            <h4>Nama Siswa : <?= $data['nama_siswa'] ?></h4>
                            <h4>Kelas : <?= $data['kelas_siswa'] ?></h4>
                        </div>
                    </div>
                </div> -->


                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profil Siswa</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <!-- <thead>
                                        <tr>
                                            <th>Profil</th>
                                            <th>Siswa</th>
                                        </tr>
                                    </thead> -->
                                    <tbody>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">

                                                    <p class="font-bold ms-3 mb-0">NIS</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0"><?= $data['nis_siswa'] ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">

                                                    <p class="font-bold ms-3 mb-0">Nama Siswa</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0"><?= $data['nama_siswa'] ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <p class="font-bold ms-3 mb-0">Jenis Kelamin</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0"><?= $data['jk_siswa'] ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <p class="font-bold ms-3 mb-0">Kelas</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0"><?= $data['kelas_siswa'] ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <p class="font-bold ms-3 mb-0">Kota Kelahiran</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0"><?= $data['tempat_lahir'] ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <p class="font-bold ms-3 mb-0">Tanggal Lahir</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0"><?= date('d/m/Y', strtotime($data['tgl_lahir'])) ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <p class="font-bold ms-3 mb-0">Alamat</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0"><?= $data['alamat_siswa'] ?></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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