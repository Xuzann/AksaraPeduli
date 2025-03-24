<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($nama) || empty($email) || empty($password)) {
        echo "<script>alert('Harap isi semua field!'); window.location.href='registrasi.php';</script>";
        exit();
    }

    // Simpan data ke database (sesuaikan koneksi dengan database-mu)
    $conn = new mysqli("localhost", "root", "", "aksarapeduli");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Hash password sebelum disimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$hashed_password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registrasi berhasil!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Gagal mendaftar: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
