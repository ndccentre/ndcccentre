<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ministry;
use App\Models\PrayerRequest;
use App\Models\ScriptureOfWeek;
use App\Models\Sermon;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $scripture = ScriptureOfWeek::current();
        $upcomingEvents = Event::where('is_published', true)
            ->where('starts_at', '>=', now())
            ->orderBy('starts_at')
            ->take(3)
            ->get();

        return view('pages.home', compact('scripture', 'upcomingEvents'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function sermons(Request $request)
    {
        // Get YouTube videos (auto-selects RSS or API mode)
        $youtubeService = new \App\Services\YouTubeService();
        $allVideos = collect($youtubeService->getVideos(50));

        // Separate into types
        $youtubeSermons = $allVideos->where('type', 'sermon')->values();
        $shorts = $allVideos->where('type', 'short')->values();
        $lives = $allVideos->where('type', 'live')->values();

        // Also get manual DB sermons
        $manualSermons = Sermon::where('video_source', 'manual')
            ->where('is_published', true)
            ->when($request->search, fn ($q, $s) => $q->where('title_en', 'like', "%{$s}%")->orWhere('title_sw', 'like', "%{$s}%"))
            ->orderByDesc('preached_at')
            ->get();

        // Live stream status
        $isLive = SiteSetting::get('youtube_is_live') === '1';
        $liveVideoId = SiteSetting::get('youtube_live_video_id');

        return view('pages.sermons', compact(
            'youtubeSermons',
            'shorts',
            'lives',
            'manualSermons',
            'isLive',
            'liveVideoId'
        ));
    }

    public function radio()
    {
        $streamUrl = SiteSetting::get('radio_stream_url');
        $isLive = SiteSetting::get('radio_is_live', 'false') === 'true';
        $currentProgram = SiteSetting::get('radio_current_program');

        return view('pages.radio', compact('streamUrl', 'isLive', 'currentProgram'));
    }

    public function events()
    {
        $events = Event::where('is_published', true)
            ->orderByDesc('starts_at')
            ->paginate(12);

        return view('pages.events', compact('events'));
    }

    public function ministries()
    {
        $ministries = Ministry::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.ministries', compact('ministries'));
    }

    public function foundation()
    {
        return view('pages.foundation');
    }

    public function give()
    {
        $mpesaNumber = SiteSetting::get('mpesa_number');
        $bankName = SiteSetting::get('bank_name');
        $accountName = SiteSetting::get('account_name');
        $accountNumber = SiteSetting::get('account_number');
        $showMpesa = SiteSetting::get('show_mpesa', 'true') === 'true';
        $showBank = SiteSetting::get('show_bank', 'true') === 'true';

        return view('pages.give', compact('mpesaNumber', 'bankName', 'accountName', 'accountNumber', 'showMpesa', 'showBank'));
    }

    public function prayer()
    {
        $publicRequests = PrayerRequest::where('is_public', true)
            ->where('is_approved', true)
            ->latest()
            ->take(20)
            ->get();

        return view('pages.prayer', compact('publicRequests'));
    }

    public function prayerStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'request' => 'required|string|max:2000',
            'is_public' => 'boolean',
        ]);

        $validated['is_public'] = $request->boolean('is_public');

        PrayerRequest::create($validated);

        return back()->with('success', true);
    }

    public function contact()
    {
        $address = SiteSetting::get('contact_address');
        $phone = SiteSetting::get('contact_phone');
        $whatsapp = SiteSetting::get('contact_whatsapp');
        $email = SiteSetting::get('contact_email');
        $serviceTimes = SiteSetting::get('service_times');

        return view('pages.contact', compact('address', 'phone', 'whatsapp', 'email', 'serviceTimes'));
    }
}
