<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    /**
     * Display a listing of all campaigns.
     */
    public function index(Request $request)
    {
        // Ambil parameter sorting dari request
        $sort = $request->get('sort', 'newest');
        
        // Query dasar untuk kampanye
        $query = Campaign::withSum('donations', 'amount')
            ->withCount('donations');
        
        // Terapkan sorting berdasarkan parameter
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'highest_target':
                $query->orderBy('target_amount', 'desc');
                break;
            case 'lowest_target':
                $query->orderBy('target_amount', 'asc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }
        
        // Ambil kampanye dengan pagination
        $campaigns = $query->paginate(12);
        
        // Append sort parameter ke pagination links
        $campaigns->appends(['sort' => $sort]);

        // Tambahkan informasi tambahan untuk setiap kampanye
        $campaigns->getCollection()->transform(function ($campaign) {
        $campaign->is_expired = Carbon::parse($campaign->deadline)->isPast();
        $campaign->total_donated = $campaign->donations_sum_amount ?? 0;
        $campaign->percentage = $campaign->target_amount > 0 
            ? min(100, ($campaign->total_donated / $campaign->target_amount) * 100) 
            : 0;
        $campaign->is_target_reached = $campaign->total_donated >= $campaign->target_amount;
        
        if ($campaign->is_expired) {
            $campaign->days_left = 0;
            $campaign->days_passed = (int) Carbon::now()->diffInDays(Carbon::parse($campaign->deadline));
        } else {
            $campaign->days_left = (int) Carbon::now()->diffInDays(Carbon::parse($campaign->deadline));
            $campaign->days_passed = 0;
        }
        
        return $campaign;
    });

    return view('campaigns.CampaignsList', compact('campaigns', 'sort'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $campaign = Campaign::where('campaign_id', $id)->firstOrFail();

        // Calculate progress for the campaign
        $campaign->progress = $campaign->target_amount > 0
            ? min(($campaign->collected_amount / $campaign->target_amount) * 100, 100)
            : 0;

        $today = Carbon::now();
        $deadline = Carbon::parse($campaign->deadline);

        // Check if campaign is expired
        $campaign->is_expired = $today->greaterThan($deadline);
        
        // Calculate remaining days or days passed
        if ($campaign->is_expired) {
            $sisaHari = 0;
            $campaign->days_passed = $today->diffInDays($deadline);
        } else {
            $sisaHari = $today->diffInDays($deadline);
            $campaign->days_passed = 0;
        }

        // Ensure sisaHari is integer
        $sisaHari = (int) $sisaHari;

        // Check if target is reached
        $campaign->is_target_reached = $campaign->collected_amount >= $campaign->target_amount;

        // Get recent donations for this campaign
        $recentDonations = Donation::where('campaign_id', $campaign->campaign_id)
            ->with('user')
            ->latest('donation_date')
            ->take(5)
            ->get();

        return view('campaigns', compact('campaign', 'sisaHari', 'recentDonations'));
    }

    /**
     * Check if campaign is still accepting donations
     */
    public function canAcceptDonations(Campaign $campaign)
    {
        return !Carbon::parse($campaign->deadline)->isPast();
    }
}
