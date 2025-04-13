<?php
header('Content-Type: application/json');

$host = "localhost";
$username = "root";  // Ganti jika diperlukan
$password = "";      // Ganti jika diperlukan
$database = "aksarapeduli";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die(json_encode(["error" => "Koneksi gagal: " . $conn->connect_error]));
}

// Hitung total donasi dari semua user per bulan
$query = "SELECT MONTH(donation_date) AS month, COUNT(*) AS total 
          FROM donations 
          GROUP BY MONTH(donation_date)";

$result = $conn->query($query);

// Siapkan array 12 bulan
$data = array_fill(0, 12, 0);

// Masukkan hasil query ke dalam array
while ($row = $result->fetch_assoc()) {
    $data[$row['month'] - 1] = (int) $row['total'];
}

echo json_encode($data);
$conn->close();
?>
