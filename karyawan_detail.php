<?php
include 'koneksi.php';
include 'includes/header.php';
include 'includes/sidebar.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT k.*, j.nama_jabatan FROM karyawan k LEFT JOIN jabatan j ON k.jabatan_id = j.id WHERE k.id = $id");
$data = mysqli_fetch_array($query);

// Ambil rating (jika ada)
$rating_query = mysqli_query($conn, "SELECT nilai_rating FROM rating WHERE karyawan_id = $id ORDER BY bulan DESC LIMIT 1");
$rating_data = mysqli_fetch_array($rating_query);
$rating = isset($rating_data['nilai_rating']) ? $rating_data['nilai_rating'] : 0;
?>

<div class="container-fluid mt-4">
    <h4 class="mb-4">Detail Karyawan</h4>
    <div class="card shadow">
        <div class="row g-0 p-4">
            <div class="col-md-4 text-center">
                <img src="uploads/<?= $data['foto'] ?>" class="img-thumbnail mb-3" style="max-width: 200px;" alt="Foto Karyawan">
                <div>
                    <strong>Rating:</strong>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="<?= $i <= $rating ? 'text-warning' : 'text-muted' ?>">★</span>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr>
                        <th>Nama</th>
                        <td>: <?= $data['nama'] ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>: <?= $data['jenis_kelamin'] ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>: <?= $data['alamat'] ?></td>
                    </tr>
                    <tr>
                        <th>No. Telp</th>
                        <td>: <?= $data['no_hp'] ?></td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>: <?= $data['nama_jabatan'] ?></td>
                    </tr>
                </table>
                <a href="karyawan_edit.php?id=<?= $data['id'] ?>" class="btn btn-primary">Edit</a>
                <a href="karyawan.php" class="btn btn-secondary">← Kembali</a>
            </div>
        </div>
    </div>
</div>

