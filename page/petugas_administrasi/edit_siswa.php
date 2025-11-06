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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

<?php include "./../../templates/footer.php" ?>