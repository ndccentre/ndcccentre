<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class YouTubeService
{
    private string $channelId = 'UC_nLmSKUvvSW4JyENg444gA';
    private string $rssUrl = 'https://www.youtube.com/feeds/videos.xml?channel_id=UC_nLmSKUvvSW4JyENg444gA';
    private string $apiBase = 'https://www.googleapis.com/youtube/v3';
    private ?string $apiKey;

    public function __construct()
    {
        $storedId = SiteSetting::get('youtube_channel_id');
        if (!empty($storedId)) {
            $this->channelId = $storedId;
            $this->rssUrl = "https://www.youtube.com/feeds/videos.xml?channel_id={$this->channelId}";
        }
        $this->apiKey = SiteSetting::get('youtube_api_key') ?: null;
    }

    public function hasApiKey(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Primary method — auto-selects RSS or API based on configuration.
     */
    public function getVideos(int $max = 50): array
    {
        if ($this->hasApiKey()) {
            return $this->getVideosViaApi($max);
        }
        return $this->getVideosViaRss();
    }

    /**
     * RSS Mode — no API key needed, works immediately.
     */
    public function getVideosViaRss(): array
    {
        return Cache::remember('youtube_rss_' . $this->channelId, 3600, function () {
            try {
                $response = Http::timeout(10)->get($this->rssUrl);
                if (!$response->ok()) {
                    return [];
                }

                $xml = simplexml_load_string($response->body());
                if (!$xml) {
                    return [];
                }

                $videos = [];
                foreach ($xml->entry as $entry) {
                    $ns = $entry->children('yt', true);
                    $media = $entry->children('media', true);
                    $videoId = (string) $ns->videoId;

                    $description = '';
                    if ($media && $media->group && $media->group->description) {
                        $description = (string) $media->group->description;
                    }

                    $videos[] = [
                        'video_id'     => $videoId,
                        'title'        => (string) $entry->title,
                        'description'  => $description,
                        'thumbnail'    => "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg",
                        'published_at' => date('Y-m-d', strtotime((string) $entry->published)),
                        'duration'     => 0,
                        'duration_str' => '',
                        'view_count'   => 0,
                        'type'         => 'sermon',
                        'embed_url'    => "https://www.youtube.com/embed/{$videoId}",
                        'watch_url'    => "https://www.youtube.com/watch?v={$videoId}",
                        'is_live_now'  => false,
                        'source'       => 'rss',
                    ];
                }
                return $videos;
            } catch (\Exception $e) {
                return [];
            }
        });
    }

    /**
     * API Mode — full details including duration, views, Shorts detection.
     */
    public function getVideosViaApi(int $max = 50): array
    {
        return Cache::remember('youtube_api_' . $this->channelId, 3600, function () use ($max) {
            try {
                // Step 1: Get uploads playlist ID
                $channelRes = Http::get("{$this->apiBase}/channels", [
                    'key'  => $this->apiKey,
                    'id'   => $this->channelId,
                    'part' => 'contentDetails,snippet,statistics',
                ])->json();

                $uploadsPlaylistId = $channelRes['items'][0]['contentDetails']['relatedPlaylists']['uploads'] ?? null;
                if (!$uploadsPlaylistId) {
                    return [];
                }

                // Step 2: Get video IDs from uploads playlist
                $playlistRes = Http::get("{$this->apiBase}/playlistItems", [
                    'key'        => $this->apiKey,
                    'playlistId' => $uploadsPlaylistId,
                    'part'       => 'contentDetails',
                    'maxResults' => $max,
                ])->json();

                $videoIds = collect($playlistRes['items'] ?? [])
                    ->pluck('contentDetails.videoId')
                    ->filter()
                    ->implode(',');

                if (!$videoIds) {
                    return [];
                }

                // Step 3: Get full video details
                $videosRes = Http::get("{$this->apiBase}/videos", [
                    'key'  => $this->apiKey,
                    'id'   => $videoIds,
                    'part' => 'snippet,contentDetails,statistics,liveStreamingDetails',
                ])->json();

                $videos = [];
                foreach ($videosRes['items'] ?? [] as $item) {
                    $videoId  = $item['id'];
                    $snippet  = $item['snippet'];
                    $details  = $item['contentDetails'];
                    $stats    = $item['statistics'] ?? [];
                    $liveDetails = $item['liveStreamingDetails'] ?? null;

                    $durationSec = $this->parseDuration($details['duration'] ?? 'PT0S');
                    $isShort     = $durationSec <= 60 || str_contains(strtolower($snippet['title'] . ' ' . ($snippet['description'] ?? '')), '#shorts');
                    $isLive      = $liveDetails !== null || ($snippet['liveBroadcastContent'] ?? '') === 'live';
                    $isLiveNow   = ($snippet['liveBroadcastContent'] ?? '') === 'live';

                    $type = 'sermon';
                    if ($isLiveNow || ($isLive && !$isShort)) {
                        $type = 'live';
                    }
                    if ($isShort) {
                        $type = 'short';
                    }

                    $videos[] = [
                        'video_id'     => $videoId,
                        'title'        => $snippet['title'],
                        'description'  => $snippet['description'] ?? '',
                        'thumbnail'    => $snippet['thumbnails']['maxres']['url']
                                          ?? $snippet['thumbnails']['high']['url']
                                          ?? "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg",
                        'published_at' => date('Y-m-d', strtotime($snippet['publishedAt'])),
                        'duration'     => $durationSec,
                        'duration_str' => $this->formatDuration($durationSec),
                        'view_count'   => (int) ($stats['viewCount'] ?? 0),
                        'type'         => $type,
                        'embed_url'    => "https://www.youtube.com/embed/{$videoId}",
                        'watch_url'    => "https://www.youtube.com/watch?v={$videoId}",
                        'is_live_now'  => $isLiveNow,
                        'source'       => 'api',
                    ];
                }
                return $videos;
            } catch (\Exception $e) {
                return [];
            }
        });
    }

    /**
     * Check if there's a current live stream on the channel.
     */
    public function getCurrentLiveStream(): ?string
    {
        if (!$this->hasApiKey()) {
            return null;
        }

        try {
            $res = Http::get("{$this->apiBase}/search", [
                'key'       => $this->apiKey,
                'channelId' => $this->channelId,
                'part'      => 'id',
                'eventType' => 'live',
                'type'      => 'video',
            ])->json();

            return $res['items'][0]['id']['videoId'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function parseDuration(string $duration): int
    {
        preg_match('/PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?/', $duration, $m);
        return (int) ($m[1] ?? 0) * 3600 + (int) ($m[2] ?? 0) * 60 + (int) ($m[3] ?? 0);
    }

    private function formatDuration(int $seconds): string
    {
        if ($seconds <= 0) {
            return '';
        }
        $h = intdiv($seconds, 3600);
        $m = intdiv($seconds % 3600, 60);
        $s = $seconds % 60;
        return $h > 0
            ? sprintf('%d:%02d:%02d', $h, $m, $s)
            : sprintf('%d:%02d', $m, $s);
    }

    public function clearCache(): void
    {
        Cache::forget('youtube_rss_' . $this->channelId);
        Cache::forget('youtube_api_' . $this->channelId);
    }
}
