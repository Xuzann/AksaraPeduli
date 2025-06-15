@extends('layouts.main')

@section('container')

<body class="bg-gray-50 font-sans">

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8 pt-20">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Terjadi kesalahan:</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif
        
        @if (session()->has('loginError'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Oops! Terjadi kesalahan:</p>
                <ul class="mt-2 list-disc list-inside text-sm">
                    <li>{{ session('loginError') }}</li>
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Campaign Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Campaign Header -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="aspect-video w-full">
                        @if($campaign->image)
                            <img src="{{ asset($campaign->image) }}" 
                                 alt="{{ $campaign->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('images/Group 10.png') }}" 
                                 alt="Gambar Kampanye Default" 
                                 class="w-full h-full object-cover">
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="font-semibold text-gray-800">AksaraPeduli</span>
                            <i class="fas fa-check-circle text-green-500 text-sm"></i>
                        </div>
                        
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
                            {{ $campaign->title }}
                        </h1>
                        
                        @if($campaign->is_expired)
                            <!-- Campaign Expired Banner -->
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <h3 class="font-semibold text-red-800">Kampanye Donasi Telah Berakhir</h3>
                                        <p class="text-sm text-red-700">Masa donasi untuk kampanye ini telah berakhir pada {{ \Carbon\Carbon::parse($campaign->deadline)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Progress Section -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-600">Terkumpul</span>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-gray-600">Target</span>
                                    @if($campaign->is_expired)
                                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                            Berakhir
                                        </span>
                                    @elseif($campaign->is_target_reached)
                                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                            Target Tercapai
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                            Aktif
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                                <div class="h-3 rounded-full transition-all duration-500 {{ $campaign->is_target_reached ? 'bg-gradient-to-r from-green-500 to-green-600' : ($campaign->is_expired ? 'bg-gradient-to-r from-gray-400 to-gray-500' : 'bg-gradient-to-r from-primary to-blue-600') }}" 
                                     style="width: {{ $campaign->progress }}%"></div>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="text-left">
                                    <div class="text-xl font-bold {{ $campaign->is_expired ? 'text-gray-600' : 'text-primary' }}">
                                        Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-semibold text-gray-700">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</div>
                                    <div class="text-xs text-gray-500">{{ number_format($campaign->progress, 1) }}% tercapai</div>
                                </div>
                            </div>

                            @if($campaign->is_target_reached)
                                <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded-lg">
                                    <div class="flex items-center text-green-800">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="font-medium">Target tercapai! Kelebihan: Rp {{ number_format($campaign->collected_amount - $campaign->target_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Time Remaining -->
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <i class="fas fa-clock"></i>
                            @if($campaign->is_expired)
                                <span>Kampanye berakhir <strong class="text-red-600">{{ $campaign->days_passed ?? 0 }} hari yang lalu</strong></span>
                            @else
                                <span>Sisa waktu: <strong class="text-orange-600">{{ $sisaHari }} hari</strong></span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Campaign Details Accordion -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="accordion">
                        <!-- Description -->
                        <div class="border-b border-gray-100">
                            <button class="accordion-button w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors"
                                    onclick="toggleAccordion('description')">
                                <span class="font-semibold text-gray-800">
                                    <i class="fas fa-file-text mr-2 text-primary"></i>
                                    Deskripsi Kampanye
                                </span>
                                <i class="fas fa-chevron-down transition-transform duration-200" id="icon-description"></i>
                            </button>
                            <div class="accordion-content hidden px-6 pb-4" id="content-description">
                                <div class="prose prose-sm max-w-none text-gray-600">
                                    <p class="mb-3">
                                        {{ $campaign->description }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Latest News -->
                        <div class="border-b border-gray-100">
                            <button class="accordion-button w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors"
                                    onclick="toggleAccordion('news')">
                                <span class="font-semibold text-gray-800">
                                    <i class="fas fa-newspaper mr-2 text-primary"></i>
                                    Kabar Terbaru
                                </span>
                                <i class="fas fa-chevron-down transition-transform duration-200" id="icon-news"></i>
                            </button>
                            <div class="accordion-content hidden px-6 pb-4" id="content-news">
                                @if($campaign->updates)
                                    <div class="space-y-4">
                                        <div class="border-l-4 border-primary pl-4">
                                            <div class="text-sm text-gray-500 mb-1">Update Terbaru</div>
                                            <div class="text-gray-600">
                                                {!! nl2br(e($campaign->updates)) !!}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-gray-500">Belum ada kabar terbaru untuk kampanye ini.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Reviews -->
                        <div>
                            <button class="accordion-button w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors"
                                    onclick="toggleAccordion('reviews')">
                                <span class="font-semibold text-gray-800">
                                    <i class="fas fa-star mr-2 text-primary"></i>
                                    Ulasan Donatur
                                </span>
                                <i class="fas fa-chevron-down transition-transform duration-200" id="icon-reviews"></i>
                            </button>
                            <div class="accordion-content hidden px-6 pb-4" id="content-reviews">
                                @if(isset($recentDonations) && $recentDonations->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($recentDonations as $donation)
                                            @if($donation->review_text)
                                                <div class="bg-gray-50 rounded-lg p-4">
                                                    <div class="flex items-center gap-2 mb-2">
                                                        <div class="text-yellow-400">★★★★★</div>
                                                        <span class="font-semibold text-gray-800">{{ $donation->user->nama ?? 'Donatur Anonim' }}</span>
                                                        <span class="text-sm text-gray-500">• Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                                                    </div>
                                                    <p class="text-gray-600 text-sm">
                                                        "{{ $donation->review_text }}"
                                                    </p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500">Belum ada ulasan untuk kampanye ini.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Donations (if available) -->
                @if(isset($recentDonations) && $recentDonations->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-users mr-2 text-primary"></i>
                                Donasi Terbaru
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach($recentDonations as $donation)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-blue-600 font-semibold">{{ substr($donation->user->nama ?? 'A', 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $donation->user->nama ?? 'Donatur Anonim' }}</p>
                                                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($donation->donation_date)->format('d M Y, H:i') }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-green-600">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                                            <p class="text-xs text-gray-500">{{ $donation->payment_method }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Donation Form Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-8">
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            {{ $campaign->is_expired ? 'Kampanye Berakhir' : 'Berdonasi Sekarang' }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            {{ $campaign->is_expired ? 'Masa donasi telah berakhir' : 'Setiap rupiah Anda sangat berarti' }}
                        </p>
                    </div>

                    @if($campaign->is_expired)
                        <!-- Campaign Summary for Expired Campaign -->
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-800 mb-3">Ringkasan Kampanye</h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Total Terkumpul:</span>
                                        <span class="font-semibold">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Target:</span>
                                        <span class="font-semibold">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Persentase:</span>
                                        <span class="font-semibold">{{ number_format($campaign->progress, 1) }}%</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Status:</span>
                                        <span class="font-semibold {{ $campaign->is_target_reached ? 'text-green-600' : 'text-orange-600' }}">
                                            {{ $campaign->is_target_reached ? 'Target Tercapai' : 'Belum Tercapai' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button disabled 
                                        class="w-full bg-gray-400 text-white py-3 px-6 rounded-lg font-semibold cursor-not-allowed">
                                    <i class="fas fa-clock mr-2"></i>
                                    Masa Donasi Berakhir
                                </button>
                            </div>
                        </div>
                    @else
                        <!-- Active Donation Form -->
                        <form class="space-y-4" action="{{ route('donations.store') }}" method="POST">
                            @csrf
                            <!-- Quick Amount Buttons -->
                            <div class="grid grid-cols-3 gap-2 mb-4">
                                <button type="button" onclick="setAmount(50000)" 
                                        class="quick-amount px-3 py-2 text-sm border border-gray-300 rounded-lg hover:border-primary hover:text-primary transition-colors">
                                    50K
                                </button>
                                <button type="button" onclick="setAmount(100000)" 
                                        class="quick-amount px-3 py-2 text-sm border border-gray-300 rounded-lg hover:border-primary hover:text-primary transition-colors">
                                    100K
                                </button>
                                <button type="button" onclick="setAmount(250000)" 
                                        class="quick-amount px-3 py-2 text-sm border border-gray-300 rounded-lg hover:border-primary hover:text-primary transition-colors">
                                    250K
                                </button>
                            </div>
                            <input type="hidden" name="campaign_id" value="{{ $campaign->campaign_id }}">

                            <!-- Custom Amount -->
                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-heart text-red-500 mr-1"></i>
                                    Jumlah Donasi (Rp)
                                </label>
                                <input type="number" id="amount" name="amount" min="10000"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                       placeholder="Minimal Rp 10.000" required>
                                <p class="text-xs text-gray-500 mt-1">Minimal donasi Rp 10.000</p>
                            </div>

                            <!-- Payment Method -->
                            <div>
                                <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-credit-card text-primary mr-1"></i>
                                    Metode Pembayaran
                                </label>
                                <select id="payment_method" name="payment_method" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required>
                                    <option value="" disabled selected>Pilih metode pembayaran</option>
                                    <option value="gopay">GoPay</option>
                                    <option value="shopeepay">ShopeePay</option>
                                    <option value="ovo">OVO</option>
                                    <option value="dana">DANA</option>
                                    <option value="bank_transfer">Transfer Bank</option>
                                    <option value="credit_card">Kartu Kredit</option>
                                </select>
                            </div>

                            <!-- Message -->
                            <div>
                                <label for="review_text" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-message text-primary mr-1"></i>
                                    Pesan & Doa (Opsional)
                                </label>
                                <textarea id="review_text" name="review_text" rows="3" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all resize-none"
                                          placeholder="Tulis pesan atau doa untuk penerima donasi..."></textarea>
                            </div>

                            <!-- Donate Button -->
                            <button type="submit" 
                                    class="w-full bg-[#3874B3] hover:bg-[#44c7ff] text-white py-3 px-6 rounded-lg font-semibold transition-all duration-200 transform shadow-lg">
                                <i class="fas fa-heart mr-2"></i>
                                Donasi Sekarang
                            </button>
                        </form>
                    @endif

                    <!-- Trust Indicators -->
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <div class="flex items-center justify-center gap-4 text-xs text-gray-500">
                            <div class="flex items-center gap-1">
                                <i class="fas fa-shield-alt text-green-500"></i>
                                <span>Aman</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-lock text-green-500"></i>
                                <span>Terenkripsi</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-check-circle text-green-500"></i>
                                <span>Terpercaya</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Accordion functionality
        function toggleAccordion(section) {
            const content = document.getElementById(`content-${section}`);
            const icon = document.getElementById(`icon-${section}`);
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // Quick amount selection
        function setAmount(amount) {
            document.getElementById('amount').value = amount;
            
            // Update button styles
            document.querySelectorAll('.quick-amount').forEach(btn => {
                btn.classList.remove('bg-primary', 'text-white', 'border-primary');
                btn.classList.add('border-gray-300');
            });
            
            event.target.classList.add('bg-primary', 'text-white', 'border-primary');
            event.target.classList.remove('border-gray-300');
        }

        // Auto-open first accordion on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleAccordion('description');
        });
    </script>
    
</body>

@endsection
