@extends('layouts.main')

@section('container')

@if(!isset($user))
<div class="alert alert-danger">
    Error: Variabel user tidak ditemukan. Silakan hubungi administrator.
</div>
@php
$user = Auth::user();
@endphp
@endif

<body class="bg-gray-50 font-[poppins]">
    <main class="pt-24 pb-16 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Profil Admin</h1>
                <p class="text-gray-600 mt-2">Kelola informasi profil admin dan lihat statistik donasi Anda</p>
            </div>

            <!-- Alert Messages -->
            @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if (session()->has('error'))
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-600 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <p class="text-red-800 font-medium">Terjadi kesalahan:</p>
                        <p class="text-red-700 text-sm mt-1">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-600 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <p class="text-red-800 font-medium">Terjadi kesalahan input:</p>
                        <ul class="text-red-700 text-sm mt-1 space-y-1">
                            @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left Column - Profile Info & Forms -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Profile Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-[#3874B3] px-6 py-8">
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <img id="profileImage" src="{{ $user->image ? asset($user->image) : asset('images/default-avatar.png') }}"
                                        alt="Foto Profil Admin"
                                        class="w-20 h-20 rounded-full border-4 border-white shadow-lg object-cover">
                                    <div class="absolute bottom-0 right-0 bg-white rounded-full p-1 shadow-lg">
                                        <svg class="w-4 h-4 text-[#44c7ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-white">
                                    <h2 class="text-2xl font-bold">{{ $user->nama ?? 'Nama Admin' }}</h2>
                                    <p class="text-red-100 text-sm">{{ $user->email ?? 'admin@example.com' }}</p>
                                    <div class="flex items-center mt-2">
                                        <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-yellow-400 text-sm font-medium">Administrator</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Profile Form -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center mb-6">
                            <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">Edit Profil Admin</h3>
                        </div>

                        <form action="{{ route('admin.update', $user->id ?? Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <!-- Profile Image Upload -->
                            <div class="mb-6">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    Foto Profil
                                </label>
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <img id="imagePreview" src="{{ $user->image ? asset($user->image) : asset('images/default-avatar.png') }}"
                                            alt="Preview" class="w-16 h-16 rounded-full object-cover border-2 border-gray-300">
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" id="image" name="image" onchange="previewProfileImage(this)"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent transition-all duration-200"
                                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF, WEBP. Maksimal 5MB.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Lengkap
                                    </label>
                                    <input type="text" id="nama" name="nama"
                                        value="{{ old('nama', $user->nama) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent transition-all duration-200">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email
                                    </label>
                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent transition-all duration-200">
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-5 mt-5">
                                <h4 class="text-sm font-medium text-gray-900 mb-4">Ubah Kata Sandi</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label for="current_password"
                                            class="block text-sm font-medium text-gray-700 mb-2">
                                            Kata Sandi Saat Ini
                                        </label>
                                        <input type="password" id="current_password" name="current_password"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent transition-all duration-200"
                                            placeholder="Masukkan kata sandi saat ini">
                                    </div>

                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                            Kata Sandi Baru
                                        </label>
                                        <input type="password" id="password" name="password"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent transition-all duration-200"
                                            placeholder="Masukkan kata sandi baru">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end pt-5 border-t border-gray-200 mt-5">
                                <button type="submit"
                                    class="px-6 py-3 bg-[#3874B3] text-white rounded-lg hover:bg-[#44c7ff] focus:ring-2 focus:ring-[#44c7ff] focus:ring-offset-2 transition-all duration-200 font-medium">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Campaign Management Section - CONTAINER TERPISAH -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center mb-6">
                            <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">Kelola Kampanye Donasi</h3>
                        </div>

                        <form id="campaignForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="campaign_id" id="campaign_id" />

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                        Judul Kampanye
                                    </label>
                                    <input type="text" name="title" id="title"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent transition-all duration-200"
                                        placeholder="Masukkan judul kampanye" />
                                </div>

                                <div>
                                    <label for="campaign_image" class="block text-sm font-medium text-gray-700 mb-2">
                                        Gambar Kampanye
                                    </label>
                                    <input type="file" name="image" id="campaign_image" onchange="previewCampaignImage(this)"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent transition-all duration-200"
                                        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" />
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF, WEBP. Maksimal 5MB.</p>
                                    <div id="uploadStatus" class="mt-2 text-sm"></div>
                                </div>

                                <div>
                                    <label for="target_amount" class="block text-sm font-medium text-gray-700 mb-2">
                                        Target Donasi (Rp)
                                    </label>
                                    <input type="number" name="target_amount" id="target_amount"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent transition-all duration-200"
                                        placeholder="Masukkan target donasi" min="1" />
                                </div>

                                <div>
                                    <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Berakhir
                                    </label>
                                    <input type="date" name="deadline" id="deadline"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent transition-all duration-200"
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}" />
                                    <p class="text-xs text-gray-500 mt-1">Minimal besok ({{ date('d M Y', strtotime('+1 day')) }})</p>
                                </div>
                            </div>

                            <div class="mt-5">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Deskripsi
                                </label>
                                <textarea name="description" id="description" rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent transition-all duration-200"
                                    placeholder="Masukkan deskripsi kampanye"></textarea>
                            </div>

                            <div class="mt-5">
                                <label for="updates" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kabar Terbaru
                                </label>
                                <textarea name="updates" id="updates" rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#44c7ff] focus:border-transparent transition-all duration-200"
                                    placeholder="Masukkan update kampanye"></textarea>
                            </div>

                            <div class="flex gap-3 pt-5 border-t border-gray-200 mt-5">
                                <button type="button" onclick="createCampaign()"
                                    class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 font-medium">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Buat Kampanye
                                </button>
                                <button type="button" onclick="updateCampaign()" id="updateBtn" style="display: none;"
                                    class="px-6 py-3 bg-[#3874B3] text-white rounded-lg hover:bg-[#44c7ff] focus:ring-2 focus:ring-[#44c7ff] focus:ring-offset-2 transition-all duration-200 font-medium">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Update Kampanye
                                </button>
                                <button type="button" onclick="deleteCampaign()" id="deleteBtn" style="display: none;"
                                    class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 font-medium">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus Kampanye
                                </button>
                                <button type="button" onclick="clearForm()"
                                    class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 font-medium">
                                    Reset Form
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Logout Form -->
                    <form action="/logout" method="POST" class="flex items-center justify-end">
                        @csrf
                        <button type="submit"
                            class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 font-medium">
                            Keluar
                        </button>
                    </form>
                </div>

                <!-- Right Column - Statistics & Campaign List -->
                <div class="space-y-6">
                    <!-- Charts Section -->
                    <div class="space-y-6">
                        <!-- Monthly Donations Chart -->
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 w-full max-w-2xl">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Donasi Bulanan (12 Bulan Terakhir)</h3>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="h-64 md:h-80">
                                <canvas id="monthlyDonationsChart"></canvas>
                            </div>
                            <div class="mt-4 text-center">
                                <p class="text-sm text-gray-600">Total Donasi:</p>
                                <p id="totalDonations" class="text-xl font-semibold text-[#44c7ff] mb-4">
                                    Rp {{ number_format(array_sum($chart_data['monthly_donations']['data']), 0, ',', '.') }}
                                </p>
                                <button
                                    onclick="downloadChart('monthlyDonationsChart', 'Donasi_Bulanan_' + new Date().getFullYear())"
                                    class="bg-[#3874B3] text-white font-medium py-2 px-5 rounded-lg hover:bg-[#44c7ff] transition duration-300 shadow-md focus:outline-none focus:ring-2 focus:ring-[#44c7ff] focus:ring-opacity-50">
                                    <svg class="w-4 h-4 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download
                                </button>
                            </div>
                        </div>

                        <!-- Payment Method Chart -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Metode Pembayaran Populer</h3>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                    </path>
                                </svg>
                            </div>
                            <div class="h-48">
                                <canvas id="paymentMethodDonationsChart"></canvas>
                            </div>
                            <div class="mt-4 text-center">
                                <p class="text-sm text-gray-600">Total Metode Pembayaran:</p>
                                <p class="text-lg font-semibold text-[#44c7ff]">
                                    {{ count($chart_data['payment_method_donations']['labels']) }} Metode Aktif
                                </p>
                                <button onclick="downloadChart('paymentMethodDonationsChart', 'Metode_Pembayaran_' + new Date().getFullYear())"
                                    class="bg-[#3874B3] text-white font-medium py-2 px-5 rounded-lg hover:bg-[#44c7ff] transition duration-300 shadow-md focus:outline-none focus:ring-2 focus:ring-[#44c7ff] focus:ring-opacity-50">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download
                                </button>
                            </div>
                        </div>

                        <!-- Campaign List -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Daftar Kampanye</h3>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div class="max-h-96 overflow-y-auto space-y-3">
                                @forelse($campaigns as $campaign)
                                <div onclick='fillCampaignForm(@json($campaign))'
                                    class="cursor-pointer border border-gray-200 p-4 rounded-lg hover:bg-gray-50 hover:border-[#44c7ff] transition-all duration-200 
                                            {{ $campaign->is_expired ? 'bg-gray-50 border-gray-300' : '' }}">

                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="text-base font-semibold mb-1 {{ $campaign->is_expired ? 'text-gray-500' : 'text-[#44c7ff]' }}">
                                            {{ $campaign->title }}
                                        </h4>
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

                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-600">
                                            Target: Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            Terkumpul: Rp {{ number_format($campaign->total_donated, 0, ',', '.') }}
                                            <span class="text-xs text-gray-500">({{ number_format($campaign->percentage, 1) }}%)</span>
                                        </p>

                                        @if($campaign->is_expired)
                                        <p class="text-sm text-red-500">
                                            Berakhir {{ $campaign->days_passed }} hari yang lalu
                                        </p>
                                        @else
                                        <p class="text-sm text-gray-500">
                                            Deadline: {{ \Carbon\Carbon::parse($campaign->deadline)->format('d M Y') }}
                                            ({{ $campaign->days_left }} hari lagi)
                                        </p>
                                        @endif
                                    </div>

                                    <!-- Progress Bar -->
                                    <div class="mt-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="h-2 rounded-full {{ $campaign->is_target_reached ? 'bg-green-500' : ($campaign->is_expired ? 'bg-gray-400' : 'bg-[44c7ff]') }}"
                                                style="width: {{ $campaign->percentage }}%"></div>
                                        </div>
                                    </div>

                                    @if($campaign->image)
                                    <div class="mt-2">
                                        <img src="{{ asset($campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-20 object-cover rounded">
                                    </div>
                                    @endif
                                </div>
                                @empty
                                <div class="text-center py-8 text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    <p>Belum ada kampanye donasi</p>
                                    <p class="text-sm">Buat kampanye pertama Anda!</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const chartData = @json($chart_data);

        // Monthly Donations Chart
        const monthlyDonationsCtx = document.getElementById('monthlyDonationsChart').getContext('2d');
        const monthlyDonationsChart = new Chart(monthlyDonationsCtx, {
            type: 'line',
            data: {
                labels: chartData.monthly_donations.labels,
                datasets: [{
                    label: 'Total Donasi Per Bulan',
                    data: chartData.monthly_donations.data,
                    borderColor: '#44c7ff',
                    backgroundColor: '#9ed9f2',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#44c7ff',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#374151',
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Tren Donasi Bulanan Seluruh User',
                        color: '#1f2937',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 11
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 11
                            },
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // Payment Method Chart
        const paymentMethodDonationsCtx = document.getElementById('paymentMethodDonationsChart').getContext('2d');
        const paymentMethodDonationsChart = new Chart(paymentMethodDonationsCtx, {
            type: 'doughnut',
            data: {
                labels: chartData.payment_method_donations.labels,
                datasets: [{
                    data: chartData.payment_method_donations.data,
                    backgroundColor: [
                        '#1dbafd', 
                        '#44c7ff',
                        '#59c8f7', 
                        '#7cd8ff',
                        '#9ed9f2', 
                        '#b3e5fa' 
                    ],
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            color: '#6b7280',
                            font: {
                                size: 12
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Metode Pembayaran',
                        color: '#44c7ff',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                cutout: '60%'
            }
        });

        // Function to download chart as image
        function downloadChart(chartId, filename) {
            const canvas = document.getElementById(chartId);
            const url = canvas.toDataURL('image/png');

            // Create download link
            const link = document.createElement('a');
            link.download = filename + '.png';
            link.href = url;

            // Trigger download
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Show success message
            showNotification('Grafik berhasil didownload!', 'success');
        }

        // Function to show notification
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-4 py-2 rounded-lg text-white font-medium transition-all duration-300 ${
                    type === 'success' ? 'bg-green-500' : 
                    type === 'error' ? 'bg-red-500' : 
                    'bg-blue-500'
                }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Campaign Management Functions
        function fillCampaignForm(campaign) {
            document.getElementById('campaign_id').value = campaign.campaign_id;
            document.getElementById('title').value = campaign.title;
            document.getElementById('description').value = campaign.description;
            document.getElementById('updates').value = campaign.updates || '';
            document.getElementById('target_amount').value = campaign.target_amount;
            document.getElementById('deadline').value = campaign.deadline;

            // Show update and delete buttons
            document.getElementById('updateBtn').style.display = 'inline-block';
            document.getElementById('deleteBtn').style.display = 'inline-block';

            // Show current image if exists
            if (campaign.image) {
                showImagePreview(campaign.image);
            }
        }

        function clearForm() {
            document.getElementById('campaignForm').reset();
            document.getElementById('campaign_id').value = '';
            document.getElementById('updateBtn').style.display = 'none';
            document.getElementById('deleteBtn').style.display = 'none';

            // Clear image preview
            const preview = document.getElementById('imagePreview');
            if (preview) {
                preview.style.display = 'none';
            }

            // Reset date minimum
            document.getElementById('deadline').min = '{{ date("Y-m-d", strtotime("+1 day")) }}';
        }

        function createCampaign() {
            const form = document.getElementById('campaignForm');
            form.action = '{{ route("admin.campaign.create") }}';
            form.submit();
        }

        function updateCampaign() {
            const form = document.getElementById('campaignForm');
            form.action = '{{ route("admin.campaign.update") }}';
            form.submit();
        }

        function deleteCampaign() {
            if (confirm('Apakah Anda yakin ingin menghapus kampanye ini?')) {
                const form = document.getElementById('campaignForm');
                form.action = '{{ route("admin.campaign.delete") }}';
                form.submit();
            }
        }

        // Image preview function
        function previewProfileImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('profileImage').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewCampaignImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create or update campaign image preview
                    let preview = document.getElementById('campaignImagePreview');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.id = 'campaignImagePreview';
                        preview.className = 'mt-2';
                        preview.innerHTML = `
                                <img id="campaignPreviewImg" src="/placeholder.svg" alt="Preview Kampanye" class="w-32 h-32 object-cover rounded-lg border">
                                <p class="text-xs text-gray-500 mt-1">Preview gambar kampanye</p>
                            `;
                        input.parentNode.appendChild(preview);
                    }

                    document.getElementById('campaignPreviewImg').src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function showImagePreview(src) {
            let preview = document.getElementById('imagePreview');
            if (!preview) {
                // Create preview element if doesn't exist
                preview = document.createElement('div');
                preview.id = 'imagePreview';
                preview.className = 'mt-2';
                preview.innerHTML = `
                        <img id="previewImg" src="/placeholder.svg" alt="Preview" class="w-32 h-32 object-cover rounded-lg border">
                        <p class="text-xs text-gray-500 mt-1">Preview gambar</p>
                    `;
                document.getElementById('campaign_image').parentNode.appendChild(preview);
            }

            document.getElementById('previewImg').src = src.startsWith('uploads/') ? '{{ asset("") }}' + src : src;
            preview.style.display = 'block';
        }
    </script>
</body>
@endsection