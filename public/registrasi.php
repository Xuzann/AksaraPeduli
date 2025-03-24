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

<!DOCTYPE html>
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
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Aksara Peduli - Registrasi</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<header>
    <div class="mb-8">
        <img src="image/logo.png" alt="AksaraPeduli logo" class="h-14">
    </div>
</header>

<body class="bg-white">
    <div class="flex min-h-screen">
        <!-- Left side (form) -->
        <div class="container ml-20 w-[80%]">
            <div class="w-full md:w-1/2 p-8 md:p-10 relative">

                <!-- Form Header -->
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-semibold mb-2">Buat Akun Anda</h1>
                    <p class="text-gray-600 text-sm">AksaraPeduli Mewujudkan Perubahan dengan Kepedulian</p>
                </div>

                <!-- Google Sign Up Button -->
                <div class="mb-6">
                    <button class="w-full flex items-center justify-center border border-gray-300 rounded-lg py-2.5 px-4 hover:bg-gray-50 transition duration-200">
                        <span class="text-red-500 mr-2 font-bold">G</span>
                        <span>Daftar dengan Google</span>
                    </button>
                </div>

                <!-- Divider -->
                <div class="flex items-center mb-6">
                    <hr class="flex-grow border-gray-200">
                    <span class="px-4 text-gray-500 text-sm">atau</span>
                    <hr class="flex-grow border-gray-200">
                </div>

                <!-- Registration Form -->
                <form action="prosesTambahUser.php" method="POST" onsubmit="return validateForm()">
                    <!-- Name Field -->
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 mb-2">Nama</label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan email Anda"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 mb-2">Kata Sandi</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Masukkan kata sandi Anda"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500" onclick="togglePassword()">
                                <i class="fa fa-eye-slash" id="toggleIcon"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Terms Checkbox -->
                    <div class="mb-6">
                        <div class="flex items-start">
                            <input type="checkbox" id="terms" class="mt-1 mr-2" required>
                            <label for="terms" class="text-gray-600 text-sm">Saya menyetujui semua Syarat, Kebijakan Privasi, dan Biaya</label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        Daftar
                    </button>
                </form>

                <!-- Login Link -->
                <div class="text-center mt-4 text-gray-600">
                    Sudah punya akun? <a href="login.php" class="text-blue-600 hover:underline">Masuk</a>
                </div>

                <!-- Back Button -->
                <a href="index.php" class="absolute bottom-6 left-6 w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>


        <!-- Right side (image) -->
        <div class="hidden md:block md:w-1/2">
            <img src="image/image 10.jpg" alt="Children studying together" class="h-[600px] mt-20 object-cover">
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }

        function validateForm() {
            const nama = document.getElementById('nama').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const terms = document.getElementById('terms').checked;

            if (nama === '' || email === '' || password === '') {
                alert('Semua field harus diisi');
                return false;
            }

            if (!terms) {
                alert('Anda harus menyetujui syarat dan ketentuan');
                return false;
            }

            return true;
        }
    </script>
</body>

</html>