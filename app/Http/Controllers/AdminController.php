<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pengecekan role terlebih dahulu
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('profile.edit', ['profile' => Auth::user()->id])
                ->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        // Redirect ke edit admin profile
        return redirect()->route('admin.edit', ['admin' => Auth::user()->id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Untuk fitur CRUD yang akan ditambahkan nanti
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Untuk fitur CRUD yang akan ditambahkan nanti
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Redirect ke edit admin profile
        return redirect()->route('admin.edit', ['admin' => $id]);
    }

    /**
     * Show the form for editing the specified resource (Admin Profile).
     */
    public function edit(string $id)
    {
        $user = Auth::user();

        // Pengecekan role - hanya admin yang bisa akses
        if ($user->role !== 'admin') {
            return redirect()->route('profile.edit', ['profile' => $user->id])
                ->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        // Pastikan admin hanya bisa edit profile sendiri
        if ($user->id != $id) {
            return redirect()->route('admin.edit', ['admin' => $user->id])
                ->with('error', 'Anda hanya bisa mengedit profil sendiri.');
        }

        // Mengambil data donasi dari SELURUH USER berdasarkan metode pembayaran
        $donationData = Donation::selectRaw('payment_method, SUM(amount) as total_amount')
            ->groupBy('payment_method')
            ->get();

        // Mengambil data donasi bulanan dalam 12 bulan terakhir dari SELURUH USER
        $monthly_donations = Donation::selectRaw('YEAR(donation_date) as year, MONTH(donation_date) as month, SUM(amount) as total')
            ->where('donation_date', '>=', Carbon::now()->subMonths(12)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Buat array untuk 12 bulan terakhir dengan data 0 jika tidak ada donasi
        $monthlyData = [];
        $monthLabels = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthLabels[] = $date->format('M Y');

            $monthData = $monthly_donations->where('year', $date->year)
                ->where('month', $date->month)
                ->first();

            $monthlyData[] = $monthData ? $monthData->total : 0;
        }

        // Mengambil semua kampanye dengan informasi donasi
        $campaigns = Campaign::withSum('donations', 'amount')
            ->withCount('donations')
            ->latest()
            ->get()
            ->map(function ($campaign) {
                $campaign->is_expired = Carbon::parse($campaign->deadline)->isPast();
                $campaign->total_donated = $campaign->donations_sum_amount ?? 0;
                $campaign->percentage = $campaign->target_amount > 0
                    ? min(100, ($campaign->total_donated / $campaign->target_amount) * 100)
                    : 0;
                $campaign->is_target_reached = $campaign->total_donated >= $campaign->target_amount;

                // --- BAGIAN YANG DIPERBAIKI ---
                if ($campaign->is_expired) {
                    $campaign->days_left = 0;
                    $campaign->days_passed = (int) Carbon::now()->diffInDays(Carbon::parse($campaign->deadline));
                } else {
                    $campaign->days_left = (int) Carbon::now()->diffInDays(Carbon::parse($campaign->deadline));
                    $campaign->days_passed = 0;
                }
                return $campaign;
            });

        // Persiapkan data untuk chart
        $chart_data = [
            'monthly_donations' => [
                'labels' => $monthLabels,
                'data' => $monthlyData
            ],
            'payment_method_donations' => [
                'labels' => $donationData->pluck('payment_method')->toArray(),
                'data' => $donationData->pluck('total_amount')->toArray()
            ]
        ];

        // Mengirimkan data ke view admin menggunakan compact
        return view('admin', compact('user', 'chart_data', 'campaigns'));
    }

    /**
     * Update the specified resource in storage (Admin Profile Update).
     */
    public function update(Request $request, string $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Pastikan admin hanya bisa update profile sendiri
        if ($user->id != $id) {
            return redirect()->route('admin.edit', ['admin' => $user->id])
                ->with('error', 'Anda hanya bisa mengedit profil sendiri.');
        }

        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'required_with:password',
            'password' => 'nullable|string|min:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'image.image' => 'File yang diupload harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        // Jika ada gambar yang di-upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Gunakan helper function untuk create directory
            $uploadPath = $this->ensureDirectoryExists('uploads/profile_pictures');

            if (!$uploadPath) {
                return back()->withErrors(['image' => 'Gagal membuat direktori upload.']);
            }

            // Hapus gambar lama jika ada
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $image->getClientOriginalName());

            try {
                $image->move($uploadPath, $imageName);
                // Untuk database dan web URL, tetap gunakan forward slash
                $user->image = 'uploads/profile_pictures/' . $imageName;
            } catch (\Exception $e) {
                Log::error('Profile image upload failed: ' . $e->getMessage());
                return back()->withErrors(['image' => 'Gagal mengupload gambar: ' . $e->getMessage()]);
            }
        }

        // Jika password baru diisi, cek current password
        if (!empty($validatedData['password'])) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Kata sandi lama tidak sesuai.']);
            }
            $user->password = Hash::make($validatedData['password']);
        }

        // Update nama dan email
        $user->nama = $validatedData['nama'];
        $user->email = $validatedData['email'];
        $user->save();

        return redirect()->route('admin.edit', ['admin' => $user->id])
            ->with('success', 'Profil admin berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Untuk fitur CRUD yang akan ditambahkan nanti
    }

    /**
     * Helper function to ensure directory exists and is writable
     */
    private function ensureDirectoryExists($relativePath)
    {
        $fullPath = public_path($relativePath);

        // Log the path for debugging
        Log::info('Ensuring directory exists: ' . $fullPath);

        // Create directory if it doesn't exist
        if (!file_exists($fullPath)) {
            Log::info('Directory does not exist, creating: ' . $fullPath);

            if (!mkdir($fullPath, 0777, true)) {
                Log::error('Failed to create directory: ' . $fullPath);
                return false;
            }

            Log::info('Directory created successfully: ' . $fullPath);
        }

        // Check if directory is writable
        if (!is_writable($fullPath)) {
            Log::error('Directory is not writable: ' . $fullPath);

            // Try to change permissions
            if (!chmod($fullPath, 0777)) {
                Log::error('Failed to change directory permissions: ' . $fullPath);
                return false;
            }

            Log::info('Directory permissions changed: ' . $fullPath);
        }

        // Test write permission
        $testFile = $fullPath . DIRECTORY_SEPARATOR . 'test_write_' . time() . '.tmp';
        if (!file_put_contents($testFile, 'test')) {
            Log::error('Write test failed for directory: ' . $fullPath);
            return false;
        }

        // Clean up test file
        unlink($testFile);
        Log::info('Write test successful for directory: ' . $fullPath);

        return $fullPath;
    }

    /**
     * Create new campaign
     */
    public function createCampaign(Request $request)
    {
        // Debug: Log request data
        Log::info('Create Campaign Request:', [
            'has_file' => $request->hasFile('image'),
            'file_info' => $request->hasFile('image') ? [
                'name' => $request->file('image')->getClientOriginalName(),
                'size' => $request->file('image')->getSize(),
                'mime' => $request->file('image')->getMimeType(),
                'extension' => $request->file('image')->getClientOriginalExtension(),
            ] : null,
            'all_data' => $request->except(['image']) // Don't log file content
        ]);

        $validatedData = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('campaigns', 'title'),
            ],
            'description' => 'required|string',
            'updates' => 'nullable|string',
            'target_amount' => 'required|numeric|min:1',
            'deadline' => 'required|date|after:today',
            'image' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ], [
            'title.unique' => 'Kampanye dengan judul yang sama sudah ada.',
            'deadline.after' => 'Tanggal berakhir harus lebih dari hari ini.',
            'target_amount.min' => 'Target donasi minimal Rp 1.',
            'title.required' => 'Judul kampanye wajib diisi.',
            'description.required' => 'Deskripsi kampanye wajib diisi.',
            'image.image' => 'File yang diupload harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 10MB.',
        ]);

        // Handle image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            Log::info('Processing campaign image upload');

            // Gunakan helper function untuk create directory
            $uploadPath = $this->ensureDirectoryExists('uploads/campaigns');

            if (!$uploadPath) {
                Log::error('Failed to ensure campaigns directory exists');
                return back()->withErrors(['image' => 'Gagal membuat direktori upload untuk kampanye.'])->withInput();
            }

            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $image->getClientOriginalName());

            try {
                Log::info('Attempting to move file to: ' . $uploadPath . DIRECTORY_SEPARATOR . $imageName);

                $image->move($uploadPath, $imageName);

                // Untuk database dan web URL, tetap gunakan forward slash
                $validatedData['image'] = 'uploads/campaigns/' . $imageName;

                Log::info('Image uploaded successfully: ' . $validatedData['image']);
            } catch (\Exception $e) {
                Log::error('Campaign image upload failed: ' . $e->getMessage());
                Log::error('Upload path: ' . $uploadPath);
                Log::error('Image name: ' . $imageName);

                return back()->withErrors(['image' => 'Gagal mengupload gambar: ' . $e->getMessage()])->withInput();
            }
        }

        try {
            Campaign::create($validatedData);
            Log::info('Campaign created successfully');

            return redirect()->route('admin.edit', ['admin' => Auth::user()->id])
                ->with('success', 'Kampanye berhasil dibuat!');
        } catch (\Exception $e) {
            Log::error('Campaign creation failed: ' . $e->getMessage());
            return back()->withErrors(['general' => 'Gagal membuat kampanye: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Update campaign
     */
    public function updateCampaign(Request $request)
    {
        // Debug: Log request data
        Log::info('Update Campaign Request:', [
            'has_file' => $request->hasFile('image'),
            'campaign_id' => $request->campaign_id
        ]);

        // Validasi awal untuk memastikan campaign_id ada
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,campaign_id',
        ]);

        $campaign = Campaign::where('campaign_id', $request->campaign_id)->firstOrFail();

        // Validasi dengan aturan yang lebih fleksibel untuk update
        $validatedData = $request->validate([
            'campaign_id' => 'required|exists:campaigns,campaign_id',
            'title' => [
                'required',
                'string',
                'max:255',
                // Validasi judul kampanye harus unik kecuali untuk kampanye yang sedang diupdate
                Rule::unique('campaigns', 'title')->ignore($campaign->campaign_id, 'campaign_id'),
            ],
            'description' => 'required|string',
            'updates' => 'nullable|string',
            'target_amount' => 'required|numeric|min:1',
            'deadline' => 'required|date',
            'image' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ], [
            'title.unique' => 'Kampanye dengan judul yang sama sudah ada.',
            'campaign_id.exists' => 'Kampanye tidak ditemukan.',
            'target_amount.min' => 'Target donasi minimal Rp 1.',
            'title.required' => 'Judul kampanye wajib diisi.',
            'description.required' => 'Deskripsi kampanye wajib diisi.',
            'image.image' => 'File yang diupload harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 10MB.',
        ]);

        // Validasi deadline untuk kampanye yang sedang berjalan
        $deadlineDate = Carbon::parse($validatedData['deadline']);
        if ($deadlineDate->isPast() && !Carbon::parse($campaign->deadline)->isPast()) {
            return back()->withErrors(['deadline' => 'Tidak dapat mengubah deadline menjadi tanggal yang sudah berlalu untuk kampanye yang masih aktif.']);
        }

        // Handle image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Gunakan helper function untuk create directory
            $uploadPath = $this->ensureDirectoryExists('uploads/campaigns');

            if (!$uploadPath) {
                return back()->withErrors(['image' => 'Gagal membuat direktori upload untuk kampanye.']);
            }

            // Hapus gambar lama jika ada
            if ($campaign->image && file_exists(public_path($campaign->image))) {
                unlink(public_path($campaign->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $image->getClientOriginalName());

            try {
                $image->move($uploadPath, $imageName);
                // Untuk database dan web URL, tetap gunakan forward slash
                $validatedData['image'] = 'uploads/campaigns/' . $imageName;
                Log::info('Image updated successfully: ' . $validatedData['image']);
            } catch (\Exception $e) {
                Log::error('Image update failed: ' . $e->getMessage());
                return back()->withErrors(['image' => 'Gagal mengupload gambar: ' . $e->getMessage()]);
            }
        }

        unset($validatedData['campaign_id']);
        $campaign->update($validatedData);

        return redirect()->route('admin.edit', ['admin' => Auth::user()->id])
            ->with('success', 'Kampanye berhasil diperbarui!');
    }

    /**
     * Delete campaign
     */
    public function deleteCampaign(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,campaign_id',
        ]);

        $campaign = Campaign::where('campaign_id', $request->campaign_id)->firstOrFail();

        // Delete image if exists
        if ($campaign->image && file_exists(public_path($campaign->image))) {
            unlink(public_path($campaign->image));
        }

        $campaign->delete();

        return redirect()->route('admin.edit', ['admin' => Auth::user()->id])
            ->with('success', 'Kampanye berhasil dihapus!');
    }

    /**
     * Dashboard method untuk menampilkan dashboard admin (akan digunakan nanti)
     */
    public function dashboard()
    {
        // Pengecekan role
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('profile.edit', ['profile' => Auth::user()->id])
                ->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        // Mengambil data untuk dashboard admin
        $campaigns = Campaign::latest()->get();
        $donationData = Campaign::withSum('donations', 'amount')->get();
        $chart_labels = $donationData->pluck('title');
        $chart_data = $donationData->pluck('donations_sum_amount');

        // Return view admin dashboard (untuk nanti)
        return view('admin.dashboard', compact('campaigns', 'chart_labels', 'chart_data'));
    }
}
