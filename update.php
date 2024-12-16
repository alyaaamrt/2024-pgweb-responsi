<?php
// Pengaturan koneksi MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "responsi_pgweb";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa jika data form diterima
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $kecamatan = $_POST['kecamatan'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $nama_faskes = $_POST['nama_faskes'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    // Query untuk update data
    $sql = "UPDATE kesehatan SET kecamatan='$kecamatan', latitude='$latitude', longitude='$longitude', nama_faskes='$nama_faskes', telepon='$telepon', alamat='$alamat' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui.";
        header("Location: home.php"); // Mengarahkan kembali ke halaman utama setelah update
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
