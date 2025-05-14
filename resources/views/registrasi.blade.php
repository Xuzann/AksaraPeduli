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

<header class="flex items-center pl-7 pt-4 absolute">
    <img src="image/logo.png" alt="AksaraPeduli logo" class="h-16 ml-4">
</header>

<body class="bg-white">
    <div class="flex justify-center items-center min-h-screen gap-16 px-6 md:px-20 relative ">
        <!-- Left side (form) -->
        <div class="w-full max-w-lg bg-white p-8 md:p-10">
            <!-- Form Header -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-semibold mb-2">Buat Akun Anda</h1>
                <p class="text-gray-600 text-xs">AksaraPeduli Mewujudkan Perubahan dengan Kepedulian</p>
            </div>

            <!-- Google Sign Up Button -->
            <button class="w-full flex items-center justify-center border border-gray-300 rounded-[20px] py-2.5 px-4 hover:bg-gray-50 transition">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/768px-Google_%22G%22_logo.svg.png" alt="Google Logo" class="w-5 h-5 mr-2">
                <span class="text-sm">Daftar dengan Google</span>
            </button>

            <!-- Divider -->
            <div class="flex items-center my-6">
                <hr class="flex-grow border-[0.5px] rounded-[1px] border-b-gray-300">
                <span class="px-4 text-gray-500 text-xs">atau</span>
                <hr class="flex-grow border-[0.5px] rounded-[1px] border-b-gray-300">
            </div>

            <!-- Registration Form -->
            <form action="prosesTambahUser.php" method="POST" onsubmit="return validateForm()">
                <!-- Name Field -->
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 ml-3 mb-2 text-sm">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda"
                        class="w-full px-4 py-2.5 border text-xs border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent"
                        required>
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 ml-3 mb-2 text-sm">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email Anda"
                        class="w-full px-4 py-2.5 border text-xs border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent"
                        required>
                </div>

                <!-- Password Field -->
                <div class="mb-2">
                    <label for="password" class="block text-gray-700 ml-3 mb-2 text-sm">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi Anda"
                            class="w-full px-4 py-2.5 border text-xs border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent"
                            required>
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" onclick="togglePassword()" aria-label="Tampilkan kata sandi">
                            <i class="fa fa-eye-slash p-[1px]" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>

                <!-- Terms Checkbox -->
                <div class="mb-6 flex ml-3 items-start">
                    <input type="checkbox" id="terms" class="mt-1 mr-2" required>
                    <label for="terms" class="text-gray-600 mt-[2px] text-xs">Saya menyetujui semua Syarat, Kebijakan Privasi, dan Biaya</label>
                </div>

                <!-- Submit Button -->
                <div class="flex w-full">
                    <button type="submit" class="w-[47.5%] mx-auto text-sm py-3 bg-[#3874B3] text-white rounded-lg hover:bg-[#44c7ff] duration-300 transition cursor-pointer">
                        Daftar
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-2 text-gray-600 text-xs">
                Sudah punya akun? <a href="login.php" class="text-[#3b8eb5] hover:underline">Masuk</a>
            </div>
        </div>

        <!-- Right side (image) -->
        <div class="hidden md:block">
            <img src="image/image 10.jpg" alt="Children studying together" class="h-[600px] object-cover">
        </div>
    </div>

    <a href="login.php" class="fixed ml-20 mb-5 bottom-6 left-6 w-10 h-10 bg-[#3874B3] text-white rounded-full flex items-center justify-center hover:bg-[#44c7ff] duration-300 transition">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
    </a>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            }
        }

        function validateForm() {
            const nama = document.getElementById("nama").value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();

            if (nama.length < 3) {
                alert("Nama harus memiliki minimal 3 karakter.");
                return false;
            }

            if (!email.includes("@")) {
                alert("Masukkan alamat email yang valid.");
                return false;
            }

            if (password.length < 6) {
                alert("Kata sandi harus memiliki minimal 6 karakter.");
                return false;
            }

            return true;
        }
    </script>

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