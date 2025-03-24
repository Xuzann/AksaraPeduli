<?php
session_start(); // Wajib untuk mengakses session
include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Ambil user_id dari session

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
    <title>
        Aksara Peduli
    </title>
    <style>
        body {
            font-family: 'poppins';
        }
    </style>
    <script></script>
</head>

<body class="bg-white font-[poppins]">
    <nav class="bg-white shadow-md fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex ">
                <a href="#"></a>
                <img src="image/logo.png" class="h-[75px]" alt="Logo AksaraPeduli">
            </div>

            <!-- Menu Navigasi -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="#tentang" class="text-gray-700 hover:text-[#44c7ff]">Tentang</a>
                <a href="#kegiatan" class="text-gray-700 hover:text-[#44c7ff]">Kegiatan</a>
                <a href="#kontak" class="text-gray-700 hover:text-[#44c7ff]">Kontak</a>
                <a href="#" class="bg-[#3874B3] text-white px-4 py-2 rounded-lg hover:bg-[#44c7ff] transition">
                    Mulai Donasi
                </a>
                <!-- Ikon Profil -->
                <a href="profile.php">
                    <button class="relative group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700 hover:text-[#44c7ff] "
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
    <main class="">
        <div class="flex flex-col justify-center items-center">
            <img class="w-32 h-32 rounded-full bg-gray-300" src="https://via.placeholder.com/150" alt="Profile Picture">
            <h2 class="text-2xl font-semibold mt-4">Pemrograman Web</h2>
        </div>
        
        <div class="mt-6 grid grid-cols-2 gap-10">
            <div>
                <h3 class="text-lg font-semibold mb-2">Data diri</h3>
                <form>
                    <div class="mb-4">
                        <label class="block text-gray-700">Nama</label>
                        <input type="text" class="w-full border border-gray-300 rounded-lg py-2 px-4" placeholder="Masukkan nama Anda">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" class="w-full border border-gray-300 rounded-lg py-2 px-4" placeholder="Masukkan email Anda">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Kata Sandi Lama</label>
                        <input type="password" class="w-full border border-gray-300 rounded-lg py-2 px-4" placeholder="Masukkan kata sandi Anda">
                    </div>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">Ubah dan Simpan</button>
                </form>
            </div>
            <div class="text-gray-700 text-lg font-semibold">Pencapaian anda</div>
        </div>
    </main>
</body>
</html>
