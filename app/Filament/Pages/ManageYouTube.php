<?php

namespace App\Filament\Pages;

use App\Models\Sermon;
use App\Models\SiteSetting;
use App\Services\YouTubeService;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Artisan;

class ManageYouTube extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $title = 'YouTube Management';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-play';
    protected static string|\UnitEnum|null $navigationGroup = 'Content';
    protected string $view = 'filament.pages.manage-youtube';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'youtube_api_key' => SiteSetting::get('youtube_api_key'),
            'youtube_live_video_id' => SiteSetting::get('youtube_live_video_id'),
            'youtube_is_live' => SiteSetting::get('youtube_is_live', '0'),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('API Key Setup')
                ->description('Optional but recommended. Enables Shorts detection, view counts, and live stream auto-detection.')
                ->schema([
                    Forms\Components\TextInput::make('youtube_api_key')
                        ->label('YouTube API Key')
                        ->password()
                        ->revealable()
                        ->helperText('Get your key from console.cloud.google.com → APIs & Services → Credentials'),
                ]),

            Section::make('Live Stream Control')
                ->schema([
                    Forms\Components\TextInput::make('youtube_live_video_id')
                        ->label('Live Video ID')
                        ->placeholder('e.g. dQw4w9WgXcQ')
                        ->helperText('Manually set a live video ID to force the live widget to appear'),
                    Forms\Components\Select::make('youtube_is_live')
                        ->label('Force Live Status')
                        ->options(['0' => 'Off Air', '1' => 'Live'])
                        ->helperText('Manually toggle the live status on/off'),
                ]),
        ])->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        SiteSetting::set('youtube_api_key', $data['youtube_api_key'] ?? '');
        SiteSetting::set('youtube_live_video_id', $data['youtube_live_video_id'] ?? '');
        SiteSetting::set('youtube_is_live', $data['youtube_is_live'] ?? '0');

        (new YouTubeService())->clearCache();

        Notification::make()->title('YouTube settings saved.')->success()->send();
    }

    public function importVideos(): void
    {
        Artisan::call('youtube:import');
        $output = Artisan::output();

        Notification::make()
            ->title('Import Complete')
            ->body(trim($output))
            ->success()
            ->send();
    }

    public function checkLive(): void
    {
        Artisan::call('youtube:check-live');
        $output = Artisan::output();

        $this->form->fill([
            'youtube_api_key' => SiteSetting::get('youtube_api_key'),
            'youtube_live_video_id' => SiteSetting::get('youtube_live_video_id'),
            'youtube_is_live' => SiteSetting::get('youtube_is_live', '0'),
        ]);

        Notification::make()
            ->title('Live Check Complete')
            ->body(trim($output))
            ->success()
            ->send();
    }

    public function getChannelId(): string
    {
        return SiteSetting::get('youtube_channel_id', 'UC_nLmSKUvvSW4JyENg444gA');
    }

    public function getChannelHandle(): string
    {
        return SiteSetting::get('youtube_channel_handle', '@ApostleMathayonnko');
    }

    public function getLastImport(): string
    {
        return SiteSetting::get('youtube_last_import', 'Never');
    }

    public function getMode(): string
    {
        $apiKey = SiteSetting::get('youtube_api_key');
        return !empty($apiKey) ? 'api' : 'rss';
    }

    public function getVideoCount(): int
    {
        return Sermon::where('video_source', 'youtube')->count();
    }

    public function getIsLive(): bool
    {
        return SiteSetting::get('youtube_is_live') === '1';
    }
}
