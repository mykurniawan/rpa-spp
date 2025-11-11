<?php include "../../templates/sidebar/sidebar_administrasi.php" ?>
<?php include "../../connect.php";
$query = mysqli_query($connect, "SELECT * FROM t_siswa");

if (!$query) {
    die("Query gagal dijalankan: " . mysqli_error($connect));
}
?>

<?php
// Notifikasi pesan sukses / gagal input data siswa (dismissible + auto-fade)
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    if ($msg === 'input_sukses') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Data siswa berhasil ditambahkan.<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
    } elseif ($msg === 'input_gagal') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal menambahkan data siswa.<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
    }
}
?>
<div class="page-heading">
    <h3>Selamat datang di sistem pembayaran spp MI Al-Huda</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <!-- <div class="col-6 col-lg-3 col-md-6">
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
                </div> -->
                <!-- <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jumlah Siswa</h6>
                                    <h6 class="font-extrabold mb-0">NISN/id</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <a href="../../page/petugas_administrasi/input_data_siswa.php">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Tambah Siswa</h6>
                                        <!-- <h6 class="font-extrabold mb-0">1</h6> -->
                                    </div>
                                </div>
                            </div>
                        </a>
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
                                    <h6 class="text-muted font-semibold">Saved Post</h6>
                                    <h6 class="font-extrabold mb-0">112</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Siswa</h4>
                        </div>
                        <div class="card-body">
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
                                                <th>ID Siswa</th>
                                                <th>NIS</th>
                                                <th>Nama Lengkap</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Alamat</th>
                                                <th>Kelas</th>
                                                <th>Nama Wali</th>
                                                <th>Pekerjaan Wali</th>
                                                <th>Asal Sekolah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // inisialisasi nomor urut
                                            $no = 1;

                                            // cek apakah ada data
                                            if (mysqli_num_rows($query) > 0) {
                                                while ($data = mysqli_fetch_assoc($query)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $no++ . "</td>"; // nomor urut
                                                    echo "<td>" . htmlspecialchars($data['id_siswa']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($data['nis']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($data['nama']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($data['jk']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($data['tempat_lahir']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($data['tgl_lahir']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($data['alamat']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($data['kelas']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($data['nama_wali']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($data['pekerjaan_wali']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($data['asal_sekolah']) . "</td>";
                                                    echo "<td>";

                                                    // tampilkan status aktif/nonaktif dengan badge warna
                                                    // if (strtolower($data['status']) == 'aktif') {
                                                    //     echo "<span class='badge bg-success'>Aktif</span>";
                                                    // } else {
                                                    //     echo "<span class='badge bg-danger'>Nonaktif</span>";
                                                    // }

                                                    // echo "</td>";
                                                    // echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='6' class='text-center'>Belum ada data siswa</td></tr>";
                                            }
                                            ?>
                                        </tbody>
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
                                    </table>
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
<?php include "./../../templates/footer.php" ?>