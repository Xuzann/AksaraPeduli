<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id = $id");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-semibold text-center">Edit Profil</h2>
        <form action="edit.php" method="POST" class="mt-4">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            
            <label class="block mb-2">Nama</label>
            <input type="text" name="name" value="<?= $user['name'] ?>" class="w-full border border-gray-300 px-3 py-2 rounded-lg">

            <label class="block mt-4 mb-2">Email</label>
            <input type="email" name="email" value="<?= $user['email'] ?>" class="w-full border border-gray-300 px-3 py-2 rounded-lg">

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg mt-4">Simpan Perubahan</button>
        </form>
    </div>

</body>
</html>
