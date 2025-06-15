@extends('layouts.main')

@section('container')

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

            @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
            @endif
            @if (session()->has('loginError'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Oops! Terjadi kesalahan:</p>
                <ul class="mt-2 list-disc list-inside text-sm">
                    <li>{{ session('loginError') }}</li> {{-- Ini akan menampilkan "Email atau Password yang Anda masukkan salah." --}}
                </ul>
            </div>
            @endif

            <!-- Bagian Form diubah jadi seperti ini -->
            <form action="/login" method="POST">
                @csrf
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

                <!-- Submit Button -->
                <div class="flex w-full mt-8">
                    <button type="submit" class="w-[47.5%] mx-auto text-sm py-3 bg-[#3874B3] text-white rounded-lg hover:bg-[#44c7ff] transition duration-300 cursor-pointer">
                        Masuk
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-2 text-gray-600 text-xs">
                Belum punya akun? <a href="/registrasi" class="text-[#3b8eb5] hover:underline">Daftar</a>
            </div>
        </div>

        <!-- Right side (image) -->
        <div class="hidden md:block">
            <img src="{{ asset('images/image 10.jpg') }}" alt="Children studying together" class="h-[600px] object-cover">
        </div>
    </div>

    <a href="" class="fixed ml-20 mb-5 bottom-6 left-6 w-10 h-10 bg-[#3874B3] text-white rounded-full flex items-center justify-center hover:bg-[#44c7ff]  duration-300 transition">
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
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();

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
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (email === '' || password === '') {
                alert('Semua field harus diisi');
                return false;
            }

            return true;
        }
    </script>
</body>

@endsection