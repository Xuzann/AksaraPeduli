<?php
session_start(); // Tambahkan ini untuk mengakses session
header('Content-Type: application/json');

$host = "localhost";
$username = "root";  // Ganti jika perlu
$password = "";      // Ganti jika perlu
$database = "aksarapeduli";

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User belum login."]);
    exit;
}

$user_id = $_SESSION['user_id']; // Ambil user_id dari sesi login

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die(json_encode(["error" => "Koneksi gagal: " . $conn->connect_error]));
}

// Ambil jumlah donasi per bulan berdasarkan user yang sedang login
$query = "SELECT MONTH(donation_date) as month, COUNT(*) as total 
          FROM donations 
          WHERE user_id = ? 
          GROUP BY MONTH(donation_date)";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$data = array_fill(0, 12, 0);  // Default 12 bulan dengan 0 donasi
while ($row = $result->fetch_assoc()) {
    $data[$row['month'] - 1] = (int) $row['total'];  // Masukkan jumlah donasi ke array
}

echo json_encode($data);
$conn->close();
?>
