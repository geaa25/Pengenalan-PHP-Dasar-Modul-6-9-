<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM lembur WHERE id = $id"));

if (isset($_POST['update'])) {
    $jabatan_id = $_POST['jabatan_id'];
    $tarif_per_jam = $_POST['tarif_per_jam'];
    $jumlah_jam = $_POST['jumlah_jam'];

    mysqli_query($conn, "UPDATE lembur SET 
                            jabatan_id = '$jabatan_id', 
                            tarif_per_jam = '$tarif_per_jam',
                            jumlah_jam = '$jumlah_jam' 
                         WHERE id = $id");

    header("Location: lembur.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Tarif Lembur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="p-4 w-100">
        <h3>Edit Tarif Lembur</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="jabatan_id" class="form-label">Jabatan</label>
                <select name="jabatan_id" class="form-select" required>
                    <?php
                    $jabatan = mysqli_query($conn, "SELECT * FROM jabatan");
                    while ($j = mysqli_fetch_assoc($jabatan)) {
                        $selected = $data['jabatan_id'] == $j['id'] ? 'selected' : '';
                        echo '<option value="' . $j['id'] . '" ' . $selected . '>' . $j['nama_jabatan'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tarif Per Jam</label>
                <input type="number" name="tarif_per_jam" value="<?= $data['tarif_per_jam']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah Jam</label>
                <input type="number" name="jumlah_jam" value="<?= $data['jumlah_jam']; ?>" class="form-control" required>
            </div>
            <button type="submit" name="update" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
</body>
</html>