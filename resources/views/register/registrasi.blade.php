@extends('layouts.main')

@section('container')
<div class="flex justify-center items-center min-h-screen gap-16 px-6 md:px-20 relative">
        <div class="w-full max-w-lg bg-white p-8 md:p-10">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-semibold mb-2">Buat Akun Anda</h1>
                <p class="text-gray-600 text-xs">AksaraPeduli Mewujudkan Perubahan dengan Kepedulian</p>
            </div>

            <!-- Alert Success -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Alert Error -->
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/registrasi" method="POST" onsubmit="return validateForm()">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 ml-3 mb-2 text-sm">Nama</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                        class="w-full px-4 py-2.5 border text-xs border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff]"
                        placeholder="Masukkan nama Anda" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 ml-3 mb-2 text-sm">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2.5 border text-xs border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff]"
                        placeholder="Masukkan email Anda" required>
                </div>

                <div class="mb-2">
                    <label for="password" class="block text-gray-700 ml-3 mb-2 text-sm">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2.5 border text-xs border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff]"
                            placeholder="Masukkan kata sandi Anda" required>
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" onclick="togglePassword()" aria-label="Tampilkan kata sandi">
                            <i class="fa fa-eye-slash p-[1px]" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-6 flex ml-3 items-start">
                    <input type="checkbox" id="terms" class="mt-1 mr-2" required>
                    <label for="terms" class="text-gray-600 mt-[2px] text-xs">Saya menyetujui semua Syarat, Kebijakan Privasi, dan Biaya</label>
                </div>

                <div class="flex w-full">
                    <button type="submit" class="w-[47.5%] mx-auto text-sm py-3 bg-[#3874B3] text-white rounded-lg hover:bg-[#44c7ff] duration-300 transition cursor-pointer">
                        Daftar
                    </button>
                </div>
            </form>

            <div class="text-center mt-2 text-gray-600 text-xs">
                Sudah punya akun? <a href="/login" class="text-[#3b8eb5] hover:underline">Masuk</a>
            </div>
        </div>

        <div class="hidden md:block">
            <img src="{{ asset('images/image 10.jpg') }}" alt="Children studying together" class="h-[600px] object-cover">
        </div>
    </div>

    <a href="" class="fixed ml-20 mb-5 bottom-6 left-6 w-10 h-10 bg-[#3874B3] text-white rounded-full flex items-center justify-center hover:bg-[#44c7ff] duration-300 transition">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
    </a>

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
            const nama = document.getElementById('nama').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const terms = document.getElementById('terms').checked;

            if (nama === '' || email === '' || password === '') {
                alert('Semua field harus diisi');
                return false;
            }
            
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

            if (!terms) {
                alert("Anda harus menyetujui syarat dan ketentuan.");
                return false;
            }

            return true;
        }
    </script>
</body>
@endsection