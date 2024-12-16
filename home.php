<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web GIS - Kabupaten Pati</title>
    
    <!-- Mengimpor stylesheet untuk Leaflet, Font Awesome, dan Bootstrap -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Link ke JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        /* Gaya umum untuk body */
        body {
            background-color:rgb(222, 221, 218);
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: #333;
        }

        /* Skema warna kustom */
        .bg-yellow {
            background-color: #f7c945 !important;
        }

        .text-yellow {
            color: #f7c945;
        }

        /* Kontainer yang dapat digulir */
        .scrollable-container {
            max-height: 550px;
            overflow-y: auto;
        }

        /* Kontainer peta */
        #map {
            width: 100%;
            height: 450px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Penyesuaian tata letak untuk section konten */
        .content-section {
            display: none; /* Sembunyikan semua section */
        }

        .content-section.active {
            display: block; /* Tampilkan section yang aktif */
        }

        .nav-link {
            cursor: pointer; /* Jadikan pointer */
        }

        .nav-link.active {
            font-weight: bold; /* Efek bold pada tab aktif */
            color: #f7c945 !important;
        }

        /* Gaya untuk kartu */
        .card {
            margin-top: 20px;
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        /* Gaya untuk navbar */
        .navbar {
            padding: 15px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-link {
            font-weight: bold;
        }

        .container {
            padding-top: 20px;
            padding-bottom: 40px;
        }

        table {
            font-size: 15px;
        }

        /* Gaya untuk hover pada tabel */
        tbody tr:hover {
            background-color: #f2f2f2;
        }

        /* Gaya untuk gambar sebagai tombol */
        .btn-gambar {
            cursor: pointer;
            display: inline-block;
            padding: 5px;
        }

        /* Efek saat hover pada gambar */
        .btn-gambar:hover {
            opacity: 0.7; /* Menambahkan efek transparansi saat hover */
        }
    </style>
</head>

<body>

    <!-- Navbar untuk navigasi -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fa-solid fa-map-location-dot"></i><strong> Pati Care</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link tab-link active" data-target="peta" href="#"><i class="fa-solid fa-map"></i> Peta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tab-link" data-target="tabel" href="#"><i class="fa-solid fa-table"></i> Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://geoportal.patikab.go.id/" target="_blank"><i class="fa-solid fa-layer-group"></i> Sumber Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#infoModal">
                            <i class="fa-solid fa-circle-info"></i> Info
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Peta Section -->
        <div id="peta" class="content-section active">
            <div class="card bg-light">
                <div class="card-body">
                <h4 class="card-title text-center text-yellow mb-3"><strong>Peta Fasilitas Kesehatan</strong></h4>
                <div id="map"></div>
                </div>
            </div>
        </div>

        <!-- Tabel Fasilitas Kesehatan Section -->
        <div id="tabel" class="content-section">
            <div class="card bg-light scrollable-container">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title text-center text-yellow flex-grow-1"><strong>Tabel Fasilitas Kesehatan</strong></h4>
                        <a href="forminput.php" class="btn btn-tambah">
                            <img src="assets/add.png" alt="Tambah Data" style="width: 50px; height: 50px;">
                        </a>
                    </div>

                    <!-- Tabel Data Fasilitas Kesehatan -->
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th class="bg-yellow">ID</th>
                                <th class="bg-yellow">Kecamatan</th>
                                <th class="bg-yellow">Latitude</th>
                                <th class="bg-yellow">Longitude</th>
                                <th class="bg-yellow">Faskes</th>
                                <th class="bg-yellow">Telepon</th>
                                <th class="bg-yellow">Alamat</th>
                                <th class="bg-yellow">Update</th>
                                <th class="bg-yellow">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
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

                            // Query untuk mengambil semua data dari tabel 'kesehatan'
                            $sql = "SELECT * FROM kesehatan";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Mengambil data dan menampilkannya dalam tabel
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['kecamatan']}</td>
                                            <td>{$row['latitude']}</td>
                                            <td>{$row['longitude']}</td>
                                            <td>{$row['nama_faskes']}</td>
                                            <td>{$row['telepon']}</td>
                                            <td>{$row['alamat']}</td>
                                            <td>
                                                <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Update</a>
                                            </td>
                                            <td>
                                                <a href='hapus.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                                            </td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>Tidak ada data fasilitas kesehatan.</ td></tr>";
                            }

                            // Tutup koneksi
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Info Pembuat -->
        <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="infoModalLabel">Info Pembuat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nama</th>
                                <td>Allya Miranti</td>
                            </tr>
                            <tr>
                                <th>NIM</th>
                                <td>23/521994/SV/23560</td>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <td>B</td>
                            </tr>
                            <tr>
                                <th>Github</th>
                                <td><a href="https://github.com/alyaaamrt" target="_blank">https://github.com/alyaaamrt</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Leaflet JS untuk Peta -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil semua elemen navbar link
            const tabLinks = document.querySelectorAll('.tab-link');

            tabLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    const target = this.getAttribute('data-target');

                    // Cek jika data-target adalah modal, biarkan aksi default berjalan
                    if (target && target.startsWith('#infoModal')) {
                        return; // Jangan blokir aksi untuk modal
                    }

                    // Jika bukan modal, lanjutkan dengan blokir aksi default dan manipulasi tab
                    e.preventDefault();

                    // Hapus class 'active' dari semua tab link
                    tabLinks.forEach(item => item.classList.remove('active'));

                    // Tambahkan class 'active' ke link yang diklik
                    this.classList.add('active');

                    // Sembunyikan semua section
                    document.querySelectorAll('.content-section').forEach(section => {
                        section.classList.remove('active');
                    });

                    // Tampilkan hanya section target
                    document.getElementById(target).classList.add('active');
                });
            });
        });

        // Inisialisasi peta dengan koordinat Kabupaten Pati
        var map = L.map("map").setView([-6.7462, 111.0276], 9.5); // Koordinat Kabupaten Pati

        // Membuat pane untuk GeoJSON dan GeoServer
        map.createPane('geojsonPane');
        map.getPane('geojsonPane').style.zIndex = 400;

        map.createPane('geoserverPane');
        map.getPane('geoserverPane').style.zIndex = 500;

        // Tile Layer untuk OpenStreetMap
        var osmLayer = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            zIndex: 1 // Menambahkan zIndex untuk Tile Layer
        }).addTo(map);

        // Tile Layer untuk Google Satellite
        var googleSatelliteLayer = L.tileLayer(
            "https://mt{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}",
            {
                attribution: '&copy; <a href="https://www.google.com/maps">Google Maps</a>',
                subdomains: ["0", "1", "2", "3"],
                zIndex: 1 // Menambahkan zIndex untuk Tile Layer
            }
        );

        // Fungsi untuk menghasilkan warna acak dalam format hex
        function getRandomColor() {
            const randomColor = Math.floor(Math.random() * 16777215).toString(16);
            return `#${randomColor.padStart(6, '0')}`; // Menghasilkan warna hex 6 digit
        }

        // Objek untuk menyimpan warna yang ditetapkan untuk setiap nilai NAMOBJ
        const colorMap = {};

        // Fungsi untuk menambahkan popup ke setiap poligon
        function onEachFeature(feature, layer) {
            if (feature.properties && feature.properties.NAMOBJ) {
                const popupContent = `
                    <strong>Desa/ Kelurahan</strong> <b>${feature.properties.NAMOBJ}</b>
                    <br>Kecamatan ${feature.properties.WADMKC}<br>
                `;
                layer.bindPopup(popupContent);
            }
        }

        // Layer GeoJSON untuk administrasi.geojson
        var geojsonLayer = L.geoJSON(null, {
            style: function(feature) {
                var namobjValue = feature.properties.NAMOBJ;
                if (!colorMap[namobjValue]) {
                    colorMap[namobjValue] = getRandomColor(); // Tetapkan warna acak
                }
                var color = colorMap[namobjValue];
                return {
                    color: color,
                    weight: 2,
                    opacity: 1,
                    fillColor: color,
                    fillOpacity: 1
                };
            },
            onEachFeature: onEachFeature,
            pane: 'geojsonPane' // Menetapkan pane untuk GeoJSON layer
        });

        // Layer GeoServer (WMS)
        var geoserverLayer = L.tileLayer.wms('http://localhost:8080/geoserver/responsi_pgweb/wms', {
            layers: 'JALAN_LN_25K', // Ganti dengan nama layer di GeoServer
            format: 'image/png',
            transparent: true,
            attribution: 'GeoServer',
            pane: 'geoserverPane' // Menetapkan pane untuk GeoServer layer
        });

        // Fetch GeoJSON data dan masukkan ke dalam geojsonLayer
        fetch('data/administrasi.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                geojsonLayer.addData(data); // Memasukkan data GeoJSON ke dalam layer
            })
            .catch(function(error) {
                console.log("Terjadi kesalahan saat memuat file GeoJSON: " + error);
            });

        // Menambahkan data fasilitas kesehatan dari database MySQL melalui PHP
        var fasilitasKesehatanLayer = L.layerGroup(); // Layer group untuk fasilitas kesehatan
        <?php
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM kesehatan";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kecamatan = $row["kecamatan"];
                $latitude = $row["latitude"];
                $longitude = $row["longitude"];
                $nama_faskes = $row["nama_faskes"];
                $telepon = $row["telepon"];
                $alamat = $row["alamat"];
                // Tentukan path untuk gambar ikon
        $iconUrl = "assets/rs.png"; // Gambar ikon di folder lokal

        // Membuat ikon kustom dengan PHP untuk menghasilkan URL gambar
        echo "
        var customIcon = L.icon({
            iconUrl: '$iconUrl',
            iconSize: [48, 48],  // Ukuran ikon (adjust sesuai kebutuhan)
            iconAnchor: [24, 48], // Anchor point ikon (titik jangkar)
            popupAnchor: [0, -48], // Posisi popup relatif terhadap ikon
            tooltipAnchor: [-16, -30] // Posisi tooltip relatif terhadap ikon
        });

        fasilitasKesehatanLayer.addLayer(L.marker([$latitude, $longitude], { icon: customIcon })
            .bindPopup('<b>$nama_faskes</b><br>Telepon: $telepon<br>Alamat: $alamat'));
        ";
    }
}
$conn->close();
?>

        // Kontrol Layer
        var baseLayers = {
            "OpenStreetMap": osmLayer,
            "Google Satellite": googleSatelliteLayer
        };

        var overlayLayers = {
            "Administrasi Kecamatan": geojsonLayer,  
            "Jalan": geoserverLayer,
            "Fasilitas Kesehatan": fasilitasKesehatanLayer
        };

        // Menambahkan kontrol layer ke peta
        L.control.layers(baseLayers, overlayLayers).addTo(map);

        // Menambahkan layer default (OpenStreetMap)
        osmLayer.addTo(map);

        // Fungsi untuk mengaktifkan tab yang dipilih
        function openTab(tabName) {
            document.querySelectorAll('.content-section').forEach(function (section) {
                section.classList.remove('active');
            });
            document.getElementById(tabName).classList.add('active');
        }
    </script>

</body>

</html>