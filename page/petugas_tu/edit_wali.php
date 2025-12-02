<?php
session_start();
if (!isset($_SESSION['login_status']) || $_SESSION['role'] !== "Petugas TU") {
    header("Location: ../../index.php?msg=not_allowed");
    exit();
}
?>
<?php include "../../templates/sidebar/sidebar_tu.php" ?>
<?php
include "../../connect.php";
$query = mysqli_query($connect, "SELECT t_wali.*, t_siswa.nama AS nama_siswa FROM t_wali 
            LEFT JOIN t_siswa ON t_wali.id_siswa = t_siswa.id_siswa");


if (!$query) {
    die("Query Error : " . mysqli_errno($connect) .
        " - " . mysqli_error($connect));
}
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Data Wali Siswa</h3>
                <p class="text-subtitle text-muted">Masukkan data wali siswa dengan baik</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard_tu.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Data Wali Siswa</li>
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
                        <h4 class="card-title">Data Wali Siswa</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <?php
                            // Notifikasi pesan sukses / gagal dari proses edit/hapus (dismissible + auto-fade)
                            if (isset($_GET['msg'])) {
                                $msg = $_GET['msg'];
                                if ($msg === 'edit_sukses') {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Data siswa berhasil diperbarui.<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
                                } elseif ($msg === 'edit_gagal') {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Terjadi kesalahan saat memperbarui data.<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
                                } elseif ($msg === 'hapus_sukses') {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Data siswa berhasil dihapus.<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
                                } elseif ($msg === 'hapus_gagal') {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal menghapus data siswa.<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
                                } elseif ($msg === 'input_sukses') {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Data siswa berhasil ditambahkan.<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
                                } elseif ($msg === 'input_gagal') {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal menambahkan data siswa.<button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button></div>';
                                }
                            }
                            ?>
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Wali</th>
                                        <th>Username</th>
                                        <!-- <th>Password</th> -->
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tempat Lahir</th>
                                   
                                        <!-- <th>Tanggal Lahir</th> -->
                                        <!-- <th>Alamat</th> -->
                                        <th>Nama Siswa</th>
                             
                                        <th>Options</th>
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
                                            echo "<td>" . htmlspecialchars($data['id_wali']) . "</td>";
                                            echo "<td>" . htmlspecialchars($data['username']) . "</td>";
                                            // echo "<td>" . htmlspecialchars($data['password']) . "</td>";
                                            echo "<td>" . htmlspecialchars($data['nama']) . "</td>";
                                            echo "<td>" . htmlspecialchars($data['jenis_kelamin']) . "</td>";
                                            echo "<td>" . htmlspecialchars($data['tempat_lahir']) . "</td>";
                                            // echo "<td>" . htmlspecialchars($data['tgl_lahir']) . "</td>";
                                            // echo "<td>" . htmlspecialchars($data['alamat']) . "</td>";
                                            // echo "<td>" . htmlspecialchars($data['no_telpon']) . "</td>";
                                            // echo "<td>" . htmlspecialchars($data['email']) . "</td>";
                                            echo "<td>" . htmlspecialchars($data['nama_siswa']) . "</td>";
                                            echo "<td>";
                                            echo "<a href='edit_form_wali.php?id=" . urlencode($data['id_wali']) . "' class='btn btn-sm btn-primary me-1'><i class='bi bi-pencil'></i> Edit</a>";
                                            echo "<a href='../../proses/proses_hapus_data_wali.php?id=" . urlencode($data['id_wali']) . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus data wali ini?');\"><i class='bi bi-trash'></i> Hapus</a>";

                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>Belum ada data wali</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <script>
                                // Auto-fade and remove alerts after 4 seconds
                                document.addEventListener('DOMContentLoaded', function() {
                                    var alerts = document.querySelectorAll('.alert');
                                    if (alerts.length) {
                                        alerts.forEach(function(alert) {
                                            setTimeout(function() {
                                                alert.style.transition = 'opacity 0.5s ease';
                                                alert.style.opacity = '0';
                                                setTimeout(function() { if (alert.parentNode) alert.parentNode.removeChild(alert); }, 500);
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

<?php include "./../../templates/footer.php" ?>