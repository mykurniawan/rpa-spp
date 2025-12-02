[PROJECT-SPP-RPA] [30%]
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
        lihat detile pembayaran[?]

login-logout-session [proses40%]
pengecekan salah login alert [OK]
pengecekan login alert [ok]



LOGIN V1 [WALI]
<?php 
session_start();
include "../connect.php";

// ambil data dari form login
$username = mysqli_real_escape_string($connect, $_POST['username']);
$password_plain = mysqli_real_escape_string($connect, $_POST['password']);

// cek username di database (password tidak dibandingkan di query)
$query = "SELECT * FROM t_wali WHERE username='$username' LIMIT 1";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) === 1) {

    $data = mysqli_fetch_assoc($result);

    // verifikasi password hash
    if (password_verify($password_plain, $data['password'])) {

        // simpan session 
        $_SESSION['id_wali'] = $data['id_wali'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['login_status'] = true;

        // redirect ke dashboard wali
        header("Location: ../page/walimurid/dashboard_wali.php?msg=login_success");
        exit();

    } else {
        // password salah
        header("Location: ../index.php?msg=login_failed");
        exit();
    }

} else {
    // username tidak ditemukan
    header("Location: ../index.php?msg=login_failed");
    exit();
}


?>
LOGIN V1 [WALI]
