<?php
session_start();
if (!isset($_SESSION['login_status']) || $_SESSION['role'] !== "Petugas Administrasi") {
    header("Location: ../../index.php?msg=not_allowed");
    exit();
}
?>
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
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" value="<?php echo htmlspecialchars($data['nis']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jk" name="jk" required>
                                <option value="">--Pilih--</option>
                                <option value="Laki-laki" <?php if ($data['jk'] === 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                <option value="Perempuan" <?php if ($data['jk'] === 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo htmlspecialchars($data['tempat_lahir']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo htmlspecialchars($data['tgl_lahir']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo htmlspecialchars($data['alamat']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_wali" class="form-label">Nama Wali</label>
                            <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?php echo htmlspecialchars($data['nama_wali']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                            <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" value="<?php echo htmlspecialchars($data['pekerjaan_wali']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas" name="kelas" required>
                                <option value="">--Pilih Kelas--</option>
                                <option value="1" <?php if ($data['kelas'] === '1') echo 'selected'; ?>>1</option>
                                <option value="2" <?php if ($data['kelas'] === '2') echo 'selected'; ?>>2</option>
                                <option value="3" <?php if ($data['kelas'] === '3') echo 'selected'; ?>>3</option>
                                <option value="4" <?php if ($data['kelas'] === '4') echo 'selected'; ?>>4</option>
                                <option value="5" <?php if ($data['kelas'] === '5') echo 'selected'; ?>>5</option>
                                <option value="6" <?php if ($data['kelas'] === '6') echo 'selected'; ?>>6</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="<?php echo htmlspecialchars($data['asal_sekolah']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="edit_siswa.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../../templates/footer.php"; ?>