<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SermonResource\Pages;
use App\Models\Sermon;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SermonResource extends Resource
{
    protected static ?string $model = Sermon::class;

    public static function getNavigationIcon(): string|null
    {
        return 'heroicon-o-microphone';
    }

    public static function getNavigationGroup(): string|null
    {
        return 'Content';
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Section::make('Sermon Details')->schema([
                Forms\Components\TextInput::make('title_en')->required()->label('Title (English)'),
                Forms\Components\TextInput::make('title_sw')->required()->label('Title (Swahili)'),
                Forms\Components\TextInput::make('speaker'),
                Forms\Components\TextInput::make('scripture'),
                Forms\Components\TextInput::make('series'),
                Forms\Components\TextInput::make('duration')->placeholder('e.g. 45:00'),
                Forms\Components\Select::make('language')->options([
                    'both' => 'Both',
                    'en' => 'English',
                    'sw' => 'Swahili',
                ])->default('both'),
                Forms\Components\DatePicker::make('preached_at')->label('Date Preached'),
                Forms\Components\Toggle::make('is_published')->default(false),
            ])->columns(2),

            Forms\Components\Section::make('Media')->schema([
                Forms\Components\TextInput::make('youtube_url_input')
                    ->label('YouTube URL')
                    ->placeholder('https://www.youtube.com/watch?v=...')
                    ->helperText('Paste a YouTube video URL — thumbnail and ID will be set automatically')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (empty($state)) return;
                        preg_match('/(?:v=|youtu\.be\/|embed\/)([a-zA-Z0-9_-]{11})/', $state, $m);
                        if (!empty($m[1])) {
                            $videoId = $m[1];
                            $set('youtube_video_id', $videoId);
                            $set('youtube_url', $state);
                            $set('thumbnail_url', "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg");
                            $set('video_source', 'youtube');
                        }
                    })
                    ->dehydrated(false),
                Forms\Components\TextInput::make('youtube_url')->url()->label('YouTube URL (stored)'),
                Forms\Components\Hidden::make('youtube_video_id'),
                Forms\Components\Hidden::make('thumbnail_url'),
                Forms\Components\Hidden::make('video_source')->default('manual'),
                Forms\Components\TextInput::make('audio_url')->url()->label('Audio URL'),
                Forms\Components\Select::make('video_type')->options([
                    'manual' => 'Manual',
                    'sermon' => 'Sermon',
                    'short' => 'Short',
                    'live' => 'Live',
                ])->default('manual')->label('Video Type'),
                Forms\Components\Textarea::make('description_en')->label('Description (English)')->rows(3),
                Forms\Components\Textarea::make('description_sw')->label('Description (Swahili)')->rows(3),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_en')->searchable()->sortable()->label('Title'),
                Tables\Columns\TextColumn::make('speaker')->searchable(),
                Tables\Columns\TextColumn::make('scripture'),
                Tables\Columns\TextColumn::make('preached_at')->date()->sortable(),
                Tables\Columns\IconColumn::make('is_published')->boolean(),
            ])
            ->defaultSort('preached_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published'),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSermons::route('/'),
            'create' => Pages\CreateSermon::route('/create'),
            'edit' => Pages\EditSermon::route('/{record}/edit'),
        ];
    }
}
