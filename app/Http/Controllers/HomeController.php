<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 kampanye dengan target donasi tertinggi
        $campaigns = Campaign::orderBy('target_amount', 'desc')
            ->take(3)
            ->get();

        // Menambahkan progress dan informasi tambahan ke setiap kampanye dalam koleksi
        $campaigns = $campaigns->map(function ($campaign) {
            // Hitung progress
            $campaign->progress = $campaign->target_amount > 0
                ? min(($campaign->collected_amount / $campaign->target_amount) * 100, 100)
                : 0;

            // Tambahkan informasi deadline
            $deadline = Carbon::parse($campaign->deadline);
            $campaign->is_expired = $deadline->isPast();
            // PASTIKAN HASILNYA INTEGER
            $campaign->days_left = $campaign->is_expired ? 0 : (int) Carbon::now()->diffInDays($deadline);

            return $campaign;
        });

        // Mengirimkan data kampanye ke view
        return view('index', compact('campaigns'));
    }
}
