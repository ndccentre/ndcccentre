<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScriptureOfWeek extends Model
{
    protected $table = 'scripture_of_week';

    protected $fillable = [
        'verse_en',
        'verse_sw',
        'reference',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public static function current(): ?self
    {
        return static::where('is_active', true)->latest()->first();
    }
}
