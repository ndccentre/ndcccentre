<?php

namespace App\Filament\Pages;

use App\Models\Subscriber;
use App\Services\NotifySubscribers;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SendNotification extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $title = 'Send Notification';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-paper-airplane';
    protected static string|\UnitEnum|null $navigationGroup = 'Content';
    protected string $view = 'filament.pages.send-notification';

    public ?array $data = [];

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Compose Notification')
                ->description('Send an email to all ' . Subscriber::active()->count() . ' active subscribers.')
                ->schema([
                    Forms\Components\TextInput::make('subject')
                        ->required()
                        ->label('Email Subject')
                        ->placeholder('e.g. New Scripture of the Week'),
                    Forms\Components\TextInput::make('heading')
                        ->required()
                        ->label('Heading')
                        ->placeholder('e.g. This Week\'s Scripture'),
                    Forms\Components\Textarea::make('body')
                        ->required()
                        ->label('Message Body')
                        ->rows(6)
                        ->placeholder('Write your message here...'),
                    Forms\Components\TextInput::make('button_text')
                        ->label('Button Text (optional)')
                        ->placeholder('e.g. Read More, Watch Now'),
                    Forms\Components\TextInput::make('button_url')
                        ->label('Button URL (optional)')
                        ->url()
                        ->placeholder('https://ndpccenter.co.tz/...'),
                ]),
        ])->statePath('data');
    }

    public function send(): void
    {
        $data = $this->form->getState();

        $count = NotifySubscribers::send(
            $data['subject'],
            $data['heading'],
            $data['body'],
            $data['button_text'] ?? null,
            $data['button_url'] ?? null,
        );

        Notification::make()
            ->title("Notification sent to {$count} subscribers!")
            ->success()
            ->send();

        $this->form->fill([]);
    }
}
