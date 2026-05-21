<?php

namespace App\Console\Commands;

use App\Models\Sermon;
use App\Models\SiteSetting;
use App\Services\YouTubeService;
use Illuminate\Console\Command;

class ImportYouTubeVideos extends Command
{
    protected $signature = 'youtube:import';
    protected $description = 'Import videos from YouTube channel into sermons';

    public function handle(): int
    {
        $service = new YouTubeService();
        $videos = $service->getVideos(50);

        if (empty($videos)) {
            $this->warn('No videos retrieved from YouTube. Check channel ID or network connection.');
            return self::FAILURE;
        }

        $created = 0;
        $updated = 0;

        foreach ($videos as $video) {
            $sermon = Sermon::where('youtube_video_id', $video['video_id'])->first();

            $data = [
                'title_en'         => $video['title'],
                'title_sw'         => $video['title'], // Same title, can be edited later
                'description_en'   => $video['description'],
                'description_sw'   => $video['description'],
                'youtube_url'      => $video['watch_url'],
                'youtube_video_id' => $video['video_id'],
                'video_type'       => $video['type'],
                'video_source'     => 'youtube',
                'view_count'       => $video['view_count'],
                'is_live_now'      => $video['is_live_now'],
                'thumbnail_url'    => $video['thumbnail'],
                'preached_at'      => $video['published_at'],
                'duration'         => $video['duration_str'] ?: null,
                'is_published'     => true,
                'speaker'          => 'Apostle Mathayo Nnko',
            ];

            if ($sermon) {
                $sermon->update($data);
                $updated++;
            } else {
                Sermon::create($data);
                $created++;
            }
        }

        SiteSetting::set('youtube_last_import', now()->toDateTimeString());

        $this->info("Imported {$created} new videos, updated {$updated} existing.");
        return self::SUCCESS;
    }
}
