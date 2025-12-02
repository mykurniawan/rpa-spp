<?php
session_start();
if (!isset($_SESSION['login_status']) || $_SESSION['role'] !== "Petugas TU") {
    header("Location: ../../index.php?msg=not_allowed");
    exit();
}
?>
<?php
include "../../connect.php";

// Ambil id siswa dari parameter GET
if (!isset($_GET['id'])) {
    header("Location: edit_wali.php");
    exit();
}
$id_wali = $_GET['id'];

// Ambil data siswa dari database
// Query data wali sesuai id_wali yang dipilih
$query = mysqli_query($connect, "SELECT t_wali.*, t_siswa.nama AS nama_siswa FROM t_wali LEFT JOIN t_siswa ON t_wali.id_siswa = t_siswa.id_siswa WHERE t_wali.id_wali='" . mysqli_real_escape_string($connect, $id_wali) . "'");
// $query = mysqli_query($connect, "SELECT * FROM t_wali WHERE id_wali='" . mysqli_real_escape_string($connect, $id_wali) . "'");
$data = mysqli_fetch_assoc($query);
if (!$data) {
    echo "<div class='alert alert-danger'>Data siswa tidak ditemukan.</div>";
    exit();
}
?>
<?php include "../../templates/sidebar/sidebar_tu.php"; ?>
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
                    <form action="../../proses/proses_edit_data_wali.php" method="POST">
                        <input type="hidden" name="id_wali" value="<?php echo htmlspecialchars($data['id_wali']); ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($data['username']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($data['password']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">--Pilih--</option>
                                <option value="Laki-laki" <?php if ($data['jenis_kelamin'] === 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                <option value="Perempuan" <?php if ($data['jenis_kelamin'] === 'Perempuan') echo 'selected'; ?>>Perempuan</option>
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
                            <label for="no_telpon" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control" id="no_telpon" name="no_telpon" value="<?php echo htmlspecialchars($data['no_telpon']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_siswa" class="form-label">Nama Siswa</label>
                            <select class="form-select" id="id_siswa" name="id_siswa" required>
                                <option value="">--Pilih Siswa--</option>
                                <?php
                                $siswa_query = mysqli_query($connect, "SELECT id_siswa, nama FROM t_siswa ORDER BY nama ASC");
                                while ($siswa = mysqli_fetch_assoc($siswa_query)) {
                                    $selected = ($siswa['id_siswa'] == $data['id_siswa']) ? 'selected' : '';
                                    echo '<option value="' . htmlspecialchars($siswa['id_siswa']) . '" ' . $selected . '>' . htmlspecialchars($siswa['nama']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="edit_wali.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../../templates/footer.php"; ?>