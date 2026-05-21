<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sermon extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title_en',
        'title_sw',
        'speaker',
        'scripture',
        'series',
        'description_en',
        'description_sw',
        'youtube_url',
        'youtube_video_id',
        'video_type',
        'video_source',
        'view_count',
        'is_live_now',
        'thumbnail_url',
        'audio_url',
        'duration',
        'language',
        'preached_at',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'preached_at' => 'date',
            'is_published' => 'boolean',
            'is_live_now' => 'boolean',
            'view_count' => 'integer',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')->singleFile();
        $this->addMediaCollection('audio')->singleFile();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeYoutube(Builder $query): Builder
    {
        return $query->where('video_source', 'youtube');
    }

    public function scopeManual(Builder $query): Builder
    {
        return $query->where('video_source', 'manual');
    }

    /**
     * Get the embed URL for this sermon's video.
     */
    public function getEmbedUrlAttribute(): ?string
    {
        if ($this->youtube_video_id) {
            return "https://www.youtube.com/embed/{$this->youtube_video_id}";
        }
        if ($this->youtube_url) {
            preg_match('/(?:v=|youtu\.be\/|embed\/)([a-zA-Z0-9_-]{11})/', $this->youtube_url, $m);
            if (!empty($m[1])) {
                return "https://www.youtube.com/embed/{$m[1]}";
            }
        }
        return null;
    }

    /**
     * Get the thumbnail URL, falling back to YouTube default.
     */
    public function getThumbnailAttribute(): ?string
    {
        if ($this->thumbnail_url) {
            return $this->thumbnail_url;
        }
        if ($this->youtube_video_id) {
            return "https://img.youtube.com/vi/{$this->youtube_video_id}/maxresdefault.jpg";
        }
        return null;
    }
}
