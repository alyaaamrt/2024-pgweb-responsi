<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "responsi_pgweb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$kecamatan = $_POST['kecamatan'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$nama_faskes = $_POST['nama_faskes'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];

// Query insert
$sql = "INSERT INTO kesehatan (kecamatan, latitude, longitude, nama_faskes, telepon, alamat) 
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sddsss", $kecamatan, $latitude, $longitude, $nama_faskes, $telepon, $alamat);

if ($stmt->execute()) {
    echo "Data berhasil ditambahkan.";
    header("Location: home.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
