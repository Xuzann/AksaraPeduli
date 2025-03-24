<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mengambil data user berdasarkan email
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // Periksa apakah user ditemukan dan password cocok
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['email'] = $user['email'];

        // Redirect ke halaman profile setelah login
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Login gagal. Periksa email atau password!";
    }
}
?>

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

        <!-- Menampilkan pesan error jika login gagal -->
        <?php if (isset($error_message)): ?>
            <p class="text-red-600 text-center"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST" onsubmit="return validateLogin()">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="email">
                    Email
                </label>
                <input class="w-full border border-gray-300 rounded-lg py-2 px-4" id="email" name="email"
                    placeholder="Masukkan email Anda" type="email" required />
            </div>
            <div class="mb-4 relative">
                <label class="block text-gray-700 mb-2" for="password">
                    Kata Sandi
                </label>
                <input class="w-full border border-gray-300 rounded-lg py-2 px-4" id="password" name="password"
                    placeholder="Masukkan kata sandi Anda" type="password" required />
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white rounded-lg py-2 hover:bg-blue-700">
                Login
            </button>
        </form>
        <p class="text-center text-gray-600 mt-4">
            Belum punya akun? <a href="registrasi.php" class="text-blue-600 hover:underline">Daftar di sini</a>
        </p>
    </div>
</body>
</html>
