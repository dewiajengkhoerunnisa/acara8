
<?php
$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO penduduk
(kecamatan, longitude, latitude, luas, jumlah_penduduk)
VALUES
('$kecamatan', $longitude, $latitude, $luas, $jumlah_penduduk)";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil ditambahkan!";
    echo "<br><a href='../index.php'>Kembali ke tabel</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
