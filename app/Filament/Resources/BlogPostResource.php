<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    public static function getNavigationIcon(): string|null
    {
        return 'heroicon-o-newspaper';
    }

    public static function getNavigationLabel(): string
    {
        return 'Blog / News';
    }

    public static function getNavigationGroup(): string|null
    {
        return 'Content';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title')->required()->label('Title (English)')
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
            Forms\Components\TextInput::make('title_sw')->label('Title (Swahili)'),
            Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('category')->options([
                'news' => 'Church News',
                'testimony' => 'Testimony',
                'sermon-discussion' => 'Sermon Discussion',
                'foundation' => 'Foundation News',
                'church-news' => 'Announcements',
            ])->required()->default('news'),
            Forms\Components\Textarea::make('excerpt')->label('Excerpt (English)')->rows(2),
            Forms\Components\Textarea::make('excerpt_sw')->label('Excerpt (Swahili)')->rows(2),
            Forms\Components\RichEditor::make('body')->required()->label('Content (English)')->columnSpanFull(),
            Forms\Components\RichEditor::make('body_sw')->label('Content (Swahili)')->columnSpanFull(),
            Forms\Components\FileUpload::make('featured_image')->image()->disk('public')->directory('blog')->visibility('public')->label('Featured Image'),
            Forms\Components\TextInput::make('meta_title')->label('SEO Title'),
            Forms\Components\Textarea::make('meta_description')->label('SEO Description')->rows(2),
            Forms\Components\Hidden::make('user_id')->default(fn () => auth()->id()),
            Forms\Components\Toggle::make('is_published')->default(false),
            Forms\Components\DateTimePicker::make('published_at')->label('Publish Date')->default(now()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')->disk('public')->height(50)->label('Image'),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable()->limit(40),
                Tables\Columns\TextColumn::make('category')->badge()->sortable(),
                Tables\Columns\TextColumn::make('views')->sortable(),
                Tables\Columns\IconColumn::make('is_published')->boolean(),
                Tables\Columns\TextColumn::make('published_at')->date()->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([Actions\DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
