<?php
session_start(); // Wajib untuk mengakses session
include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Ambil user_id dari session
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : "Guest";

// Gunakan prepared statement untuk keamanan
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Data pengguna tidak ditemukan.";
    exit();
}

$stmt->close();
$conn->close();
?>

<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="./src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <title>
        Aksara Peduli
    </title>
    <style>
        body {
            font-family: 'poppins';
        }

        #chart-container {
            width: 100%;
            width: 450px;
            height: 350px;
        }
    </style>
    <script></script>
</head>

<body class="bg-white font-[poppins]">
    <header>
        <nav class="bg-white shadow-md relative w-full z-10">
            <div class="max-w-7xl mx-auto px-6 flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex ">
                    <a href="#"></a>
                    <img src="image/logo.png" class="h-[75px]" alt="Logo AksaraPeduli">
                </div>

                <!-- Menu Navigasi -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="index.php" class="text-gray-700 hover:text-[#44c7ff]">Beranda</a>
                    <a href="#tentang" class="text-gray-700 hover:text-[#44c7ff]">Tentang</a>
                    <a href="#kegiatan" class="text-gray-700 hover:text-[#44c7ff]">Kegiatan</a>
                    <a href="#kontak" class="text-gray-700 hover:text-[#44c7ff]">Kontak</a>
                    <a href="#" class="bg-[#3874B3] text-white px-4 py-2 rounded-lg hover:bg-[#44c7ff] transition">
                        Mulai Donasi
                    </a>
                    <!-- Ikon Profil -->
                    <a href="profile.php">
                        <button class="relative group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700 hover:text-[#44c7ff] cursor-pointer"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-3.33 0-10 1.67-10 5v2h20v-2c0-3.33-6.67-5-10-5z" />
                            </svg>

                        </button>
                    </a>

                </div>
                <!-- Mobile Menu Button -->
                <button id="menu-btn" class="md:hidden text-gray-700 focus:outline-none">
                    ☰
                </button>
            </div>
        </nav>
    </header>

    <main class=" mt-[35px]">
        <section id="profile picture" class="">
            <div class="flex flex-col justify-center items-center">
                <img class="w-32 h-32 object-cover rounded-full bg-gray-300" src="https://images.unsplash.com/photo-1742127213245-ee15fc6e5590?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture">
                <h2 class="text-2xl font-semibold mt-4"><?php echo htmlspecialchars($nama); ?></h2>
            </div>
        </section>

        <section class="mx-auto ml-[200px] flex flex-row  overflow-x-auto">
            <section id="data diri">
                <div class=" grid grid-cols-2">
                    <div class="w-full">
                        <h3 class="text-lg font-semibold mb-2">Data diri</h3>
                        <form action="" method="POST" onsubmit="return validateForm()" class="w-[360px]">
                            <div class="mb-4">
                                <label class="block font-medium text-gray-700 text-sm">Nama</label>
                                <input type="text" class="w-full border text-sm border-gray-300 rounded-lg py-2 px-4" placeholder="Masukkan nama Anda">
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-gray-700 text-sm">Email</label>
                                <input type="email" class="w-full border text-sm border-gray-300 rounded-lg py-2 px-4" placeholder="Masukkan email Anda">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block font-medium text-gray-700 text-sm mb-2">Kata Sandi Lama</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" placeholder="Masukkan kata sandi Anda"
                                        class="w-full px-4 py-2.5 border border-gray-300 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required>
                                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500" onclick="togglePassword()">
                                        <i class="fa fa-eye-slash" id="toggleIcon"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="">
                                <label for="password" class="block font-medium text-gray-700 text-sm mb-2">Kata Sandi Baru</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" placeholder="Masukkan kata sandi Anda"
                                        class="w-full px-4 py-2.5 border border-gray-300 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required>
                                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500" onclick="togglePassword()">
                                        <i class="fa fa-eye-slash" id="toggleIcon"></i>
                                    </span>
                                </div>
                            </div>
                            <button class="ml-[210px] mt-7 px-5 z-1 py-3 bg-[#3874B3] rounded-xl text-white bottom-4 left-[95.5px] font-medium hover:bg-[#44c7ff] duration-300 text-xs cursor-pointer">
                                Ubah dan Simpan
                            </button>
                        </form>
                    </div>

                </div>
            </section>

            <section id="chart">
                <div class="text-lg font-semibold">Pencapaian Anda</div>

                <div id="chart-container">
                    <canvas id="myLineChart"></canvas>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        fetch("get_donations.php") // Ambil data dari PHP
                            .then(response => response.json())
                            .then(data => {
                                const ctx = document.getElementById('myLineChart').getContext('2d');
                                new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                                        datasets: [{
                                            label: 'Jumlah Donasi per Bulan',
                                            data: data, // Data dari PHP
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderWidth: 2,
                                            tension: 0.1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                ticks: {
                                                    stepSize: 1 // Pastikan hanya angka bulat
                                                }
                                            }
                                        }
                                    }
                                });
                            })
                            .catch(error => console.error("Gagal mengambil data: ", error));
                    });
                </script>

            </section>

        </section>
    </main>
</body>

</html>