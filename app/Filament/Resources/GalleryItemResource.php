<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryItemResource\Pages;
use App\Models\GalleryItem;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;

    public static function getNavigationIcon(): string|null
    {
        return 'heroicon-o-photo';
    }

    public static function getNavigationLabel(): string
    {
        return 'Media Library';
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
            Forms\Components\TextInput::make('title')->required()->label('Title / Caption'),
            Forms\Components\Select::make('category')->options([
                'hero' => 'Hero / Homepage',
                'about' => 'About Us',
                'events' => 'Events',
                'foundation' => 'Foundation',
                'gallery' => 'General Gallery',
            ])->required()->label('Category'),
            Forms\Components\FileUpload::make('image_path')
                ->label('Image')
                ->image()
                ->disk('public')
                ->directory('media-library')
                ->visibility('public')
                ->required()
                ->imageEditor(),
            Forms\Components\Textarea::make('description')->label('Description')->rows(2),
            Forms\Components\Toggle::make('is_active')->default(true)->label('Active'),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0)->label('Sort Order'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')->disk('public')->label('Image')->height(60),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->badge()->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Active'),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('category')->options([
                    'hero' => 'Hero / Homepage',
                    'about' => 'About Us',
                    'events' => 'Events',
                    'foundation' => 'Foundation',
                    'gallery' => 'General Gallery',
                ]),
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
            'index' => Pages\ListGalleryItems::route('/'),
            'create' => Pages\CreateGalleryItem::route('/create'),
            'edit' => Pages\EditGalleryItem::route('/{record}/edit'),
        ];
    }
}
