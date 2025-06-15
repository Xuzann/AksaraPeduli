<nav class="bg-white shadow-md fixed w-full z-10">
    <div class="max-w-6xl mx-auto flex justify-between items-center h-16">
        <!-- Logo -->
        <div class="flex">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" class="h-[75px]" alt="Logo AksaraPeduli">
            </a>
        </div>

        <!-- Menu Navigasi -->
        <div class="hidden md:flex items-center space-x-6">
            <a href="#tentang" class="text-gray-700 hover:text-[#44c7ff]">Tentang</a>
            <a href="#kegiatan" class="text-gray-700 hover:text-[#44c7ff]">Kegiatan</a>
            <a href="{{ route('campaigns.index') }}" class="text-gray-700 hover:text-[#44c7ff]">Kampanye</a>
            <a href="#kontak" class="text-gray-700 hover:text-[#44c7ff]">Kontak</a>
            <a href="{{ route('campaigns.index') }}"
                class="px-5 py-3 bg-[#3874B3] rounded-md text-white font-semibold hover:bg-[#44c7ff] transition-all duration-300 text-sm">
                Mulai Donasi
            </a>
            
            <!-- User Menu -->
            @auth
                <div class="relative group">
                    <button class="flex items-center space-x-2 text-gray-700 hover:text-[#44c7ff] focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-3.33 0-10 1.67-10 5v2h20v-2c0-3.33-6.67-5-10-5z" />
                        </svg>
                        <span class="text-sm font-medium">{{ Auth::user()->nama }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('profile.edit', Auth::user()->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profil Saya
                            </a>
                        @endif
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="/login" class="text-gray-700 hover:text-[#44c7ff]">Login</a>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <button id="menu-btn" class="md:hidden text-gray-700 focus:outline-none">
            ☰
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="#tentang" class="block px-3 py-2 text-gray-700 hover:text-[#44c7ff]">Tentang</a>
            <a href="#kegiatan" class="block px-3 py-2 text-gray-700 hover:text-[#44c7ff]">Kegiatan</a>
            <a href="{{ route('campaigns.index') }}" class="block px-3 py-2 text-gray-700 hover:text-[#44c7ff]">Kampanye</a>
            <a href="#kontak" class="block px-3 py-2 text-gray-700 hover:text-[#44c7ff]">Kontak</a>
            <a href="{{ route('campaigns.index') }}" class="block px-3 py-2 bg-[#3874B3] text-white rounded-md">Mulai Donasi</a>
            
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-gray-700 hover:text-[#44c7ff]">Dashboard Admin</a>
                @else
                    <a href="{{ route('profile.edit', Auth::user()->id) }}" class="block px-3 py-2 text-gray-700 hover:text-[#44c7ff]">Profil Saya</a>
                @endif
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 text-gray-700 hover:text-[#44c7ff]">Keluar</button>
                </form>
            @else
                <a href="/login" class="block px-3 py-2 text-gray-700 hover:text-[#44c7ff]">Login</a>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    document.getElementById('menu-btn').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>
