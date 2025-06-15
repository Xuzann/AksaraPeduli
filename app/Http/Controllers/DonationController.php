<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu untuk berdonasi.');
        }

        // Validate the request
        $request->validate([
            'amount' => 'required|numeric|min:10000', // Ubah minimum menjadi 10000
            'payment_method' => 'required|string|in:gopay,shopeepay,ovo,dana,bank_transfer,credit_card', // Perbaiki payment methods
            'review_text' => 'nullable|string|max:1000', // Ubah menjadi nullable
            'campaign_id' => 'required|exists:campaigns,campaign_id',
        ], [
            'amount.min' => 'Jumlah donasi minimal Rp 10.000',
            'amount.required' => 'Jumlah donasi wajib diisi',
            'amount.numeric' => 'Jumlah donasi harus berupa angka',
            'payment_method.required' => 'Silakan pilih metode pembayaran',
            'payment_method.in' => 'Metode pembayaran tidak valid',
            'campaign_id.exists' => 'Kampanye tidak ditemukan',
        ]);

        // Check if campaign exists and is not expired
        $campaign = Campaign::where('campaign_id', $request->campaign_id)->firstOrFail();
        $deadline = Carbon::parse($campaign->deadline);
        
        if (Carbon::now()->greaterThan($deadline)) {
            return redirect()->back()->with('error', 'Maaf, masa donasi untuk kampanye ini telah berakhir pada ' . $deadline->format('d M Y') . '.');
        }

        try {
            // Penyimpanan data donasi
            Donation::create([
                'user_id' => Auth::id(),
                'campaign_id' => $request->campaign_id,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'review_text' => $request->review_text ?? '', // Handle nullable review_text
                'donation_date' => Carbon::now(),
            ]);

            // Update campaign collected amount
            $campaign->collected_amount += $request->amount;
            $campaign->save();

            return redirect()->back()->with('success', 'Terima kasih! Donasi Anda sebesar Rp ' . number_format($request->amount, 0, ',', '.') . ' berhasil dikirim.');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses donasi. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
