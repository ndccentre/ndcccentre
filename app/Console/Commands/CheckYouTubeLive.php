<?php

namespace App\Console\Commands;

use App\Models\Sermon;
use App\Models\SiteSetting;
use App\Services\YouTubeService;
use Illuminate\Console\Command;

class CheckYouTubeLive extends Command
{
    protected $signature = 'youtube:check-live';
    protected $description = 'Check if the YouTube channel is currently live streaming';

    public function handle(): int
    {
        $service = new YouTubeService();

        if (!$service->hasApiKey()) {
            $this->info('No API key configured. Live detection requires YouTube Data API v3.');
            SiteSetting::set('youtube_is_live', '0');
            return self::SUCCESS;
        }

        $liveVideoId = $service->getCurrentLiveStream();

        if ($liveVideoId) {
            SiteSetting::set('youtube_live_video_id', $liveVideoId);
            SiteSetting::set('youtube_is_live', '1');
            $this->info("Channel is LIVE! Video ID: {$liveVideoId}");

            // Update sermon record if it exists
            Sermon::where('youtube_video_id', $liveVideoId)
                ->update(['is_live_now' => true, 'video_type' => 'live']);
        } else {
            // Mark all previously live sermons as no longer live
            Sermon::where('is_live_now', true)->update(['is_live_now' => false]);

            SiteSetting::set('youtube_live_video_id', '');
            SiteSetting::set('youtube_is_live', '0');
            $this->info('Channel is OFF AIR.');
        }

        return self::SUCCESS;
    }
}
