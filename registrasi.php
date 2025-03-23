<?php
include_once("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Enkripsi password

    $sql = "INSERT INTO user (nama, email, password) VALUES ('$nama', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // Menampilkan error jika query gagal
    }

    $conn->close();
}
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
<header>
    <div class="flex items-center mt-5 ml-10">
        <img alt="AksaraPeduli logo" class="mr-2 h-14" src="/image/logo.png" />
    </div>
</header>

<body class="bg-white items-center justify-center min-h-screen">
    <div class="container mx-auto p-4 md:flex md:items-center md:justify-between">
        <div class="md:w-1/2 p-8">
            <h1 class="text-2xl font-semibold mb-2">
                Buat Akun Anda
            </h1>
            <p class="text-gray-600 mb-6 text-sm">
                AksaraPeduli Mewujudkan Perubahan dengan Kepedulian
            </p>
            <button class="w-full text-sm flex items-center justify-center border border-gray-300 rounded-lg py-2 mb-4">
                <i class="fab fa-google text-red-500 mr-2">
                </i>
                Daftar dengan Google
            </button>
            <div class="flex items-center mb-4">
                <hr class="flex-grow border-gray-300" />
                <span class="px-2 text-gray-500">
                    atau
                </span>
                <hr class="flex-grow border-gray-300" />
            </div>

            <form action="prosesTambahUser.php" method="POST" onsubmit="return validateForm()">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="nama">
                        Nama
                    </label>
                    <input class="w-full border border-gray-300 rounded-lg py-2 px-4" id="nama" name="nama"
                        placeholder="Masukkan nama Anda" type="text" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="email">
                        Email
                    </label>
                    <input class="w-full border border-gray-300 rounded-lg py-2 px-4" id="email" name="email"
                        placeholder="Masukkan email Anda" type="email" />
                </div>
                <div class="mb-4 relative">
                    <label class="block text-gray-700 mb-2" for="password">
                        Kata Sandi
                    </label>
                    <input class="w-full border border-gray-300 rounded-lg py-2 px-4" id="password" name="password"
                        placeholder="Masukkan kata sandi Anda" type="password" />
                </div>
                <div class="mb-4">
                    <input class="mr-2" id="terms" type="checkbox" />
                    <label class="text-gray-600" for="terms">
                        Saya menyetujui semua Syarat, Kebijakan Privasi, dan Biaya
                    </label>
                </div>
                <button class="w-full bg-blue-600 text-white rounded-lg py-2 hover:bg-blue-700">
                    Daftar
                </button>
            </form>

            <p class="text-gray-600 mt-4">
                Sudah punya akun?
                <a class="text-blue-600" href="#">
                    Masuk
                </a>
            </p>
        </div>
        <div class="hidden md:block md:w-1/2 ml-[560px]">
            <img alt="Children studying together" class="rounded-lg h-[600px]" src="/image/image 10.jpg" />
        </div>
    </div>
</body>

</html>