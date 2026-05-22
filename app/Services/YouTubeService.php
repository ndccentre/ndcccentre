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
                $videoIds = [];

                foreach ($xml->entry as $entry) {
                    $ns = $entry->children('yt', true);
                    $media = $entry->children('media', true);
                    $videoId = (string) $ns->videoId;

                    $description = '';
                    if ($media && $media->group && $media->group->description) {
                        $description = (string) $media->group->description;
                    }

                    $videoIds[] = $videoId;
                    $videos[] = [
                        'video_id'     => $videoId,
                        'title'        => (string) $entry->title,
                        'description'  => $description,
                        'thumbnail'    => "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg",
                        'published_at' => date('Y-m-d', strtotime((string) $entry->published)),
                        'duration'     => 0,
                        'duration_str' => '',
                        'view_count'   => 0,
                        'type'         => 'sermon', // will be updated below
                        'embed_url'    => "https://www.youtube.com/embed/{$videoId}",
                        'watch_url'    => "https://www.youtube.com/watch?v={$videoId}",
                        'is_live_now'  => false,
                        'source'       => 'rss',
                    ];
                }

                // Detect Shorts by checking YouTube Shorts URL (HEAD request)
                $shortsMap = $this->detectShorts($videoIds);

                foreach ($videos as &$video) {
                    if (isset($shortsMap[$video['video_id']]) && $shortsMap[$video['video_id']]) {
                        $video['type'] = 'short';
                        $video['watch_url'] = "https://www.youtube.com/shorts/{$video['video_id']}";
                    } else {
                        $video['type'] = $this->detectTypeFromTitle($video['title'], $video['description']);
                    }
                }
                unset($video);

                return $videos;
            } catch (\Exception $e) {
                return [];
            }
        });
    }

    /**
     * Detect which videos are Shorts by checking the /shorts/ URL.
     * YouTube redirects /shorts/ID to /watch?v=ID if it's NOT a Short.
     */
    private function detectShorts(array $videoIds): array
    {
        $results = [];
        foreach ($videoIds as $videoId) {
            try {
                $response = Http::timeout(5)
                    ->withOptions(['allow_redirects' => false])
                    ->head("https://www.youtube.com/shorts/{$videoId}");
                // 200 = it's a Short, 303/302 = it's a regular video
                $results[$videoId] = $response->status() === 200;
            } catch (\Exception $e) {
                $results[$videoId] = false;
            }
        }
        return $results;
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

    /**
     * Detect video type from title/description in RSS mode (no duration available).
     */
    private function detectTypeFromTitle(string $title, string $description): string
    {
        $text = strtolower($title . ' ' . $description);

        // Detect Shorts
        if (str_contains($text, '#shorts') || str_contains($text, '#short') || str_contains($text, 'shorts')) {
            return 'short';
        }

        // Detect Live recordings
        if (str_contains($text, 'live') || str_contains($text, 'ibada') || str_contains($text, 'sunday service') || str_contains($text, 'moja kwa moja')) {
            return 'live';
        }

        return 'sermon';
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
