<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.html");
    exit;
}

$praktik = $_POST['praktik'];
$faskes = $_POST['faskes'];
$kalurahan = $_POST['kalurahan'];
$kapanewon = $_POST['kapanewon'];
$alamat = $_POST['alamat'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare(
    "INSERT INTO faskes (praktik, faskes, kalurahan, kapanewon, alamat, longitude, latitude)
     VALUES (?, ?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param("sssssdd", $praktik, $faskes, $kalurahan, $kapanewon, $alamat, $longitude, $latitude);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: ../index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>