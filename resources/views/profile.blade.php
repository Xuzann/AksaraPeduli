@extends('layouts.main')

@section('container')

<body class="bg-gray-50 font-[poppins]">
    <main class="pt-24 pb-16 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Profil Saya</h1>
                <p class="text-gray-600 mt-2">Kelola informasi profil dan lihat statistik donasi Anda</p>
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

            @if (session()->has('loginError'))
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-600 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <p class="text-red-800 font-medium">Terjadi kesalahan:</p>
                        <p class="text-red-700 text-sm mt-1">{{ session('loginError') }}</p>
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

                <!-- Left Column - Profile Info & Form -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Profile Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-[#3874B3] px-6 py-8">
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <img id="profileImage"
                                        src="{{ $user->image ? asset($user->image) : asset('images/default-avatar.png') }}"
                                        alt="Foto Profil"
                                        class="w-20 h-20 rounded-full border-4 border-white shadow-lg object-cover">
                                    <div class="absolute bottom-0 right-0 bg-white rounded-full p-1 shadow-lg">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-white">
                                    <h2 class="text-2xl font-bold">{{ $user->nama ?? 'Nama Pengguna' }}</h2>
                                    <p class="text-blue-100 text-sm">{{ $user->email ?? 'email@example.com' }}</p>
                                    <div class="flex items-center mt-2">
                                        <svg class="w-4 h-4 text-green-400 mr-1" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-green-400 text-sm font-medium">Akun Terverifikasi</span>
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
                            <h3 class="text-lg font-semibold text-gray-900">Edit Profil</h3>
                        </div>

                        <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <!-- Profile Image Upload -->
                            <div class="mb-6">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    Foto Profil
                                </label>
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <img id="imagePreview"
                                            src="{{ $user->image ? asset($user->image) : asset('images/default-avatar.png') }}"
                                            alt="Preview" class="w-16 h-16 rounded-full object-cover border-2 border-gray-300">
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" id="image" name="image" onchange="previewImage(this)"
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
                                            placeholder="Masukkan kata sandi baru (opsional)">
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

                    <!-- Logout Form -->
                    <form action="/logout" method="POST" class="flex items-center justify-end">
                        @csrf
                        <button type="submit"
                            class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 font-medium">
                            Keluar
                        </button>
                    </form>
                </div>

                <!-- Right Column - Statistics -->
                <div class="space-y-6">
                    <!-- Charts Section -->
                    <div class="space-y-6">
                        <!-- Daily Donations Chart -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Donasi Harian</h3>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="h-48">
                                <canvas id="dailySalesChart"></canvas>
                            </div>
                        </div>

                        <!-- Payment Method Chart -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Metode Pembayaran</h3>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                    </path>
                                </svg>
                            </div>
                            <div class="h-48">
                                <canvas id="paymentMethodSalesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const chartData = @json($chart_data);

        // Daily Sales Chart
        const dailySalesCtx = document.getElementById('dailySalesChart').getContext('2d');
        new Chart(dailySalesCtx, {
            type: 'line',
            data: {
                labels: chartData.daily_sales.labels,
                datasets: [{
                    label: 'Total Donasi Per Hari',
                    data: chartData.daily_sales.data,
                    borderColor: '#44c7ff',
                    backgroundColor: '#9ed9f2',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#44c7ff',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6b7280'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        },
                        ticks: {
                            color: '#6b7280',
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // Payment Method Chart
        const paymentMethodSalesCtx = document.getElementById('paymentMethodSalesChart').getContext('2d');
        new Chart(paymentMethodSalesCtx, {
            type: 'doughnut',
            data: {
                labels: chartData.payment_method_sales.labels,
                datasets: [{
                    data: chartData.payment_method_sales.data,
                    backgroundColor: [
                        '#1dbafd',
                        '#44c7ff',
                        '#59c8f7',
                        '#7cd8ff',
                        '#9ed9f2',
                        '#b3e5fa'
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
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
                    }
                },
                cutout: '60%'
            }
        });

        // Image preview function
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('profileImage').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
@endsection