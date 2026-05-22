<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscriber extends Model
{
    protected $fillable = ['email', 'name', 'token', 'is_active', 'verified_at'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'verified_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($subscriber) {
            $subscriber->token = $subscriber->token ?: Str::random(32);
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
