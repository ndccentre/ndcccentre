<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrayerRequestResource\Pages;
use App\Models\PrayerRequest;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PrayerRequestResource extends Resource
{
    protected static ?string $model = PrayerRequest::class;

    public static function getNavigationIcon(): string|null
    {
        return 'heroicon-o-hand-raised';
    }

    public static function getNavigationGroup(): string|null
    {
        return 'Content';
    }

    public static function getNavigationSort(): ?int
    {
        return 5;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('email')->email(),
            Forms\Components\Textarea::make('request')->required()->rows(4),
            Forms\Components\Toggle::make('is_public')->label('Public'),
            Forms\Components\Toggle::make('is_approved')->label('Approved'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('request')->limit(50),
                Tables\Columns\IconColumn::make('is_public')->boolean()->label('Public'),
                Tables\Columns\IconColumn::make('is_approved')->boolean()->label('Approved'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_approved'),
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
            'index' => Pages\ListPrayerRequests::route('/'),
            'edit' => Pages\EditPrayerRequest::route('/{record}/edit'),
        ];
    }
}
