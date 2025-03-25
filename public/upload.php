<?php
session_start();
include 'koneksi.php';

header('Content-Type: application/json');

// Periksa login
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    die(json_encode(['success' => false, 'error' => 'Unauthorized']));
}

// Validasi file
if (!isset($_FILES['profileUpload']) || $_FILES['profileUpload']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    die(json_encode(['success' => false, 'error' => 'File upload error']));
}

// Validasi tipe file
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$fileType = $_FILES['profileUpload']['type'];
if (!in_array($fileType, $allowedTypes)) {
    http_response_code(400);
    die(json_encode(['success' => false, 'error' => 'Hanya file JPG, PNG, atau GIF yang diperbolehkan']));
}

// Validasi ukuran file (max 2MB)
if ($_FILES['profileUpload']['size'] > 2097152) {
    http_response_code(400);
    die(json_encode(['success' => false, 'error' => 'Ukuran file maksimal 2MB']));
}

// Buat folder upload jika belum ada
$uploadDir = '../uploads/profile_pictures/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Generate nama file unik
$filename = uniqid('profile_') . '.' . pathinfo($_FILES['profileUpload']['name'], PATHINFO_EXTENSION);
$targetPath = $uploadDir . $filename;

// Pindahkan file
if (!move_uploaded_file($_FILES['profileUpload']['tmp_name'], $targetPath)) {
    http_response_code(500);
    die(json_encode(['success' => false, 'error' => 'Gagal menyimpan file']));
}

// Update database
try {
    $stmt = $conn->prepare("UPDATE users SET profile_picture = ? WHERE user_id = ?");
    $stmt->bind_param("si", $filename, $_SESSION['user_id']);
    $stmt->execute();
    
    echo json_encode([
        'success' => true,
        'imageUrl' => 'display_image.php?user_id=' . $_SESSION['user_id']
    ]);
} catch (Exception $e) {
    unlink($targetPath); // Hapus file jika gagal update database
    http_response_code(500);
    die(json_encode(['success' => false, 'error' => 'Database error']));
}
?>