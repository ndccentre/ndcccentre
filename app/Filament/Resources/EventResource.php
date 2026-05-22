<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    public static function getNavigationIcon(): string|null
    {
        return 'heroicon-o-calendar-days';
    }

    public static function getNavigationGroup(): string|null
    {
        return 'Content';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title_en')->required()->label('Title (English)'),
            Forms\Components\TextInput::make('title_sw')->required()->label('Title (Swahili)'),
            Forms\Components\Textarea::make('description_en')->label('Description (English)')->rows(3),
            Forms\Components\Textarea::make('description_sw')->label('Description (Swahili)')->rows(3),
            Forms\Components\TextInput::make('location'),
            Forms\Components\DateTimePicker::make('starts_at')->required()->label('Start Date & Time'),
            Forms\Components\DateTimePicker::make('ends_at')->label('End Date & Time'),
            Forms\Components\FileUpload::make('featured_image')
                ->label('Featured Image')
                ->image()
                ->disk('public')
                ->directory('events')
                ->visibility('public')
                ->helperText('Image displayed on the frontend for this event'),
            Forms\Components\TextInput::make('button_text')
                ->label('Button Text')
                ->placeholder('e.g. Join Us, Register, Donate')
                ->helperText('Text for the action button on the event card'),
            Forms\Components\TextInput::make('button_url')
                ->label('Button Link (URL)')
                ->placeholder('https://...')
                ->url()
                ->helperText('Where the button links to (YouTube, donation page, etc.)'),
            Forms\Components\Toggle::make('is_published')->default(false)->label('Published'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')->disk('public')->label('Image')->height(50),
                Tables\Columns\TextColumn::make('title_en')->searchable()->label('Title'),
                Tables\Columns\TextColumn::make('starts_at')->dateTime('M d, Y H:i')->sortable()->label('Date'),
                Tables\Columns\TextColumn::make('location'),
                Tables\Columns\IconColumn::make('is_published')->boolean()->label('Published'),
            ])
            ->defaultSort('starts_at', 'desc')
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
