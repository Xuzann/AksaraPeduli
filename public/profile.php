<?php
session_start(); // Wajib untuk mengakses session
include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Ambil user_id dari session
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : "Guest";

// Gunakan prepared statement untuk keamanan
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Data pengguna tidak ditemukan.";
    exit();
}

// Perbaikan path gambar default
$defaultImagePath = 'image/default_profile.png';
$profileImageUrl = isset($user['profile_picture']) && !empty($user['profile_picture'])
    ? 'display_image.php?user_id=' . $user_id . '&t=' . time()
    : $defaultImagePath;

$nama = $user['nama'] ?? 'Pengguna';

$stmt->close();
// Jangan close connection di sini karena mungkin dibutuhkan oleh script lain
?>

<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="./src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <title>
        Aksara Peduli
    </title>
    <style>
        body {
            font-family: 'poppins';
        }

        #chart-container {
            width: 100%;
            width: 450px;
            height: 350px;
        }

        #profilePopup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            /* Warna hitam transparan */
            backdrop-filter: blur(5px);
            /* Efek blur */
            justify-content: center;
            align-items: center;
        }
    </style>
    <script></script>
</head>

<body class="bg-white font-[poppins]">
    <header>
        <nav class="bg-white shadow-md relative w-full z-10">
            <div class="max-w-7xl mx-auto px-6 flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex ">
                    <a href="#"></a>
                    <img src="image/logo.png" class="h-[75px]" alt="Logo AksaraPeduli">
                </div>

                <!-- Menu Navigasi -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="index.php" class="text-gray-700 hover:text-[#44c7ff]">Beranda</a>
                    <a href="#tentang" class="text-gray-700 hover:text-[#44c7ff]">Tentang</a>
                    <a href="#kegiatan" class="text-gray-700 hover:text-[#44c7ff]">Kegiatan</a>
                    <a href="#kontak" class="text-gray-700 hover:text-[#44c7ff]">Kontak</a>
                    <a href="#" class="px-5 py-3 bg-[#3874B3] rounded-md text-white relative font-semibold  hover:bg-[#44c7ff] transition-all duration-300 text-sm cursor-pointer">
                        Mulai Donasi
                    </a>
                    <!-- Ikon Profil -->
                    <a href="profile.php">
                        <button class="relative group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700 hover:text-[#44c7ff] cursor-pointer"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-3.33 0-10 1.67-10 5v2h20v-2c0-3.33-6.67-5-10-5z" />
                            </svg>

                        </button>
                    </a>

                </div>
                <!-- Mobile Menu Button -->
                <button id="menu-btn" class="md:hidden text-gray-700 focus:outline-none">
                    ☰
                </button>
            </div>
        </nav>
    </header>

    <main class=" mt-[35px]">
        <section id="profile-picture" class="mb-5">
            <div class="flex flex-col justify-center items-center">
                <img id="profileImage" class="w-32 h-32 object-cover rounded-full bg-gray-300 cursor-pointer hover:opacity-90 transition-opacity"
                    src="<?php echo htmlspecialchars($profileImageUrl); ?>" alt="Profile Picture"
                    onerror="this.src='<?php echo htmlspecialchars($defaultImagePath); ?>'">
                <h2 class="text-2xl font-semibold mt-4"><?php echo htmlspecialchars($nama); ?></h2>
            </div>

            <!-- Popup Modal -->
            <div id="profilePopup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                <div class="relative bg-white rounded-lg p-6 w-full max-w-md shadow-xl transform transition-all">
                    <h3 class="text-xl font-semibold mb-4">Ubah Foto Profil</h3>

                    <form id="uploadForm" method="POST" enctype="multipart/form-data" action="upload.php">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Unggah foto baru</label>
                            <input type="file" name="profileUpload" id="profileUpload" accept="image/*" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100 cursor-pointer" required>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" id="cancelPopup" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 duration-300 cursor-pointer">
                                Batal
                            </button>
                            <button type="submit" id="saveButton" class="px-4 py-2 text-sm font-medium text-white bg-[#3874B3] rounded-md hover:bg-[#44c7ff] duration-300 cursor-pointer">
                                Simpan
                            </button>
                        </div>
                    </form>

                    <button id="closePopup" class="absolute top-3 right-3 text-gray-400 hover:text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const profileImage = document.getElementById('profileImage');
                const profilePopup = document.getElementById('profilePopup');
                const closePopup = document.getElementById('closePopup');
                const cancelPopup = document.getElementById('cancelPopup');
                const uploadForm = document.getElementById('uploadForm');
                const profileUpload = document.getElementById('profileUpload');
                const saveButton = document.getElementById('saveButton');

                profileImage.addEventListener('click', function() {
                    profilePopup.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                });

                function closeModal() {
                    profilePopup.classList.add('hidden');
                    document.body.style.overflow = '';
                }

                closePopup.addEventListener('click', closeModal);
                cancelPopup.addEventListener('click', closeModal);
                profilePopup.addEventListener('click', function(e) {
                    if (e.target === profilePopup) {
                        closeModal();
                    }
                });

                uploadForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    if (!profileUpload.files.length) {
                        alert('Silakan pilih gambar terlebih dahulu!');
                        return;
                    }

                    let formData = new FormData(uploadForm);
                    saveButton.disabled = true;
                    saveButton.innerText = 'Mengunggah...';

                    fetch('upload.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => {
                                    throw err;
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Tambahkan timestamp untuk menghindari cache
                                profileImage.src = data.imageUrl + '&t=' + new Date().getTime();
                                closeModal();
                            } else {
                                throw new Error(data.error || 'Gagal mengunggah gambar');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan: ' + error.message);
                        })
                        .finally(() => {
                            saveButton.disabled = false;
                            saveButton.innerText = 'Simpan';
                        });
                });
            });
        </script>

        <section class="flex justify-between px-64">
            <section id="data diri">
                <div class=" grid grid-cols-2">
                    <div class="w-full">
                        <h3 class="text-lg font-semibold mb-2">Data diri</h3>
                        <form action="" method="POST" onsubmit="return validateForm()" class="w-[360px]">
                            <div class="mb-4">
                                <label class="block ml-3 font-medium text-gray-700 text-sm">Nama</label>
                                <input type="text" class="w-full border text-sm border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent" placeholder="Masukkan nama Anda">
                            </div>

                            <div class="mb-4">
                                <label class="block ml-3 font-medium text-gray-700 text-sm">Email</label>
                                <input type="email" class="w-full border text-sm border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent" placeholder="Masukkan email Anda">
                            </div>

                            <div class="mb-4">
                                <label for="oldPassword" class="block ml-3 font-medium text-gray-700 text-sm mb-2">Kata Sandi Lama</label>
                                <div class="relative">
                                    <input type="password" id="oldPassword" name="oldPassword" placeholder="Masukkan kata sandi Anda"
                                        class="w-full px-4 py-2.5 border border-gray-300 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent">
                                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500" onclick="togglePassword('oldPassword', 'toggleOldPassword')">
                                        <i class="fa fa-eye-slash" id="toggleOldPassword"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="newPassword" class="block ml-3 font-medium text-gray-700 text-sm mb-2">Kata Sandi Baru</label>
                                <div class="relative">
                                    <input type="password" id="newPassword" name="newPassword" placeholder="Masukkan kata sandi Anda"
                                        class="w-full px-4 py-2.5 border border-gray-300 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent">
                                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500" onclick="togglePassword('newPassword', 'toggleNewPassword')">
                                        <i class="fa fa-eye-slash" id="toggleNewPassword"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="flex ml-[53px] gap-1.5">
                                <button id="logoutButton" class="mb-7 w-[150px] px-5 z-1 py-3 bg-[#3874B3] rounded-xl text-white bottom-4 left-[95.5px] font-medium hover:bg-[#44c7ff] duration-300 text-xs cursor-pointer">
                                    Keluar Akun
                                </button>

                                <button class="mb-7 w-[150px] px-5 z-1 py-3 bg-[#3874B3] rounded-xl text-white bottom-4 left-[95.5px] font-medium hover:bg-[#44c7ff] duration-300 text-xs cursor-pointer">
                                    Ubah dan Simpan
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
                <script>
                    function togglePassword(inputId, iconId) {
                        const passwordField = document.getElementById(inputId);
                        const toggleIcon = document.getElementById(iconId);

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
                    document.getElementById("logoutButton").addEventListener("click", function() {
                        fetch("logout.php")
                            .then(response => {
                                if (response.ok) {
                                    window.location.href = "index.php"; // Redirect setelah logout
                                }
                            })
                            .catch(error => console.error("Logout error:", error));
                    });
                </script>
            </section>

            <section id="chart">
                <div class="text-lg font-semibold">Pencapaian Anda</div>

                <div id="chart-container">
                    <canvas id="myLineChart"></canvas>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        fetch("get_donations.php") // Ambil data dari PHP
                            .then(response => response.json())
                            .then(data => {
                                const ctx = document.getElementById('myLineChart').getContext('2d');
                                new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                                        datasets: [{
                                            label: 'Jumlah Donasi per Bulan',
                                            data: data, // Data dari PHP
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderWidth: 2,
                                            tension: 0.1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: {
                                                beginAtZero: true,
                                            },
                                            y: {
                                                beginAtZero: true,
                                                ticks: {
                                                    stepSize: 1 // Pastikan hanya angka bulat
                                                }
                                            }
                                        }
                                    }
                                });
                            })
                            .catch(error => console.error("Gagal mengambil data: ", error));
                    });
                </script>

            </section>

        </section>
    </main>
    <?php include "layout/footer.html"; ?>
</body>

</html>