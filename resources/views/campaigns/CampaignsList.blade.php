@extends('layouts.main')

@section('container')
<div class="bg-gray-50 font-[poppins]">
    <main class="pt-24 pb-16 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Kampanye Donasi</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Pilih kampanye donasi yang ingin Anda dukung. Setiap kontribusi Anda akan membuat perbedaan nyata dalam kehidupan mereka yang membutuhkan.
                </p>
            </div>

            <!-- Filter & Sort Section -->
            <div class="mb-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <span class="text-gray-700 font-medium">{{ $campaigns->total() }} kampanye ditemukan</span>
                </div>
                
                <div class="flex items-center gap-4">
                    <form method="GET" action="{{ route('campaigns.index') }}" id="sortForm">
                        <select name="sort" onchange="document.getElementById('sortForm').submit()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="highest_target" {{ $sort == 'highest_target' ? 'selected' : '' }}>Target Tertinggi</option>
                            <option value="lowest_target" {{ $sort == 'lowest_target' ? 'selected' : '' }}>Target Terendah</option>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Campaigns Grid -->
            @if($campaigns->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                    @foreach($campaigns as $campaign)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            <!-- Campaign Image -->
                            <div class="relative h-48 overflow-hidden">
                                @if($campaign->image && file_exists(public_path($campaign->image)))
                                    <img src="{{ asset($campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('images/Group 10.png') }}" alt="Default Campaign" class="w-full h-full object-cover">
                                @endif
                                
                                <!-- Status Badge -->
                                <div class="absolute top-3 right-3">
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

                            <!-- Campaign Content -->
                            <div class="p-5">
                                <!-- Organization -->
                                <div class="flex items-center mb-3">
                                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                        <svg class="w-3 h-3 text-[#3874B3]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-gray-600 font-medium">AksaraPeduli</span>
                                    <svg class="w-4 h-4 text-green-500 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>

                                <!-- Title -->
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]" title="{{ $campaign->title }}">
                                    {{ $campaign->title }}
                                </h3>

                                <!-- Progress Section -->
                                <div class="mb-4">
                                    <!-- Progress Bar -->
                                    <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                        <div class="h-2 rounded-full {{ $campaign->is_target_reached ? 'bg-green-500' : ($campaign->is_expired ? 'bg-gray-400' : 'bg-primary') }}" 
                                             style="width: {{ $campaign->percentage }}%"></div>
                                    </div>
                                    
                                    <!-- Progress Info -->
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-600">{{ number_format($campaign->percentage, 1) }}% tercapai</span>
                                    </div>
                                </div>

                                <!-- Amount Info -->
                                <div class="mb-4">
                                    <div class="text-lg font-bold text-gray-900">
                                        Rp {{ number_format($campaign->total_donated, 0, ',', '.') }}
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        dari Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}
                                    </div>
                                </div>

                                <!-- Time Info -->
                                <div class="mb-4 flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    @if($campaign->is_expired)
                                        <span class="text-red-500">Berakhir {{ $campaign->days_passed }} hari yang lalu</span>
                                    @else
                                        <span>{{ $campaign->days_left }} hari tersisa</span>
                                    @endif
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('campaigns.show', $campaign->campaign_id) }}" 
                                   class="block w-full text-center px-4 py-3 {{ $campaign->is_expired ? 'bg-gray-400 cursor-not-allowed' : 'bg-[#3874B3] hover:bg-[#44c7ff]' }} text-white rounded-lg font-medium transition-colors duration-200">
                                    @if($campaign->is_expired)
                                        Kampanye Berakhir
                                    @else
                                        Donasi Sekarang
                                    @endif
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $campaigns->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Kampanye</h3>
                    <p class="text-gray-600 mb-6">Saat ini belum ada kampanye donasi yang tersedia.</p>
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-secondary transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Buat Kampanye Pertama
                    </a>
                </div>
            @endif
        </div>
    </main>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
