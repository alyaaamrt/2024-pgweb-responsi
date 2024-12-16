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

// Ambil kecamatan dari URL
$id = $_GET['id'];

// Query untuk hapus data
$sql = "DELETE FROM kesehatan WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil dihapus";
    header("Location: home.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
