<?php include "../../templates/sidebar/sidebar_administrasi.php" ?>
<?php
include "../../connect.php";
$query = mysqli_query($connect, "SELECT * FROM t_siswa");

if (!$query) {
    die("Query Error : " . mysqli_errno($connect) .
        " - " . mysqli_error($connect));
}
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Form Layout</h3>
                <p class="text-subtitle text-muted">Multiple form layouts, you can use.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pembayaran SPP</li>
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
                        <h4 class="card-title">Masukkan Data Siswa</h4>
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
                                }
                            }
                            ?>
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Siswa</th>
                                        <th>Nama Lengkap</th>
                                        <th>NIS</th>
                                        <th>Kelas</th>
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
                                            echo "<td>" . htmlspecialchars($data['id_siswa']) . "</td>";
                                            echo "<td>" . htmlspecialchars($data['nama']) . "</td>";
                                            echo "<td>" . htmlspecialchars($data['nis']) . "</td>";
                                            echo "<td>" . htmlspecialchars($data['kelas']) . "</td>";
                                            echo "<td>";
                                            echo "<a href='edit_form_siswa.php?id=" . urlencode($data['id_siswa']) . "' class='btn btn-sm btn-primary me-1'><i class='bi bi-pencil'></i> Edit</a>";
                                            echo "<a href='proses_hapus_data_siswa.php?id=" . urlencode($data['id_siswa']) . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus data siswa ini?');\"><i class='bi bi-trash'></i> Hapus</a>";

                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>Belum ada data siswa</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <script>
                                // Auto-fade and remove alerts after 4 seconds
                                document.addEventListener('DOMContentLoaded', function() {
                                    var alerts = document.querySelectorAll('.alert');
                                    alerts.forEach(function(alert) {
                                        setTimeout(function() {
                                            alert.style.transition = 'opacity 0.5s ease';
                                            alert.style.opacity = '0';
                                            setTimeout(function() { if (alert.parentNode) alert.parentNode.removeChild(alert); }, 500);
                                        }, 4000);
                                    });
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