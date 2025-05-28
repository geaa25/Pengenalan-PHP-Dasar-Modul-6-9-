<?php
include 'koneksi.php';

// Ambil ID dari parameter URL
$id = $_GET['id'];

// Ambil data lembur berdasarkan ID
$query = mysqli_query($conn, "SELECT lembur.*, jabatan.nama_jabatan FROM lembur 
                              JOIN jabatan ON lembur.jabatan_id = jabatan.id 
                              WHERE lembur.id = $id");
$data = mysqli_fetch_assoc($query);

// Hitung total lembur
$total = $data['tarif_per_jam'] * $data['jumlah_jam'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Lembur - Sistem Manajemen Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="p-4 w-100">
        <h3>Detail Tarif Lembur</h3>
        <a href="lembur.php" class="btn btn-secondary mb-3">← Kembali</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Jabatan: <?= $data['nama_jabatan']; ?></h5>
                <p class="card-text">Tarif per Jam: <strong>Rp <?= number_format($data['tarif_per_jam'], 0, ',', '.'); ?></strong></p>
                <p class="card-text">Jumlah Jam: <strong><?= $data['jumlah_jam']; ?> jam</strong></p>
                <p class="card-text">Total Lembur: <strong>Rp <?= number_format($total, 0, ',', '.'); ?></strong></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>