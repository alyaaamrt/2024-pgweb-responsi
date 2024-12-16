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

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan";
    exit();
}
$id = $_GET['id'];

// Query untuk mengambil data sesuai kecamatan dengan prepared statement
$stmt = $conn->prepare("SELECT * FROM kesehatan WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan";
    exit();
}

// Menutup koneksi setelah digunakan
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Fasilitas Kesehatan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group label {
            color: #333;
        }

        .btn-custom {
            background-color: #f7c945;
            color: #fff;
            border: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
            height: 45px;
            margin: 10px 0;
        }

        .btn-custom:hover {
            background-color: #e6b636;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><strong>Update Fasilitas Kesehatan</strong></h2>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

            <div class="form-group">
                <label for="kecamatan">Kecamatan</label>
                <input type="text" id="kecamatan" name="kecamatan" class="form-control" value="<?php echo $data['kecamatan']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="text" id="latitude" name="latitude" class="form-control" value="<?php echo $data['latitude']; ?>">
            </div>

            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="text" id="longitude" name="longitude" class="form-control" value="<?php echo $data['longitude']; ?>">
            </div>

            <div class="form-group">
                <label for="nama_faskes">Nama Fasilitas Kesehatan</label>
                <input type="text" id="nama_faskes" name="nama_faskes" class="form-control" value="<?php echo $data['nama_faskes']; ?>">
            </div>

            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" id="telepon" name="telepon" class="form-control" value="<?php echo $data['telepon']; ?>">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="form-control" value="<?php echo $data['alamat']; ?>">
            </div>

            <div class="buttons">
                <button type="submit" class="btn btn-custom btn-block">Update</button>
                <a href="index.php" class="btn btn-custom btn-block">Batal</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
