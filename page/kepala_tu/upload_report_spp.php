<?php
session_start();
if (!isset($_SESSION['login_status']) || $_SESSION['role'] !== "Kepala TU") {
    header("Location: ../../index.php?msg=not_allowed");
    exit();
}
?>
<?php include "../../connect.php";
// $kelas    = isset($_GET['kelas']) ? $_GET['kelas'] : '';
// $semester = isset($_GET['semester']) ? $_GET['semester'] : '';

// $conditions = [];

// if ($kelas !== '') {
//     $kelas = mysqli_real_escape_string($connect, $kelas);
//     $conditions[] = "p.kelas = '$kelas'";
// }

// if ($semester !== '') {
//     $semester = mysqli_real_escape_string($connect, $semester);
//     $conditions[] = "p.semester = '$semester'";
// }

// $where = '';
// if (!empty($conditions)) {
//     $where = 'WHERE ' . implode(' AND ', $conditions);
// }


// $sql = "SELECT 
//         p.id_pembayaran,
//         p.tgl_bayar,
//         p.semester,
//         p.kelas,
//         p.status_validasi,
//         p.jumlah_bayar,
//         p.tgl_validasi,
//         w.nama AS nama_wali,
//         s.nama AS nama_siswa
//     FROM t_pembayaran_spp p
//     LEFT JOIN t_wali w ON p.id_wali = w.id_wali
//     LEFT JOIN t_siswa s ON p.id_siswa = s.id_siswa
//     $where
//     ORDER BY p.id_pembayaran DESC
// ";

// $query = mysqli_query($connect, $sql);

// if (!$query) {
//     die('Query gagal: ' . mysqli_error($connect));
// }

?>

<?php include "../../templates/sidebar/sidebar_kepala_tu.php" ?>
<div class="page-heading">
    <?php
    if (isset($_GET['msg'])) {

        $msg = $_GET['msg'];
        if ($msg === 'login_success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Login Berhasil (Selamat Datang).<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
        }
    }
    ?>

    <?php
    // Notifikasi pesan sukses / gagal input data
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        if ($msg === 'input_success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">File report berhasil diupload.<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
        } elseif ($msg === 'input_failed') {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal upload file report.<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
        }
    }
    ?>
    <h3>Selamat datang di sistem pembayaran spp MI Al-Huda</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Upload Report SPP</h4>
                        </div>
                        <div class="card-body">


                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Upload file report pembayaran SPP berdasarkan kelas
                                    </h5>
                                </div>
                                <div class="card-body">

                                    <form class="form form-horizontal" method="post" action="../../proses/proses_upload_report_spp.php" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="first-name-horizontal">Tanggal Upload</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="date" id="tgl_bayar" class="form-control" name="tgl_upload">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="first-name-horizontal">Kelas</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <fieldset class="form-group">
                                                        <select class="form-select" id="kelas" name="kelas" required>
                                                            <option value="">-- Pilih Kelas --</option>
                                                            <option value="1">Kelas 1</option>
                                                            <option value="2">Kelas 2</option>
                                                            <option value="3">Kelas 3</option>
                                                            <option value="4">Kelas 4</option>
                                                            <option value="5">Kelas 5</option>
                                                            <option value="6">Kelas 6</option>
                                                        </select>
                                                    </fieldset>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="first-name-horizontal">Semester</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <fieldset class="form-group">
                                                        <select class="form-select" id="semester" name="semester" required>
                                                            <option value="">--Pilih--</option>
                                                            <option value="Ganjil">Ganjil</option>
                                                            <option value="Genap">Genap</option>
                                                        </select>
                                                    </fieldset>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="kwitansi">Report</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="file" id="file_report" class="form-control" name="file_report"
                                                        placeholder="file_report" required>
                                                </div>
                                                
                                                <div class="col-sm-12 mt-5 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <!-- <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- <div id="chart-profile-visit"></div> -->
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="../../assets/compiled/jpg/1.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">John Duck</h5>
                            <h6 class="text-muted mb-0">@johnducky</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Recent Messages</h4>
                </div>
                <div class="card-content pb-4">
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="../assets/compiled/jpg/4.jpg">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Hank Schrader</h5>
                            <h6 class="text-muted mb-0">@johnducky</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="../assets/compiled/jpg/5.jpg">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Dean Winchester</h5>
                            <h6 class="text-muted mb-0">@imdean</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="../assets/compiled/jpg/1.jpg">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">John Dodol</h5>
                            <h6 class="text-muted mb-0">@dodoljohn</h6>
                        </div>
                    </div>
                    <div class="px-4">
                        <button class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Start Conversation</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Visitors Profile</h4>
                </div>
                <div class="card-body">
                    <div id="chart-visitors-profile"></div>
                </div>
            </div>
        </div> -->
    </section>
</div>
<?php include "./../../templates/footer.php" ?>


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
                    // Replace current history entry without reloading
                    window.history.replaceState(null, document.title, url.pathname + url.search + url.hash);
                }
            } catch (e) {
                // ignore on older browsers
            }
        }
    });
</script>