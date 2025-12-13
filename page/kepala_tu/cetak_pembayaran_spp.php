<?php
include "../../connect.php";

$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';

$where = "WHERE p.status_validasi = 'Valid'";

if ($kelas != '') {
    $kelas = mysqli_real_escape_string($connect, $kelas);
    $where .= " AND p.kelas = '$kelas'";
}

$query = mysqli_query($connect, "
    SELECT 
        p.id_pembayaran,
        p.tgl_bayar,
        p.semester,
        p.kelas,
        p.status_validasi,
        p.tgl_validasi,
        w.nama AS nama_wali,
        s.nama AS nama_siswa
    FROM t_pembayaran_spp p
    LEFT JOIN t_wali w ON p.id_wali = w.id_wali
    LEFT JOIN t_siswa s ON p.id_siswa = s.id_siswa
    $where
    ORDER BY p.id_pembayaran DESC
");

if (!$query) {
    die('Query gagal: ' . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pembayaran SPP</title>

    <style>
        /* SETTING KERTAS */
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            color: #000;
        }

        h2,
        h4 {
            text-align: center;
            margin: 0;
        }

        hr {
            margin: 10px 0;
            border: 1px solid #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background-color: #eee;
            text-align: center;
        }

        td {
            vertical-align: middle;
        }

        .ttd {
            margin-top: 50px;
            width: 100%;
        }

        .ttd div {
            width: 30%;
            float: right;
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">

    <h2>LAPORAN PEMBAYARAN SPP</h2>
    <h4>
    Kelas : <?= ($kelas == '') ? 'Semua Kelas' : htmlspecialchars($kelas) ?>
</h4>

    <h4>TAHUN AJARAN <?= date('Y') ?></h4>
    <hr>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Wali</th>
                <th>Siswa</th>
                <th>Tanggal Bayar</th>
                <th>Kelas</th>
                <th>Semester</th>
                <th>Status</th>
                <th>Tgl Validasi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            while ($row = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td align="center"><?= $no++ ?></td>
                    <td><?= $row['id_pembayaran'] ?></td>
                    <td><?= $row['nama_wali'] ?></td>
                    <td><?= $row['nama_siswa'] ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tgl_bayar'])) ?></td>
                    <td align="center"><?= $row['kelas'] ?></td>
                    <td><?= $row['semester'] ?></td>
                    <td><?= $row['status_validasi'] ?></td>
                    <td><?= $row['tgl_validasi'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="ttd">
        <div>
            <p>Malang, <?= date('d F Y') ?></p>
            <p>Kepala TU</p>
            <br><br><br>
            <p><b>( ___________________ )</b></p>
        </div>
    </div>

</body>

</html>