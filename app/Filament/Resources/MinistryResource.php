<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MinistryResource\Pages;
use App\Models\Ministry;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class MinistryResource extends Resource
{
    protected static ?string $model = Ministry::class;

    public static function getNavigationIcon(): string|null
    {
        return 'heroicon-o-user-group';
    }

    public static function getNavigationGroup(): string|null
    {
        return 'Content';
    }

    public static function getNavigationSort(): ?int
    {
        return 3;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('name_en')->required()->label('Name (English)'),
            Forms\Components\TextInput::make('name_sw')->required()->label('Name (Swahili)'),
            Forms\Components\Textarea::make('description_en')->label('Description (English)')->rows(3),
            Forms\Components\Textarea::make('description_sw')->label('Description (Swahili)')->rows(3),
            Forms\Components\TextInput::make('leader'),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_en')->searchable()->label('Name'),
                Tables\Columns\TextColumn::make('leader'),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
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
            'index' => Pages\ListMinistries::route('/'),
            'create' => Pages\CreateMinistry::route('/create'),
            'edit' => Pages\EditMinistry::route('/{record}/edit'),
        ];
    }
}
