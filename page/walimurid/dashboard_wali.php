<?php include "../../templates/sidebar/sidebar_wali.php"; ?>
<?php include "../../connect.php"; 
$query = mysqli_query($connect, "SELECT t_wali.*, 
            t_siswa.nama AS nama_siswa , t_siswa.nis AS nis_siswa, t_siswa.kelas AS kelas_siswa

FROM t_wali LEFT JOIN t_siswa ON t_wali.id_siswa = t_siswa.id_siswa");
$data = mysqli_fetch_array($query);

if (!$query) {
    die("Query gagal dijalankan: " . mysqli_error($connect));
}
?>



<div class="page-heading">
    <h3>Selamat datang di sistem pembayaran spp MI Al-Huda</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Biaya SPP</h6>
                                    <h6 class="font-extrabold mb-0">300.000 </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Nama (Siswa) <?= $data['nama_siswa'] ?></h6>
                                    <h6 class="font-extrabold mb-0">NISN/id</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Kelas</h6>
                                    <h6 class="font-extrabold mb-0">1</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
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
                </div>
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
                
                
                <div class="col-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Latest Comments</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Profil</th>
                                            <th>Siswa</th>
                                        </tr>
                                    </thead>
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
                                                    <p class="font-bold ms-3 mb-0">Kelas</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0"><?= $data['kelas_siswa'] ?></p>
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
