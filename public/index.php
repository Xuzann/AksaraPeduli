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
    <title>
        Aksara Peduli
    </title>
    <style>
        body {
            font-family: 'poppins';
        }
    </style>
    <script></script>
</head>

<body class="bg-white font-[poppins]">
    <nav class="bg-white shadow-md fixed w-full z-10">
        <div class="max-w-7xl mx-auto flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex ">
                <a href="#"></a>
                <img src="image/logo.png" class="h-[75px]" alt="Logo AksaraPeduli">
            </div>

            <!-- Menu Navigasi -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="#tentang" class="text-gray-700 hover:text-[#44c7ff]">Tentang</a>
                <a href="#kegiatan" class="text-gray-700 hover:text-[#44c7ff]">Kegiatan</a>
                <a href="#kontak" class="text-gray-700 hover:text-[#44c7ff]">Kontak</a>
                <a href="donasiawal.php" class="px-5 py-3 bg-[#3874B3] rounded-md text-white relative font-semibold  hover:bg-[#44c7ff] transition-all duration-300 text-sm cursor-pointer">
                    Mulai Donasi
                </a>
                <!-- Ikon Profil -->
                <a href="profile.php">
                    <button class="relative group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700 hover:text-[#44c7ff] cursor-pointer "
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

    <main>
        <section id="hero"
            class="relative w-full h-[700px] sm:h-[700px] md:h-[700px] lg:h-[1000px] overflow-hidden items-center text-center justify-center">
            <div class="overlay"></div>
            <img src="image/Group 10.png" alt="Anak SD" class="w-full h-[650px] absolute object-cover -z-10">
            <div class="hero-text">
                <h1 class="text-white font-bold mt-40 sm:text-xl md:text-3xl lg:text-4xl xl:text-5xl font-[poppins]">
                    Bersama, Kita Ciptakan Generasi Emas!</h1>
                <p class="text-white mt-4 mb-5 font-light text-xs sm:text-xs md:text-sm lg:text-sm">
                    Setiap anak berhak mendapatkan pendidikan yang layak. Bersama, kita bisa membantu<br>mereka meraih
                    mimpi dan menciptakan masa depan yang lebih baik.</p>
                <a href="#about" class="text-white underline font-light text-xs sm:text-xs md:text-sm lg:text-sm">
                    Informasi Selengkapnya<br>
                </a>
                <button class="px-7 z-1 py-3 mt-10 bg-[#3874B3] rounded-md text-white relative font-semibold  hover:bg-[#44c7ff] transition-all duration-300 text-sm cursor-pointer">
                    Mulai Donasi
                </button>
            </div>
            <section id="sub-hero" class="container mx-auto w-full h-[500px] mt-16">
                <div class="justify-center gap-16 px-4 pb-5 z-30 hidden sm:hidden md:hidden lg:flex">
                    <div
                        class="relative w-[275px] h-[410px] rounded-2xl bg-white shadow-[0_2px_8px_rgba(152,152,152,0.5)] flex-none">
                        <img loading="lazy" decoding="async" data-nimg="1"
                            class="w-[275px] h-[220px] rounded-tl-lg rounded-tr-lg " style="color: transparent;"
                            src="https://images.unsplash.com/photo-1640488065806-e3cf96865965?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Perbaikan Sekolah SDN Tadika Mesra">
                        <div class="p-3">
                            <div class="mb-2 flex">
                                <span
                                    class="inline-block overflow-hidden text-xs text-ellipsis whitespace-nowrap">Sumbawa</span>
                            </div>
                            <span
                                class="mb-3 block h-auto overflow-hidden break-words text-left font-semibold">Perbaikan
                                Sekolah SDN Tadika Mesra</span>
                            <div class="absolute bottom-16">
                                <svg width="250px" height="5" aria-label="progressBar">
                                    <rect x="0" rx="3" width="100%" height="100%" fill="#E8E8E8"></rect>
                                    <rect x="0" rx="3" width="82%" height="100%" fill="#10A8E5"
                                        aria-describedby="progress 80%"></rect>
                                </svg>
                                <div class="mt-[5px] flex">
                                    <span class="text-sm font-semibold text-left">Rp 21.029.000</span>
                                </div>
                            </div>
                        </div>
                        <button class="ml-36 mt-7 px-5 z-1 py-3 bg-[#3874B3] rounded-xl text-white bottom-4 left-[95.5px] font-medium hover:bg-[#44c7ff] duration-300 text-xs cursor-pointer">
                            Donasi
                        </button>
                    </div>

                    <div
                        class="relative w-[275px] h-[410px] rounded-2xl bg-white shadow-[0_2px_8px_rgba(152,152,152,0.5)] flex-none">
                        <img loading="lazy" decoding="async" data-nimg="1"
                            class="w-[275px] h-[220px] rounded-tl-lg rounded-tr-lg " style="color: transparent;"
                            src="https://images.unsplash.com/photo-1634044060889-7e8fcf0e415c?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Pembelian Buku Belajar Siswa">
                        <div class="p-3">
                            <div class="mb-2 flex">
                                <span
                                    class="inline-block overflow-hidden text-xs text-ellipsis whitespace-nowrap">Lombok</span>
                            </div>
                            <span
                                class="mb-3 block h-auto overflow-hidden break-words text-left font-semibold">Pembelian
                                Buku Belajar Siswa SMPN Mekar Sari</span>
                            <div class="absolute bottom-16">
                                <svg width="250px" height="5" aria-label="progressBar">
                                    <rect x="0" rx="3" width="100%" height="100%" fill="#E8E8E8"></rect>
                                    <rect x="0" rx="3" width="51.78%" height="100%" fill="#10A8E5"
                                        aria-describedby="progress 80%"></rect>
                                </svg>
                                <div class="mt-[5px] flex">
                                    <span class="text-sm font-semibold text-left">Rp 5.112.200</span>
                                </div>
                            </div>
                        </div>
                        <button class="ml-36 mt-7 px-5 z-1 py-3 bg-[#3874B3] rounded-xl text-white bottom-4 left-[95.5px] font-medium hover:bg-[#44c7ff] duration-300 text-xs cursor-pointer">
                            Donasi
                        </button>
                    </div>

                    <div
                        class="relative w-[275px] h-[410px] rounded-2xl bg-white shadow-[0_2px_8px_rgba(152,152,152,0.5)] flex-none">
                        <img loading="lazy" decoding="async" data-nimg="1"
                            class="w-[275px] h-[220px] rounded-tl-lg rounded-tr-lg " style="color: transparent;"
                            src="https://images.unsplash.com/photo-1630705605873-5d7776c38d78?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                        <div class="p-3">
                            <div class="mb-2 flex">
                                <span
                                    class="inline-block overflow-hidden text-xs text-ellipsis whitespace-nowrap">Nias</span>
                            </div>
                            <span
                                class="mb-3 block h-auto overflow-hidden break-words text-left font-semibold">Pengadaan
                                Fasilitas SDN Taruna Bangsa</span>
                            <div class="absolute bottom-16">
                                <svg width="250px" height="5" aria-label="progressBar">
                                    <rect x="0" rx="3" width="100%" height="100%" fill="#E8E8E8"></rect>
                                    <rect x="0" rx="3" width="78.9%" height="100%" fill="#10A8E5"
                                        aria-describedby="progress 80%"></rect>
                                </svg>
                                <div class="mt-[5px] flex">
                                    <span class="text-sm font-semibold text-left">Rp 15.753.000</span>
                                </div>
                            </div>
                        </div>
                        <button class="ml-36 mt-7 px-5 z-1 py-3 bg-[#3874B3] rounded-xl text-white bottom-4 left-[95.5px] font-medium hover:bg-[#44c7ff] duration-300 text-xs cursor-pointer">
                            Donasi
                        </button>
                    </div>
                </div>
            </section>
        </section>

        <section id="about" class="mx-20 h-[650px] sm:h-[700px] md:h-[360px] lg:h-[500px] xl:h-[500px]">
            <div class="md:flex lg:flex xl:flex max-w-[1500px] gap-4">
                <div class="max-w-[1600px] pr-3">
                    <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-bold tracking-wide">
                        Aksara Peduli - <br>Bersama, Kita Ciptakan Generasi Emas
                    </h2>
                    <p
                        class="mt-4 text-justify text-gray-600 mb-5 tracking-wide text-xs sm:text-xs md:text-xs lg:text-base">
                        AksaraPeduli adalah platform donasi digital yang berfokus pada pendidikan di Indonesia.
                        AksaraPeduli hadir sebagai jembatan kebaikan yang transparan
                        dan akuntabel, menghubungkan para donatur dengan anak-anak Indonesia yang membutuhkan dukungan
                        pendidikan. Setiap kontribusi Anda akan menjadi harapan
                        baru bagi mereka yang bercita-cita meraih pendidikan berkualitas. Kami percaya, setiap anak
                        berhak mendapatkan kesempatan yang sama untuk belajar dan
                        berkembang, dan AksaraPeduli hadir untuk mewujudkan mimpi itu. Bergabunglah dengan kami untuk
                        mendukung pendidikan yang merata dan berkualitas di
                        seluruh Indonesia. Dengan berdonasi, Anda membantu menciptakan generasi emas yang siap
                        menghadapi tantangan masa depan.
                    </p>
                </div>
                <div class="flex-shrink-0 w-full md:w-[240px] lg:w-[400px] xl:w-[460px]">
                    <img alt="A woman with two children smiling"
                        class="rounded-lg shadow object-cover max-w-full h-auto" loading="lazy" src="image/gambar1 (1).jpg">
                </div>
            </div>
        </section>

        <section id="info" class="relative mx-20 py-12 h-[700px]">
            <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-bold tracking-wide mb-10">
                Informasi Kegiatan
            </h2>
            <div class="mx-auto ml-[85px] mb-4 flex flex-row space-x-4 overflow-x-auto scroll-smooth pb-4">
                <div class="flex gap-10 pb-2">
                    <div class="relative w-[360px] h-[430px] ml-2 flex-shrink-0 rounded-2xl bg-white shadow-[0_2px_8px_rgba(152,152,152,0.5)]" data-testid="homepage-card-campaign-pilihan-kitabisa">
                        <img src="image/image 5.png" alt="" loading="lazy" decoding="async" class="h-[260px] w-full rounded-tl-lg rounded-tr-lg" data-nimg="1" style="color: transparent">
                        <div class="p-3">
                            <span class="mb-5 block h-9  break-words text-base font-semibold text-mineshaft">
                                Bakti Kepada Sekolah Dasar Maluku Utara
                            </span>
                            <div class="mb-7 flex">
                                <span class="mr-15 inline-block text-xs font-light text-mineshaft">AksaraPeduli - Volunteer</span>
                                <img src="image/calendar_2278049.png" alt="" loading="lazy" decoding="async" class="h-[16px] w-[16px] mr-2" data-nimg="1" style="color: transparent">
                                <span class="text-xs font-light">01 Oktober 2025</span>
                            </div>
                            <button class="ml-52 px-5 z-1 py-3 bg-[#3874B3] rounded-xl text-white bottom-4 left-[95.5px] font-medium hover:bg-[#44c7ff] duration-300 text-xs cursor-pointer">
                                Selengkapnya
                            </button>
                        </div>
                    </div>

                <div class="flex gap-8 pb-2">
                    <div class="relative w-[360px] h-[430px] flex-shrink-0 rounded-2xl bg-white shadow-[0_2px_8px_rgba(152,152,152,0.5)]" data-testid="homepage-card-campaign-pilihan-kitabisa">
                        <img src="image/image 5.png" alt="" loading="lazy" decoding="async" class="h-[260px] w-full rounded-tl-lg rounded-tr-lg" data-nimg="1" style="color: transparent">
                        <div class="p-3">
                            <span class="mb-5 block h-9  break-words text-base font-semibold text-mineshaft">
                                Bakti Kepada Sekolah Dasar Maluku Utara
                            </span>
                            <div class="mb-7 flex">
                                <span class="mr-15 inline-block text-xs font-light text-mineshaft">AksaraPeduli - Volunteer</span>
                                <img src="image/calendar_2278049.png" alt="" loading="lazy" decoding="async" class="h-[16px] w-[16px] mr-2" data-nimg="1" style="color: transparent">
                                <span class="text-xs font-light">01 Oktober 2025</span>
                            </div>
                            <button class="ml-52 px-5 z-1 py-3 bg-[#3874B3] rounded-xl text-white bottom-4 left-[95.5px] font-medium hover:bg-[#44c7ff] duration-300 text-xs cursor-pointer">
                                Selengkapnya
                            </button>
                        </div>
                    </div>

                <div class="flex gap-8 pb-2">
                    <div class="relative w-[360px] h-[430px] flex-shrink-0 rounded-2xl bg-white shadow-[0_2px_8px_rgba(152,152,152,0.5)]" data-testid="homepage-card-campaign-pilihan-kitabisa">
                        <img src="image/image 5.png" alt="" loading="lazy" decoding="async" class="h-[260px] w-full rounded-tl-lg rounded-tr-lg" data-nimg="1" style="color: transparent">
                        <div class="p-3">
                            <span class="mb-5 block h-9  break-words text-base font-semibold text-mineshaft">
                                Bakti Kepada Sekolah Dasar Maluku Utara
                            </span>
                            <div class="mb-7 flex">
                                <span class="mr-15 inline-block text-xs font-light text-mineshaft">AksaraPeduli - Volunteer</span>
                                <img src="image/calendar_2278049.png" alt="" loading="lazy" decoding="async" class="h-[16px] w-[16px] mr-2" data-nimg="1" style="color: transparent">
                                <span class="text-xs font-light">01 Oktober 2025</span>
                            </div>
                            <button class="ml-52 px-5 z-1 py-3 bg-[#3874B3] rounded-xl text-white bottom-4 left-[95.5px] font-medium hover:bg-[#44c7ff] duration-300 text-xs cursor-pointer">
                                Selengkapnya
                            </button>
                        </div>
                    </div>
                </div>
        </section>

    </main>
    <?php include "layout/footer.html"; ?>
</body>

</html>