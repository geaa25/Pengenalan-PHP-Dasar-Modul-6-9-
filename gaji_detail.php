<?php
include 'koneksi.php';
include 'includes/sidebar.php';

$id = $_GET['id'];
$query = "
    SELECT g.*, k.nama, j.nama_jabatan, j.gaji_pokok, 
           r.nilai_rating, l.jumlah_jam, t.tarif_per_jam
    FROM gaji g
    JOIN karyawan k ON g.karyawan_id = k.id
    JOIN jabatan j ON k.jabatan_id = j.id
    LEFT JOIN rating r ON r.karyawan_id = k.id AND r.bulan = g.bulan
    LEFT JOIN lembur l ON l.karyawan_id = k.id AND l.bulan = g.bulan
    LEFT JOIN lembur t ON j.id = t.jabatan_id
    WHERE g.id = $id
";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

$total_lembur = $data['jumlah_jam'] * $data['tarif_per_jam'];
$total_gaji = $data['gaji_pokok'] + $total_lembur;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar sudah dimasukkan via include -->

        <!-- Konten Utama -->
        <div class="col-md-10 ms-sm-auto col-lg-10 px-4 mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Detail Gaji Karyawan</h4>
                <a href="gaji.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Nama Karyawan</th>
                        <td><?= $data['nama'] ?></td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td><?= $data['nama_jabatan'] ?></td>
                    </tr>
                    <tr>
                        <th>Bulan</th>
                        <td><?= $data['bulan'] ?></td>
                    </tr>
                    <tr>
                        <th>Gaji Pokok</th>
                        <td>Rp <?= number_format($data['gaji_pokok'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Jam Lembur</th>
                        <td><?= $data['jumlah_jam'] ?? 0 ?> jam</td>
                    </tr>
                    <tr>
                        <th>Tarif Lembur / Jam</th>
                        <td>Rp <?= number_format($data['tarif_per_jam'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Total Lembur</th>
                        <td>Rp <?= number_format($total_lembur, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Rating</th>
                        <td><?= $data['nilai_rating'] ?? '-' ?></td>
                    </tr>
                    <tr class="table-success">
                        <th>Total Gaji</th>
                        <td><strong>Rp <?= number_format($total_gaji, 0, ',', '.') ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>