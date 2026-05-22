<?php

namespace App\Filament\Pages;

use App\Models\ScriptureOfWeek;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ManageScripture extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $title = 'Scripture of the Week';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-book-open';
    protected static string|\UnitEnum|null $navigationGroup = 'Settings';
    protected string $view = 'filament.pages.manage-scripture';

    public ?array $data = [];

    public function mount(): void
    {
        $current = ScriptureOfWeek::current();

        $this->form->fill([
            'verse_en' => $current?->verse_en,
            'verse_sw' => $current?->verse_sw,
            'reference' => $current?->reference,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Scripture of the Week')->schema([
                Forms\Components\Textarea::make('verse_en')->required()->label('Verse (English)')->rows(3),
                Forms\Components\Textarea::make('verse_sw')->required()->label('Verse (Swahili)')->rows(3),
                Forms\Components\TextInput::make('reference')->required()->placeholder('e.g. Romans 1:16'),
            ]),
        ])->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        ScriptureOfWeek::query()->update(['is_active' => false]);

        ScriptureOfWeek::create([
            'verse_en' => $data['verse_en'],
            'verse_sw' => $data['verse_sw'],
            'reference' => $data['reference'],
            'is_active' => true,
        ]);

        // Notify subscribers
        \App\Services\NotifySubscribers::send(
            'Scripture of the Week — ' . $data['reference'],
            'Scripture of the Week',
            $data['verse_en'] . "\n\n— " . $data['reference'],
            'Visit Website',
            url('/en')
        );

        Notification::make()->title('Scripture of the Week updated & subscribers notified.')->success()->send();
    }
}
