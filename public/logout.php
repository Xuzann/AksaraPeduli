<?php
session_start(); // Mulai session
session_unset();  // Hapus semua variabel sesi
session_destroy(); // Hancurkan sesi
setcookie(session_name(), '', time() - 3600, '/'); // Hapus cookie sesi

echo json_encode(["status" => "success"]);
exit;
