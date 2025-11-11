<?php include "../../templates/sidebar/sidebar_administrasi.php" ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Input Data Siswa</h3>
                <p class="text-subtitle text-muted">Masukkan data siswa dengan baik</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Input Data Siswa</li>
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
                            <form class="form" method="post" action="../../proses/proses_input_siswa.php">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">NIS</label>
                                            <input type="text" id="nis" class="form-control"
                                                placeholder="NIS" name="nis">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Nama Lengkap</label>
                                            <input type="text" id="nama" class="form-control"
                                                placeholder="Nama Lengkap" name="nama" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Jenis Kelamin</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="jk" name="jk" required>
                                                    <option value="">--Pilih--</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Tempat Lahir</label>
                                            <input type="text" id="tempat_lahir" class="form-control"
                                                name="tempat_lahir" placeholder="Tempat Lahir" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Tanggal Lahir</label>
                                            <input type="date" id="tgl_lahir" class="form-control"
                                                name="tgl_lahir" placeholder="Tanggal Lahir" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Alamat</label>
                                            <input type="text" id="alamat" class="form-control"
                                                name="alamat" placeholder="Alamat" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Kelas</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="kelas" name="kelas" required>
                                                    <option value="">--Pilih Kelas--</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                </select >
                                            </fieldset>
                                            <!-- <input type="text" id="kelas" class="form-control"
                                                name="kelas" placeholder="Kelas" required> -->
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Nama Walimurid</label>
                                            <input type="text" id="nama_walimurid" class="form-control"
                                                name="nama_walimurid" placeholder="Nama Walimurid" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Pekerjaan Walimurid</label>
                                            <input type="text" id="pekerjaan_walimurid" class="form-control"
                                                name="pekerjaan_walimurid" placeholder="Pekerjaan Walimurid" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Asal Sekolah</label>
                                            <input type="text" id="asal_sekolah" class="form-control"
                                                name="asal_sekolah" placeholder="Asal Sekolah" required>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group col-12">
                                        <div class='form-check'>
                                            <div class="checkbox">
                                                <input type="checkbox" id="checkbox5" class='form-check-input' checked>
                                                <label for="checkbox5">Remember Me</label>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>



<?php include "./../../templates/footer.php" ?>