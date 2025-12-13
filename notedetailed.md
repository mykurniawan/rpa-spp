[PROJECT-SPP-RPA] [40%] ==> [5x] [75%payed]
1. halaman wali [-detail]
    11. detail dashboard [onprogress]

2. halaman tu [-detail]
 21. jika mahasiswa sudah terdaftar dengan wali maka pilihan mahasiswa tidak muncul di input tambah wali [done]
 
3. halaman administrasi [-detail]

4. halaman wali
    41. t_pembayaran_spp fix this tabel:
        semester[done]
        status_validasi ENUM('Pending','Valid','Rejected') DEFAULT 'Pending'[done]
        tgl_validasi timestamp[?]
        lihat detile pembayaran[done]

5. kepala tata usaha
    51. halaman dashboard dll
    52. validasi pembayaran 
        report ke keuangan [?]

6. staff keuangan yayasan 
    61. halaman dashboard dll
    62. review report & laporan keuangan spp [?]

login-logout-session [proses100%]
pengecekan salah login alert [OK]
pengecekan login alert [ok]


Tambah Filter Lain (Contoh: status)
$filter = [];

if ($kelas !== '') {
    $filter[] = "p.kelas = '$kelas'";
}

$filter[] = "p.status_validasi = 'Pending'";

$where = '';
if (!empty($filter)) {
    $where = 'WHERE ' . implode(' AND ', $filter);
}

Tambah Filter Lain (Contoh: status)

[filterkelasfix]
$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';

$where = [];
// if ($kelas !== '') {
//     $kelas = mysqli_real_escape_string($connect, $kelas);
//     $where = "WHERE p.kelas = '$kelas'";
// }

if ($kelas !== '') {
    $kelas = mysqli_real_escape_string($connect, $kelas);
    $where[] = "p.kelas = '$kelas'";
}

if ($semester !== '') {
    $semester = mysqli_real_escape_string($connect, $semester);
    $where[] = "p.semester = '$semester'";
}

$where_sql = '';
if (!empty($where)) {
    $where_sql = 'WHERE ' . implode(' AND ', $where);
}

$sql = "SELECT 
        p.id_pembayaran,
        p.tgl_bayar,
        p.semester,
        p.kelas,
        p.status_validasi,
        p.jumlah_bayar,
        p.tgl_validasi,
        w.nama AS nama_wali,
        s.nama AS nama_siswa
    FROM t_pembayaran_spp p
    LEFT JOIN t_wali w ON p.id_wali = w.id_wali
    LEFT JOIN t_siswa s ON p.id_siswa = s.id_siswa
    $where_sql
    ORDER BY p.id_pembayaran DESC
";

$query = mysqli_query($connect, $sql);

if (!$query) {
    die("Query gagal dijalankan: " . mysqli_error($connect));
}
[filterkelasfix]


