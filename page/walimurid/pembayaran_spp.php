<?php include "../../templates/sidebar/sidebar_wali.php"; ?>
<?php include "../../connect.php";
// UJI COBA 
// $query = mysqli_query($connect, "SELECT t_wali.*, 
//             t_siswa.id_siswa AS id_siswa
//             FROM t_wali LEFT JOIN t_siswa ON t_wali.id_siswa = t_siswa.id_siswa");

$query = mysqli_query($connect, "SELECT t_wali.id_wali as id_wali, 
           t_wali.id_siswa as id_siswa FROM t_wali LEFT JOIN t_siswa 
           ON t_wali.id_siswa = t_siswa.id_siswa");
$data = mysqli_fetch_array($query);
if (!$query) {
    die("Query gagal dijalankan: " . mysqli_error($connect));
}

?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Form Pembayaran SPP</h3>
                <p class="text-subtitle text-muted">Pembayaran SPP MI Al-Huda</p>
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
    <!-- <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Multiple Column</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Tanggal Bayar</label>
                                            <input type="date" id="tgl_bayar" class="form-control"
                                                placeholder="Tanggal Bayar" name="tgl_bayar">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Semester</label>
                                            <input type="text" id="last-name-column" class="form-control"
                                                placeholder="Semester" name="semester">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Masukkan Nominal Jumlah Bayar</label>
                                            <input type="text" id="city-column" class="form-control" placeholder="Contoh : 300000"
                                                name="jumlah_bayar">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Kwitansi</label>
                                            <input type="file" id="kwitansi" class="form-control"
                                                name="kwitansi" placeholder="kwitansi">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Catatan</label>
                                            <input type="text" id="catatan" class="form-control"
                                                name="catatan" placeholder="Catatan (optional)">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Email</label>
                                            <input type="email" id="email-id-column" class="form-control"
                                                name="email-id-column" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class='form-check'>
                                            <div class="checkbox">
                                                <input type="checkbox" id="checkbox5" class='form-check-input' checked>
                                                <label for="checkbox5">Remember Me</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- // Basic multiple Column Form section end -->

    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Masukkan Data Pembayaran SPP</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="post" action="../../proses/proses_pembayaran_spp.php" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- <label for="first-name-horizontal">id wali</label> -->
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="id_wali" class="form-control" name="id_wali"
                                                placeholder="id wali" hidden value="<?= $data['id_wali'] ?>"> <!--ambil dari session login nanti -->
                                        </div>
                                        <div class="col-md-4">
                                            <!-- <label for="first-name-horizontal">Tanggal Bayar</label> -->
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="id_siswa" class="form-control" name="id_siswa"
                                                placeholder="Tanggal Bayar" hidden value="<?= $data['id_siswa'] ?>"> <!--ambil dari session login nanti -->
                                        </div>
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Tanggal Bayar</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" id="tgl_bayar" class="form-control" name="tgl_bayar"
                                                placeholder="Tanggal Bayar">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="kwitansi">Kwitansi</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="file" id="kwitansi" class="form-control" name="kwitansi"
                                                placeholder="Kwitansi">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Masukkan Jumlah Nominal</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="jumlah_nominal" class="form-control" name="jumlah_nominal"
                                                placeholder="Contoh : 300000">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Catatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="catatan" class="form-control" name="catatan"
                                                placeholder="Catatan (optional)">
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- // Basic Horizontal form layout section end -->
    <!-- Basic Horizontal form layout section start -->
    <!-- <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Horizontal Form</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">First Name</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="file" id="first-name-horizontal" class="form-control" name="fname"
                                                placeholder="First Name">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Email</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" id="email-horizontal" class="form-control" name="email-id"
                                                placeholder="Email">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contact-info-horizontal">Mobile</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="contact-info-horizontal" class="form-control" name="contact"
                                                placeholder="Mobile">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-horizontal">Password</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="password" id="password-horizontal" class="form-control" name="password"
                                                placeholder="Password">
                                        </div>
                                        <div class="col-12 col-md-8 offset-md-4 form-group">
                                            <div class='form-check'>
                                                <div class="checkbox">
                                                    <input type="checkbox" id="checkbox1" class='form-check-input'
                                                        checked>
                                                    <label for="checkbox1">Remember Me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Horizontal Form with Icons</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal-icon">Name</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Name"
                                                        id="first-name-horizontal-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal-icon">Email</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="email" class="form-control" placeholder="Email"
                                                        id="email-horizontal-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contact-info-horizontal-icon">Mobile</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="number" class="form-control" placeholder="Mobile" id="contact-info-horizontal-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-phone"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-horizontal-icon">Password</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="password" class="form-control" placeholder="Password" id="password-horizontal-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-8 offset-md-4">
                                            <div class='form-check'>
                                                <div class="checkbox">
                                                    <input type="checkbox" id="checkbox2" class='form-check-input'
                                                        checked>
                                                    <label for="checkbox2">Remember Me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- // Basic Horizontal form layout section end -->

    <!-- Basic Vertical form layout section start -->
    <!-- <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Vertical Form</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">First Name</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="fname" placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Email</label>
                                                <input type="email" id="email-id-vertical" class="form-control"
                                                    name="email-id" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Mobile</label>
                                                <input type="number" id="contact-info-vertical" class="form-control"
                                                    name="contact" placeholder="Mobile">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-vertical">Password</label>
                                                <input type="password" id="password-vertical" class="form-control"
                                                    name="contact" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class='form-check'>
                                                <div class="checkbox">
                                                    <input type="checkbox" id="checkbox3" class='form-check-input'
                                                        checked>
                                                    <label for="checkbox3">Remember Me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Vertical Form with Icons</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">First Name</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control"
                                                        placeholder="Input with icon left" id="first-name-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">

                                            <div class="form-group has-icon-left">
                                                <label for="email-id-icon">Email</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Email"
                                                        id="email-id-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="mobile-id-icon">Mobile</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Mobile"
                                                        id="mobile-id-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-phone"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="password-id-icon">Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control" placeholder="Password"
                                                        id="password-id-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class='form-check'>
                                                <div class="checkbox mt-2">
                                                    <input type="checkbox" id="remember-me-v" class='form-check-input'
                                                        checked>
                                                    <label for="remember-me-v">Remember Me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- // Basic Vertical form layout section end -->



</div>

<?php include "../../templates/footer.php" ?>