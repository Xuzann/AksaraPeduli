<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function validateLogin() {
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;

            if (email === "" || password === "") {
                alert("Harap isi email dan kata sandi!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center mb-4">Login</h2>
        <form action="prosesLogin.php" method="POST" onsubmit="return validateLogin()">
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
            <button class="w-full bg-blue-600 text-white rounded-lg py-2 hover:bg-blue-700">
                Login
            </button>
        </form>
        <p class="text-center text-gray-600 mt-4">
            Belum punya akun? <a href="registrasi.php" class="text-blue-600 hover:underline">Daftar di sini</a>
        </p>
    </div>
</body>
</html>
