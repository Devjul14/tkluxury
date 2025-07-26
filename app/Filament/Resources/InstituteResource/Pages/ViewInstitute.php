<?php

namespace App\Filament\Resources\InstituteResource\Pages;

use App\Filament\Resources\InstituteResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewInstitute extends ViewRecord
{
    protected static string $resource = InstituteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Basic Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Institute Name'),
                        Infolists\Components\TextEntry::make('code')
                            ->label('Institute Code'),
                        Infolists\Components\TextEntry::make('description')
                            ->markdown()
                            ->columnSpanFull(),
                    ])->columns(2),

                Infolists\Components\Section::make('Contact Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('contact_email')
                            ->label('Email'),
                        Infolists\Components\TextEntry::make('contact_phone')
                            ->label('Phone'),
                        Infolists\Components\TextEntry::make('website')
                            ->label('Website')
                            ->url(fn ($record) => $record->website),
                    ])->columns(3),

                Infolists\Components\Section::make('Address')
                    ->schema([
                        Infolists\Components\TextEntry::make('address')
                            ->label('Full Address'),
                        Infolists\Components\TextEntry::make('city')
                            ->label('City'),
                        Infolists\Components\TextEntry::make('state')
                            ->label('State'),
                        Infolists\Components\TextEntry::make('country')
                            ->label('Country'),
                        Infolists\Components\TextEntry::make('postal_code')
                            ->label('Postal Code'),
                    ])->columns(2),

                Infolists\Components\Section::make('Location')
                    ->schema([
                        Infolists\Components\TextEntry::make('latitude')
                            ->label('Latitude'),
                        Infolists\Components\TextEntry::make('longitude')
                            ->label('Longitude'),
                    ])->columns(2),

                Infolists\Components\Section::make('Settings')
                    ->schema([
                        Infolists\Components\ImageEntry::make('logo')
                            ->label('Logo')
                            ->circular(),
                        Infolists\Components\TextEntry::make('partnership_status')
                            ->label('Partnership Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'active' => 'success',
                                'pending' => 'warning',
                                'inactive' => 'danger',
                            }),
                        Infolists\Components\TextEntry::make('is_active')
                            ->label('Active Status')
                            ->formatStateUsing(fn ($state) => $state ? 'Active' : 'Inactive')
                            ->icon(fn ($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn ($state) => $state ? 'success' : 'danger'),
                    ])->columns(3),

                Infolists\Components\Section::make('Statistics')
                    ->schema([
                        Infolists\Components\TextEntry::make('properties_count')
                            ->label('Total Properties')
                            ->state(fn ($record) => $record->properties()->count()),
                        Infolists\Components\TextEntry::make('student_profiles_count')
                            ->label('Total Students')
                            ->state(fn ($record) => $record->studentProfiles()->count()),
                        Infolists\Components\TextEntry::make('contract_templates_count')
                            ->label('Contract Templates')
                            ->state(fn ($record) => $record->contractTemplates()->count()),
                    ])->columns(3),
            ]);
    }
} 