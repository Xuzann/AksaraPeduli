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

<?php include "layout/header.html" ?>
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
    <?php include "layout/footer.html" ?>
</body>
</html>
