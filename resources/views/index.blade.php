@extends('layouts.main')

@section('container')
<body class="bg-white font-[poppins]">
    <main>
        <section id="hero"
            class="relative w-full h-[700px] sm:h-[700px] md:h-[700px] lg:h-[1000px] overflow-hidden items-center text-center justify-center">
            <div class="overlay"></div>
            <img src="images/Group 10.png" alt="Anak SD" class="w-full h-[650px] absolute object-cover -z-10">
            <div class="hero-text">
                <h1 class="text-white font-bold mt-40 sm:text-xl md:text-3xl lg:text-4xl xl:text-5xl">
                    Bersama, Kita Ciptakan Generasi Emas!</h1>
                <p class="text-white mt-4 mb-5 font-light text-xs sm:text-xs md:text-sm lg:text-sm">
                    Setiap anak berhak mendapatkan pendidikan yang layak. Bersama, kita bisa membantu<br>mereka meraih
                    mimpi dan menciptakan masa depan yang lebih baik.</p>
                <a href="#about" class="text-white underline font-light text-xs sm:text-xs md:text-sm lg:text-sm">
                    Informasi Selengkapnya<br>
                </a>
                <button class="px-7 z-1 py-3 mt-10 bg-[#3874B3] rounded-md text-white font-semibold hover:bg-[#44c7ff] transition-all duration-300 text-sm cursor-pointer">
                    Mulai Donasi
                </button>
            </div>

            <section id="sub-hero" class="container mx-auto w-full h-[500px] mt-16">
                <div class="justify-center gap-16 px-4 pb-5 z-30 hidden sm:hidden md:hidden lg:flex">

                    <!-- Kampanye dengan target tertinggi -->
                    @forelse ($campaigns as $c) 
                    <div class="relative w-[275px] h-[410px] rounded-2xl bg-white shadow flex-none">
                        @if($c->image && file_exists(public_path($c->image)))
                            <img src="{{ asset($c->image) }}" class="w-[275px] h-[220px] rounded-t-lg object-cover" alt="{{ $c->title }}">
                        @else
                            <img src="{{ asset('images/sample1.jpg') }}" class="w-[275px] h-[220px] rounded-t-lg object-cover" alt="Default Campaign Image">
                        @endif
                        <div class="p-3 pb-16">
                            <span class="mb-2 block text-xs">AksaraPeduli</span>
                            <span class="block font-semibold truncate" title="{{ $c->title }}">{{ $c->title }}</span>
                            <div class="mt-2">
                                <svg width="250" height="5">
                                    <rect width="100%" height="100%" rx="3" fill="#E8E8E8" />
                                    <rect width="{{ ($c->progress / 100) * 250 }}" height="100%" rx="3" fill="#10A8E5" />
                                </svg>
                                <div class="mt-1 text-sm">
                                    <span>Terkumpul: Rp{{ number_format($c->collected_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="mt-1 text-xs text-gray-500">
                                    @if($c->is_expired)
                                        <span class="text-red-500">Kampanye telah berakhir</span>
                                    @else
                                        <span>{{ $c->days_left }} hari tersisa</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('campaigns.show', $c->campaign_id) }}" class="absolute bottom-4 right-6 px-5 py-3 bg-[#3874B3] rounded-xl text-white text-xs font-medium hover:bg-[#44c7ff]">
                            Donasi
                        </a>
                    </div>
                    @empty
                    <div class="relative w-[275px] h-[410px] rounded-2xl bg-white shadow flex-none flex items-center justify-center">
                        <p class="text-gray-500 text-center p-4">Belum ada kampanye donasi</p>
                    </div>
                    @endforelse
                </div>
            </section>
        </section>

        <section id="about" class="mx-20 h-auto py-10">
            <div class="md:flex lg:flex xl:flex max-w-[1500px] gap-4">
                <div class="max-w-[1600px] pr-3">
                    <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-bold tracking-wide">
                        Aksara Peduli - <br>Bersama, Kita Ciptakan Generasi Emas
                    </h2>
                    <p class="mt-4 text-justify text-gray-600 mb-5 tracking-wide text-xs sm:text-xs md:text-xs lg:text-base">
                        AksaraPeduli adalah platform donasi digital yang berfokus pada pendidikan di Indonesia.
                        AksaraPeduli hadir sebagai jembatan kebaikan yang transparan dan akuntabel, menghubungkan para donatur dengan anak-anak Indonesia yang membutuhkan dukungan pendidikan.
                        ...
                    </p>
                </div>
                <div class="flex-shrink-0 w-full md:w-[240px] lg:w-[400px] xl:w-[460px]">
                    <img alt="A woman with two children smiling"
                        class="rounded-lg shadow object-cover max-w-full h-auto"
                        src="images/gambar1 (1).jpg">
                </div>
            </div>
        </section>

        <section id="info" class="relative mx-20 py-12 h-auto">
            <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-bold tracking-wide mb-10">
                Informasi Kegiatan
            </h2>
            <div class="mx-auto ml-[85px] mb-4 flex flex-row space-x-4 overflow-x-auto scroll-smooth pb-4">
                <!-- Kegiatan 1 -->
                <div class="relative w-[360px] h-[430px] ml-2 flex-shrink-0 rounded-2xl bg-white shadow">
                    <img src="images/image 5.png" class="h-[260px] w-full rounded-t-lg" alt="">
                    <div class="p-3">
                        <span class="mb-5 block text-base font-semibold">
                            Bakti Kepada Sekolah Dasar Maluku Utara
                        </span>
                        <div class="mb-7 flex items-center">
                            <span class="text-xs font-light mr-2">AksaraPeduli - Volunteer</span>
                            <img src="images/calendar_2278049.png" class="h-[16px] w-[16px] mr-2" alt="">
                            <span class="text-xs font-light">01 Oktober 2025</span>
                        </div>
                        <button class="ml-52 px-5 py-3 bg-[#3874B3] rounded-xl text-white text-xs font-medium hover:bg-[#44c7ff] duration-300">
                            Selengkapnya
                        </button>
                    </div>
                </div>
                 <div class="relative w-[360px] h-[430px] ml-2 flex-shrink-0 rounded-2xl bg-white shadow">
                    <img src="images/image 5.png" class="h-[260px] w-full rounded-t-lg" alt="">
                    <div class="p-3">
                        <span class="mb-5 block text-base font-semibold">
                            Bakti Kepada Sekolah Dasar Maluku Utara
                        </span>
                        <div class="mb-7 flex items-center">
                            <span class="text-xs font-light mr-2">AksaraPeduli - Volunteer</span>
                            <img src="images/calendar_2278049.png" class="h-[16px] w-[16px] mr-2" alt="">
                            <span class="text-xs font-light">01 Oktober 2025</span>
                        </div>
                        <button class="ml-52 px-5 py-3 bg-[#3874B3] rounded-xl text-white text-xs font-medium hover:bg-[#44c7ff] duration-300">
                            Selengkapnya
                        </button>
                    </div>
                </div>
                <div class="relative w-[360px] h-[430px] ml-2 flex-shrink-0 rounded-2xl bg-white shadow">
                    <img src="images/image 5.png" class="h-[260px] w-full rounded-t-lg" alt="">
                    <div class="p-3">
                        <span class="mb-5 block text-base font-semibold">
                            Bakti Kepada Sekolah Dasar Maluku Utara
                        </span>
                        <div class="mb-7 flex items-center">
                            <span class="text-xs font-light mr-2">AksaraPeduli - Volunteer</span>
                            <img src="images/calendar_2278049.png" class="h-[16px] w-[16px] mr-2" alt="">
                            <span class="text-xs font-light">01 Oktober 2025</span>
                        </div>
                        <button class="ml-52 px-5 py-3 bg-[#3874B3] rounded-xl text-white text-xs font-medium hover:bg-[#44c7ff] duration-300">
                            Selengkapnya
                        </button>
                    </div>
                </div>
                
            </div>
        </section>

    </main>
</body>
@endsection
