<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="./src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Kampanye Donasi <?php echo htmlspecialchars($campaign['title']); ?></title>
    <style>
        .campaign-img {
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>

<body>
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

    <main>
        <div class="container my-5 mt-10">
            <div class="flex flex-wrap gap-4">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <?php
                    $progress = ($row['collected_amount'] / $row['target_amount']) * 100;
                    $progress = min($progress, 100);
                    ?>
                    <div class="flex lg:w-full px-20 bg-white rounded-lg overflow-hidden">
                        <div class="w-full md:w-1/2">
                            <img src="<?= htmlspecialchars($row['image']); ?>" alt="Kampanye Donasi"
                                class="rounded-lg object-cover max-h-96 h-full w-full mx-auto">
                        </div>
                        <div class="w-full md:w-1/2 p-6 flex flex-col justify-center">
                            <h4 class="text-xl font-semibold mb-1"><?= htmlspecialchars($row['title']); ?></h4>
                            <p class="text-sm text-gray-700 mb-2">AksaraPeduli <span class="text-green-500">✅</span></p>
                            <p class="text-sm font-semibold mt-3 mb-1">Target Donasi</p>
                            <div class="w-full mb-3 pr-4"> <!-- margin kanan -->
                                <div class="w-full h-2 bg-gray-200 rounded-full">
                                    <div class="h-2 rounded-full bg-sky-500" style="width: <?= $progress; ?>%"></div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-700">
                                <p>Terkumpul: Rp <?= number_format($row['collected_amount'], 0, ',', '.') ?></p>
                                <p>Sisa <?= $sisaHari ?> hari</p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>


            <div class="accordion-box container mt-10">
                <iframe class="flex flex-wrap lg:w-full px-20" srcdoc='
                    <html>
                    <head>
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                        <style>
                            .accordion-box {
                                border-radius: 16px;
                                /* overflow: hidden; */
                                border: none;
                                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                            }

                            .accordion {
                                border-radius: inherit;
                            }

                            .accordion-item {
                                border: none;
                                border-radius: inherit;
                                overflow: hidden;
                            }

                            .accordion-button {
                                border: none;
                                background-color: #e0f0ff;
                                /* contoh warna biru muda */
                                border-radius: inherit;
                                padding: 1rem 1.25rem;
                            }

                            .accordion-button:focus {
                                box-shadow: none;
                            }

                            .accordion-body {
                                display: block !important;
                                opacity: 1 !important;
                                visibility: visible !important;
                                height: auto !important;
                                max-height: none !important;
                                overflow: visible !important;
                                transform: none !important;
                            }
                        </style>
                    </head>
                    
                    <body>
                        <div class="accordion" id="accordionExample">
                        <!-- Accordion Deskripsi -->
                        <div class="accordion custom-card mt-5 mb-3" id="accordionDeskripsi">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingDeskripsi">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseDeskripsi" aria-expanded="false" aria-controls="collapseDeskripsi">
                                        Deskripsi
                                    </button>
                                </h2>
                                <div id="collapseDeskripsi" class="accordion-collapse collapse" aria-labelledby="headingDeskripsi"
                                    data-bs-parent="#accordionDeskripsi">
                                    <div class="accordion-body">
                                        <p><?php echo nl2br(htmlspecialchars($campaign['description'])); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Accordion Kabar Terbaru -->
                        <div class="accordion custom-card mb-3" id="accordionKabar">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKabar">
                                        Kabar Terbaru
                                    </button>
                                </h2>
                                <div id="collapseKabar" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p>Update dari AksaraPeduli untuk Anda yang Telah Berkontribusi<br>
                                        Terima kasih yang sebesar-besarnya kami sampaikan kepada seluruh donatur dan pihak yang telah memberikan dukungan moral maupun materiil dalam proses 
                                        pembangunan kembali sekolah di Desa Karang Mekar. Semangat dan kebaikan Anda semua telah menjadi cahaya harapan bagi anak-anak dan guru-guru di sana 
                                        yang selama ini terus berjuang di tengah keterbatasan.<br>
                                        Kami ingin membagikan kabar terbaru mengenai progres pembangunan yang telah berjalan. Berkat donasi dan bantuan yang terus mengalir, sejumlah langkah 
                                        penting telah berhasil diwujudkan:<p>
                                        <p><?php echo nl2br(htmlspecialchars($campaign['updates'])); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Accordion Ulasan -->
                        <div class="accordion custom-card" id="accordionUlasan">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUlasan">
                                        Ulasan
                                    </button>
                                </h2>
                                <div id="collapseUlasan" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p>⭐ "Sangat terharu melihat perkembangan sekolah ini, semoga anak-anak bisa belajar dengan nyaman." - Donatur A</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </body>
                    </html>' width="100%" height="500" style="border:none;">
                </iframe>
            </div>

            <section class="mt-10 container">
                <form action="" method="POST" class="ml-auto pr-20 w-[480px] ">
                    <div class="mb-4">
                        <label for="amount" class="form-label block ml-3 font-medium text-gray-700 text-sm">Jumlah Donasi (Rp)</label>
                        <input type="number" id="amount" name="amount"
                            class="form-control w-full border text-sm border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent"
                            placeholder="Masukkan jumlah donasi" required>
                    </div>

                    <div class="mb-4">
                        <label for="payment_method" class="form-label block ml-3 font-medium text-gray-700 text-sm">Metode Pembayaran</label>
                        <select id="payment_method" name="payment_method"
                            class="form-control w-full border text-sm border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent"
                            required>
                            <option value="" disabled selected>Pilih metode pembayaran</option>
                            <option value="gopay">GoPay</option>
                            <option value="shopeepay">ShopeePay</option>
                            <option value="ovo">OVO</option>
                            <option value="debit">Kartu Debit</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="review" class="form-label block ml-3 font-medium text-gray-700 text-sm">Ulasan</label>
                        <textarea id="review" name="review" rows="4"
                            class="form-control w-full border text-sm border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent"
                            placeholder="Beri ucapan atau doa kepada penerima donasi" required></textarea>
                    </div>

                    <div class="flex">
                        <button type="submit" name="update_profile"
                            class="mb-7 ml-auto w-[150px] px-5 z-1 py-3 bg-[#3874B3] rounded-xl text-white bottom-4 left-[95.5px] font-medium hover:bg-[#44c7ff] duration-300 text-xs cursor-pointer">
                            Donasi
                        </button>
                    </div>
                </form>
            </section>
    </main>

    <footer>
        <?php include "layout/footer.html"; ?>
    </footer>
</body>

</html>