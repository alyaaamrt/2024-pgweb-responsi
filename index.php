<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web GIS Kabupaten Pati</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            position: relative;
            background-image: url('assets/background.jpg'); /* Ganti dengan path gambar background lokal */
            background-size: cover;
            background-position: center;
            color: #fff;
            height: 100vh;
        }

        /* Overlay untuk membuat background lebih gelap */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7); /* Gelapkan background dengan transparansi */
            z-index: -1; /* Pastikan overlay berada di belakang konten */
        }

        .container {
            padding-top: 50px;
        }

        .btn-custom {
            background-color: #f7c945;
            color: white;
        }

        .slider-img {
            max-height: 500px;
            object-fit: cover;
        }

        .desc-box {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
        }

        .desc-box h3, .desc-box p {
            color: #f7c945;
        }

        .footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Welcome Section -->
<div class="container text-center">
    <h1 class="mb-4"><strong>Welcome to Pati Care🤗</strong></h1>
    <p class="mb-4">Temukan informasi tentang fasilitas kesehatan Kabupaten Pati disinii!!!</p>
    <a href="home.php" class="btn btn-custom btn-lg">Let's Goooo!!!!</a>
</div>

<!-- Description Section -->
<div class="container my-5 text-center">
    <div class="desc-box mx-auto" style="max-width: 800px;">
        <h3><strong>Kabupaten Pati</strong></h3>
        <p>Kabupaten Pati memiliki berbagai fasilitas kesehatan yang tersebar di seluruh wilayahnya, mulai dari rumah sakit, puskesmas, klinik, hingga layanan kesehatan berbasis masyarakat. Aplikasi ini dirancang untuk memberikan informasi yang lengkap dan akurat mengenai lokasi dan jenis layanan kesehatan yang tersedia di Pati, memudahkan masyarakat dalam mengakses layanan kesehatan yang mereka butuhkan. Dilengkapi dengan peta interaktif, pengguna dapat dengan mudah mencari fasilitas kesehatan terdekat dan mendapatkan informasi terbaru mengenai layanan kesehatan di wilayah Kabupaten Pati.</p>    </div>
</div>

<!-- Footer Section -->
<div class="footer">
    <p>&copy; 2024 Pati Care - Made with ❤️ and 🍵</p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
