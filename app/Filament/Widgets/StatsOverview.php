<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\PrayerRequest;
use App\Models\Sermon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Sermons', Sermon::count())
                ->description('Videos in library')
                ->icon('heroicon-o-microphone')
                ->color('primary'),
            Stat::make('YouTube Videos', Sermon::where('video_source', 'youtube')->count())
                ->description('Imported from YouTube')
                ->icon('heroicon-o-play')
                ->color('success'),
            Stat::make('Upcoming Events', Event::where('is_published', true)->where('starts_at', '>=', now())->count())
                ->description('Published events')
                ->icon('heroicon-o-calendar-days')
                ->color('info'),
            Stat::make('Prayer Requests', PrayerRequest::count())
                ->description('Total received')
                ->icon('heroicon-o-heart')
                ->color('warning'),
        ];
    }
}
