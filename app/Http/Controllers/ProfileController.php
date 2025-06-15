<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Redirect ke edit profile
        return redirect()->route('profile.edit', ['profile' => Auth::user()->id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Redirect ke edit profile
        return redirect()->route('profile.edit', ['profile' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();

        // Pengecekan role - admin tidak bisa akses halaman profile user
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Admin tidak dapat mengakses halaman profil user.');
        }

        // Pastikan user hanya bisa edit profile sendiri
        if ($user->id != $id) {
            return redirect()->route('profile.edit', ['profile' => $user->id])
                ->with('error', 'Anda hanya bisa mengedit profil sendiri.');
        }

        // Mengambil data donasi berdasarkan user_id
        $donationData = Donation::selectRaw('payment_method, SUM(amount) as total_amount')
            ->where('user_id', $user->id)
            ->groupBy('payment_method')
            ->get();

        // Mengambil data donasi per hari
        $daily_sales = Donation::selectRaw('DATE(donation_date) as date, SUM(amount) as total')
            ->where('user_id', $user->id)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Persiapkan data untuk chart
        $chart_data = [
            'daily_sales' => [
                'labels' => $daily_sales->pluck('date')->map(fn($date) => Carbon::parse($date)->format('M d'))->toArray(),
                'data' => $daily_sales->pluck('total')->toArray()
            ],
            'payment_method_sales' => [
                'labels' => $donationData->pluck('payment_method')->toArray(),
                'data' => $donationData->pluck('total_amount')->toArray()
            ]
        ];

        // Mengirimkan data ke view menggunakan compact
        return view('profile', compact('user', 'chart_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Pastikan user hanya bisa update profile sendiri
        if ($user->id != $id) {
            return redirect()->route('profile.edit', ['profile' => $user->id])
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
            // Pastikan direktori ada
            if (!file_exists(public_path('uploads/profile_pictures'))) {
                mkdir(public_path('uploads/profile_pictures'), 0755, true);
            }

            // Hapus gambar lama jika ada
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $image->getClientOriginalName());
        
            try {
                $image->move(public_path('uploads/profile_pictures'), $imageName);
                $user->image = 'uploads/profile_pictures/' . $imageName;
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Gagal mengupload gambar.']);
            }
        }

        // Jika password baru diisi, cek current password
        if (!empty($validatedData['password'])) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Kata sandi lama tidak sesuai.']);
            }

            // Jika valid, ubah password
            $user->password = Hash::make($validatedData['password']);
        }

        // Update nama dan email
        $user->nama = $validatedData['nama'];
        $user->email = $validatedData['email'];

        // Simpan perubahan ke database
        $user->save();

        // Redirect ke halaman edit profil dengan pesan sukses
        return redirect()->route('profile.edit', ['profile' => $user->id])
            ->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
