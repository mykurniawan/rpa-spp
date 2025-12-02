<?php
session_start();
if (!isset($_SESSION['login_status']) || $_SESSION['role'] !== "Petugas TU") {
    header("Location: ../../index.php?msg=not_allowed");
    exit();
}
?>
<?php include "../../templates/sidebar/sidebar_tu.php" ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Input Akun Wali Siswa</h3>
                <p class="text-subtitle text-muted">Masukkan data wali siswa dengan baik</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard_tu.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Input Data Wali Siswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Masukkan Data Wali Siswa</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="../../proses/proses_input_wali.php">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Username</label>
                                            <input type="text" id="username" class="form-control"
                                                placeholder="Username" name="username">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Password</label>
                                            <input type="password" id="password" class="form-control"
                                                placeholder="Password" name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Nama Lengkap</label>
                                            <input type="text" id="nama" class="form-control"
                                                placeholder="Nama Lengkap" name="nama" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Jenis Kelamin</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="jk" name="jk" required>
                                                    <option value="">--Pilih--</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Tempat Lahir</label>
                                            <input type="text" id="tempat_lahir" class="form-control"
                                                name="tempat_lahir" placeholder="Tempat Lahir" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Tanggal Lahir</label>
                                            <input type="date" id="tgl_lahir" class="form-control"
                                                name="tgl_lahir" placeholder="Tanggal Lahir" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Alamat</label>
                                            <input type="text" id="alamat" class="form-control"
                                                name="alamat" placeholder="Alamat" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">No. Telepon</label>
                                            <input type="text" id="no_telepon" class="form-control"
                                                name="no_telepon" placeholder="No. Telepon" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">email</label>
                                            <input type="text" id="email" class="form-control"
                                                name="email" placeholder="email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="id_siswa" class="form-label">Nama Siswa</label>
                                            <select class="form-select" id="id_siswa" name="id_siswa" required>
                                                <option value="">--Pilih Siswa--</option>
                                                <?php
                                                include_once "../../connect.php";
                                                $siswa_query = mysqli_query(
                                                    $connect,
                                                    "SELECT t_siswa.id_siswa, t_siswa.nama FROM t_siswa 
                                                    LEFT JOIN t_wali ON t_siswa.id_siswa = t_wali.id_siswa
                                                    WHERE t_wali.id_siswa IS NULL
                                                    ORDER BY t_siswa.nama ASC"
                                                );
                                                while ($siswa = mysqli_fetch_assoc($siswa_query)) {
                                                    echo '<option value="' . htmlspecialchars($siswa['id_siswa']) . '">'
                                                        . htmlspecialchars($siswa['nama']) .
                                                        '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>



<?php include "./../../templates/footer.php" ?>