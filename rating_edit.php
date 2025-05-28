<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM rating WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $karyawan_id = $_POST['karyawan_id'];
    $bulan = $_POST['bulan'];
    $nilai_rating = $_POST['nilai_rating'];

    $update = mysqli_query($conn, "UPDATE rating 
                                   SET karyawan_id='$karyawan_id', bulan='$bulan', nilai_rating='$nilai_rating' 
                                   WHERE id = $id");
    if ($update) {
        header("Location: rating.php");
    } else {
        echo "Gagal memperbarui data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Rating</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="p-4 w-100">
        <h3>Edit Rating</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="karyawan_id" class="form-label">Nama Karyawan</label>
                <select name="karyawan_id" class="form-select" required>
                    <?php
                    $karyawan = mysqli_query($conn, "SELECT * FROM karyawan");
                    while ($row = mysqli_fetch_assoc($karyawan)) {
                        $selected = ($row['id'] == $data['karyawan_id']) ? "selected" : "";
                        echo "<option value='{$row['id']}' $selected>{$row['nama']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="bulan" class="form-label">Bulan</label>
                <input type="text" name="bulan" class="form-control" value="<?= $data['bulan'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nilai_rating" class="form-label">Nilai Rating</label>
                <input type="number" name="nilai_rating" class="form-control" value="<?= $data['nilai_rating'] ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="rating.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>