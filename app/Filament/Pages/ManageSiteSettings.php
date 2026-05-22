<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $title = 'Site Settings';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string|\UnitEnum|null $navigationGroup = 'Settings';
    protected string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'contact_address' => SiteSetting::get('contact_address'),
            'contact_phone' => SiteSetting::get('contact_phone'),
            'contact_whatsapp' => SiteSetting::get('contact_whatsapp'),
            'contact_email' => SiteSetting::get('contact_email'),
            'service_times' => SiteSetting::get('service_times'),
            'mpesa_number' => SiteSetting::get('mpesa_number'),
            'bank_name' => SiteSetting::get('bank_name'),
            'account_name' => SiteSetting::get('account_name'),
            'account_number' => SiteSetting::get('account_number'),
            'show_mpesa' => SiteSetting::get('show_mpesa', 'true'),
            'show_bank' => SiteSetting::get('show_bank', 'true'),
            'radio_stream_url' => SiteSetting::get('radio_stream_url'),
            'radio_is_live' => SiteSetting::get('radio_is_live', 'false'),
            'radio_current_program' => SiteSetting::get('radio_current_program'),
            'social_youtube' => SiteSetting::get('social_youtube'),
            'social_facebook' => SiteSetting::get('social_facebook'),
            'social_instagram' => SiteSetting::get('social_instagram'),
            'social_instagram_church' => SiteSetting::get('social_instagram_church'),
            'social_tiktok' => SiteSetting::get('social_tiktok'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Page Images')
                ->description('Upload images for the homepage hero section and about page.')
                ->schema([
                    Forms\Components\FileUpload::make('hero_image')
                        ->label('Homepage Hero Image')
                        ->image()
                        ->disk('public')
                        ->directory('site-images')
                        ->visibility('public')
                        ->helperText('Large background image for the homepage hero section'),
                    Forms\Components\FileUpload::make('about_image')
                        ->label('About Page Image')
                        ->image()
                        ->disk('public')
                        ->directory('site-images')
                        ->visibility('public')
                        ->helperText('Image for the About Us page'),
                ])->columns(2),

            Forms\Components\Section::make('Contact Information')->schema([
                Forms\Components\TextInput::make('contact_address')->label('Address'),
                Forms\Components\TextInput::make('contact_phone')->label('Phone'),
                Forms\Components\TextInput::make('contact_whatsapp')->label('WhatsApp Number'),
                Forms\Components\TextInput::make('contact_email')->label('Email'),
                Forms\Components\Textarea::make('service_times')->label('Service Times')->rows(3),
            ])->columns(2),

            Forms\Components\Section::make('Giving / Donations')->schema([
                Forms\Components\TextInput::make('mpesa_number')->label('M-Pesa Number'),
                Forms\Components\TextInput::make('bank_name')->label('Bank Name'),
                Forms\Components\TextInput::make('account_name')->label('Account Name'),
                Forms\Components\TextInput::make('account_number')->label('Account Number'),
                Forms\Components\Select::make('show_mpesa')->options(['true' => 'Yes', 'false' => 'No'])->label('Show M-Pesa Section'),
                Forms\Components\Select::make('show_bank')->options(['true' => 'Yes', 'false' => 'No'])->label('Show Bank Section'),
            ])->columns(2),

            Forms\Components\Section::make('Radio Configuration')->schema([
                Forms\Components\TextInput::make('radio_stream_url')->label('Stream URL'),
                Forms\Components\Select::make('radio_is_live')->options(['true' => 'Live', 'false' => 'Off Air'])->label('Radio Status'),
                Forms\Components\TextInput::make('radio_current_program')->label('Current Program'),
            ])->columns(2),

            Forms\Components\Section::make('Social Media')->schema([
                Forms\Components\TextInput::make('social_youtube')->label('YouTube URL'),
                Forms\Components\TextInput::make('social_facebook')->label('Facebook URL'),
                Forms\Components\TextInput::make('social_instagram')->label('Instagram (Apostle)'),
                Forms\Components\TextInput::make('social_instagram_church')->label('Instagram (Church)'),
                Forms\Components\TextInput::make('social_tiktok')->label('TikTok URL'),
            ])->columns(2),
        ])->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                // FileUpload returns array, store the first file path
                $value = !empty($value) ? reset($value) : '';
            }
            SiteSetting::set($key, $value ?? '');
        }

        Notification::make()->title('Settings saved successfully.')->success()->send();
    }
}
