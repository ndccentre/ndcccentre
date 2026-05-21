<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class YouTubeSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'youtube_channel_id' => 'UC_nLmSKUvvSW4JyENg444gA',
            'youtube_channel_handle' => '@ApostleMathayonnko',
            'youtube_channel_url' => 'https://www.youtube.com/@ApostleMathayonnko',
            'youtube_api_key' => '',
            'youtube_auto_import' => '1',
            'youtube_live_video_id' => '',
            'youtube_is_live' => '0',
            'youtube_rss_url' => 'https://www.youtube.com/feeds/videos.xml?channel_id=UC_nLmSKUvvSW4JyENg444gA',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $this->command->info('YouTube settings seeded successfully.');
    }
}
