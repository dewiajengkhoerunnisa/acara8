<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM faskes");

$rows = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web GIS Fasilitas Kesehatan Kabupaten Sleman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f0f2f5; font-size: 14px; }
        .card-box { background: #fff; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,.06); padding: 24px; }
        #map { height: 420px; border-radius: 10px; }
        .table thead th { background: #f8f9fa; font-weight: 600; white-space: nowrap; }
        .table td { vertical-align: middle; }
        .btn-sm { font-size: 12px; }
    </style>
</head>
<body>
<div class="container py-4">
    <h4 class="text-center fw-semibold mb-4">Web GIS Fasilitas Kesehatan Kabupaten Sleman</h4>

    <div class="card-box mb-4">
        <div id="map"></div>
    </div>

    <div class="card-box">
        <a href="input/index.html" class="text-dark fw-medium d-inline-block mb-3">
            <i class="bi bi-plus-circle-fill"></i> Input Data
        </a>

        <?php if (count($rows) > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th><i class="bi bi-person-vcard"></i> ID</th>
                        <th><i class="bi bi-heart-pulse-fill"></i> Praktik</th>
                        <th><i class="bi bi-hospital-fill"></i> Faskes</th>
                        <th>Kalurahan</th>
                        <th>Kapanewon</th>
                        <th><i class="bi bi-signpost-2-fill"></i> Alamat</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th><i class="bi bi-gear-fill"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["id"]) ?></td>
                        <td><?= htmlspecialchars($row["praktik"]) ?></td>
                        <td><?= htmlspecialchars($row["faskes"]) ?></td>
                        <td><?= htmlspecialchars($row["kalurahan"]) ?></td>
                        <td><?= htmlspecialchars($row["kapanewon"]) ?></td>
                        <td><?= htmlspecialchars($row["alamat"]) ?></td>
                        <td><?= htmlspecialchars($row["longitude"]) ?></td>
                        <td><?= htmlspecialchars($row["latitude"]) ?></td>
                        <td class="text-nowrap">
                            <a href="edit/index.php?id=<?= $row["id"] ?>" class="btn btn-success btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="delete.php?id=<?= $row["id"] ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus data ini?')">
                                <i class="bi bi-trash-fill"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <p class="text-muted mb-0">Belum ada data.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([-7.73, 110.37], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var data = <?= json_encode($rows) ?>;

    data.forEach(function (d) {
        if (d.latitude !== null && d.longitude !== null) {
            L.marker([parseFloat(d.latitude), parseFloat(d.longitude)])
                .addTo(map)
                .bindPopup(
                    "<b>" + d.faskes + "</b><br>" +
                    "Praktik: " + d.praktik + "<br>" +
                    "Kalurahan: " + d.kalurahan + "<br>" +
                    "Kapanewon: " + d.kapanewon + "<br>" +
                    "Alamat: " + d.alamat
                );
        }
    });
</script>
</body>
</html>
<?php $conn->close(); ?>