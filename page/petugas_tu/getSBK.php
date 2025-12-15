<?php
include "../../connect.php";

$kelas = $_GET['kelas'] ?? '';

if ($kelas == '') {
    exit;
}

$kelas = mysqli_real_escape_string($connect, $kelas);

$query = mysqli_query(
    $connect,
    "SELECT s.id_siswa, s.nama 
     FROM t_siswa s
     LEFT JOIN t_wali w ON s.id_siswa = w.id_siswa
     WHERE s.kelas = '$kelas'
       AND w.id_siswa IS NULL
     ORDER BY s.nama ASC"
);

echo '<option value="">-- Pilih Siswa --</option>';

while ($row = mysqli_fetch_assoc($query)) {
    echo '<option value="' . htmlspecialchars($row['id_siswa']) . '">'
        . htmlspecialchars($row['nama']) .
        '</option>';
}
