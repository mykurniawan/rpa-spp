<?php
include "../../connect.php";

// Ambil id siswa dari parameter GET
if (!isset($_GET['id'])) {
    header("Location: edit_siswa.php");
    exit();
}
$id_siswa = $_GET['id'];

// Ambil data siswa dari database
$query = mysqli_query($connect, "SELECT * FROM t_siswa WHERE id_siswa='" . mysqli_real_escape_string($connect, $id_siswa) . "'");
$data = mysqli_fetch_assoc($query);
if (!$data) {
    echo "<div class='alert alert-danger'>Data siswa tidak ditemukan.</div>";
    exit();
}
?>
<?php include "../../templates/sidebar/sidebar_administrasi.php"; ?>
<div class="page-heading">
    <h3>Edit Data Siswa</h3>
</div>
<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Siswa</h4>
                </div>
                <div class="card-body">
                    <form action="../../proses/proses_edit_data_siswa.php" method="POST">
                        <input type="hidden" name="id_siswa" value="<?php echo htmlspecialchars($data['id_siswa']); ?>">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" value="<?php echo htmlspecialchars($data['nis']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" value="<?php echo htmlspecialchars($data['kelas']); ?>" required>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Aktif" <?php echo strtolower($data['status']) == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
                                <option value="Nonaktif" <?php echo strtolower($data['status']) == 'nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
                            </select>
                        </div> -->
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="edit_siswa.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../../templates/footer.php"; ?>
