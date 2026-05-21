<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'request',
        'is_public',
        'is_approved',
    ];

    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
            'is_approved' => 'boolean',
        ];
    }
}
