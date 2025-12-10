<?php
session_start();
if (!isset($_SESSION['login_status']) || $_SESSION['role'] !== "Kepala TU") {
    header("Location: ../../index.php?msg=not_allowed");
    exit();
}

include "../../connect.php";

// Pastikan ID dikirim dari halaman sebelumnya
if (!isset($_GET['id'])) {
    header("Location: daftar_pembayaran.php?msg=no_id");
    exit();
}

$id = $_GET['id'];

// Query hanya data berdasarkan ID yang diklik
$query = mysqli_query($connect, "
    SELECT 
        t_pembayaran_spp.id_pembayaran,
        t_pembayaran_spp.id_wali,
        t_pembayaran_spp.tgl_bayar,
        t_pembayaran_spp.semester,
        t_pembayaran_spp.kelas,
        t_pembayaran_spp.status_validasi,
        t_siswa.nama AS nama_siswa
    FROM t_pembayaran_spp
    LEFT JOIN t_siswa ON t_pembayaran_spp.id_siswa = t_siswa.id_siswa
    WHERE t_pembayaran_spp.id_pembayaran = '$id'
    LIMIT 1
");

if (!$query) {
    die("Query gagal: " . mysqli_error($connect));
}

$data = mysqli_fetch_assoc($query);
?>

<?php include "../../templates/sidebar/sidebar_tu.php"; ?>

<div class="page-heading">
    <h3>Form ACC Pembayaran SPP</h3>
</div>

<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Detail Pembayaran</h4>
                </div>

                <div class="card-body">
                    <form action="../../proses/proses_acc_spp.php" method="POST">
                        <input type="hidden" name="id_pembayaran" value="<?= htmlspecialchars($data['id_pembayaran']); ?>">

                        <div class="mb-3">
                            <label class="form-label">Tanggal Bayar</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($data['tgl_bayar']); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($data['nama_siswa']); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($data['kelas']); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($data['semester']); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($data['status_validasi']); ?>" readonly>
                        </div>

                        <button type="submit" name="acc" class="btn btn-success">
                            ✔ ACC Pembayaran
                        </button>

                        <a href="../kepalatu/data_validasi_pembayaran_spp.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include "../../templates/footer.php"; ?>
