<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM faskes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Fasilitas Kesehatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f0f2f5; font-size: 14px; }
        .card-box { background: #fff; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,.06); padding: 28px; }
        label { font-weight: 600; margin-bottom: 4px; }
        .btn-dark { font-weight: 600; }
    </style>
</head>
<body>
<div class="container py-5" style="max-width: 560px;">
    <div class="card-box">
        <h5 class="text-center fw-semibold mb-4">Edit Data Fasilitas Kesehatan</h5>

        <?php if ($row): ?>
        <form action="edit.php" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">

            <div class="mb-3">
                <label>Praktik</label>
                <input type="text" name="praktik" class="form-control" value="<?= htmlspecialchars($row['praktik']) ?>">
            </div>
            <div class="mb-3">
                <label>Faskes</label>
                <input type="text" name="faskes" class="form-control" value="<?= htmlspecialchars($row['faskes']) ?>">
            </div>
            <div class="mb-3">
                <label>Kalurahan</label>
                <input type="text" name="kalurahan" class="form-control" value="<?= htmlspecialchars($row['kalurahan']) ?>">
            </div>
            <div class="mb-3">
                <label>Kapanewon</label>
                <input type="text" name="kapanewon" class="form-control" value="<?= htmlspecialchars($row['kapanewon']) ?>">
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" rows="3" class="form-control"><?= htmlspecialchars($row['alamat']) ?></textarea>
            </div>
            <div class="mb-3">
                <label>Longitude</label>
                <input type="text" name="longitude" class="form-control" value="<?= htmlspecialchars($row['longitude']) ?>">
            </div>
            <div class="mb-4">
                <label>Latitude</label>
                <input type="text" name="latitude" class="form-control" value="<?= htmlspecialchars($row['latitude']) ?>">
            </div>

            <button type="submit" class="btn btn-dark w-100">Update Data</button>
            <a href="../index.php" class="btn btn-link text-secondary w-100 mt-2">Kembali</a>
        </form>
        <?php else: ?>
            <p class="text-muted text-center mb-0">Data tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>