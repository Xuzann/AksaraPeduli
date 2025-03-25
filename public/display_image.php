<?php
include 'koneksi.php';

if (!isset($_GET['user_id'])) {
    header("HTTP/1.0 400 Bad Request");
    exit;
}

$stmt = $conn->prepare("SELECT profile_picture FROM users WHERE user_id = ?");
$stmt->bind_param("i", $_GET['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Path gambar
$defaultImage = 'image/default_profile.png';
$imagePath = '../uploads/profile_pictures/' . ($user['profile_picture'] ?? '');

// Jika file tidak ada, gunakan default
if (empty($user['profile_picture']) || !file_exists($imagePath)) {
    $imagePath = $defaultImage;
}

// Tentukan tipe konten
$mimeTypes = [
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png' => 'image/png',
    'gif' => 'image/gif'
];

$extension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
if (isset($mimeTypes[$extension])) {
    header('Content-Type: ' . $mimeTypes[$extension]);
    readfile($imagePath);
} else {
    header("HTTP/1.0 415 Unsupported Media Type");
}
?>