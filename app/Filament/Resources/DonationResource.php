<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Models\Donation;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;

    public static function getNavigationIcon(): string|null
    {
        return 'heroicon-o-currency-dollar';
    }

    public static function getNavigationGroup(): string|null
    {
        return 'Finance';
    }

    public static function getNavigationSort(): ?int
    {
        return 10;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('donor_name')->label('Donor Name'),
            Forms\Components\TextInput::make('amount')->numeric()->required(),
            Forms\Components\Select::make('currency')->options([
                'TZS' => 'TZS',
                'USD' => 'USD',
                'KES' => 'KES',
            ])->default('TZS'),
            Forms\Components\Select::make('category')->options([
                'tithe' => 'Tithe / Zaka',
                'offering' => 'Offering / Sadaka',
                'foundation' => 'Foundation',
                'building' => 'Building Fund / Ujenzi',
            ]),
            Forms\Components\TextInput::make('reference'),
            Forms\Components\Textarea::make('notes')->rows(2),
            Forms\Components\DatePicker::make('donated_at')->default(now()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('donor_name')->searchable(),
                Tables\Columns\TextColumn::make('amount')->money('TZS')->sortable(),
                Tables\Columns\TextColumn::make('category')->badge(),
                Tables\Columns\TextColumn::make('donated_at')->date()->sortable(),
            ])
            ->defaultSort('donated_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')->options([
                    'tithe' => 'Tithe',
                    'offering' => 'Offering',
                    'foundation' => 'Foundation',
                    'building' => 'Building Fund',
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
            'index' => Pages\ListDonations::route('/'),
            'create' => Pages\CreateDonation::route('/create'),
            'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }
}
