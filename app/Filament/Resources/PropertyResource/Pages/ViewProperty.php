<?php

namespace App\Filament\Resources\PropertyResource\Pages;

use App\Filament\Resources\PropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewProperty extends ViewRecord
{
    protected static string $resource = PropertyResource::class;

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
                        Infolists\Components\TextEntry::make('property_code')
                            ->label('Property Code'),
                        Infolists\Components\TextEntry::make('title')
                            ->label('Property Title'),
                        Infolists\Components\TextEntry::make('institute.name')
                            ->label('Institute'),
                        Infolists\Components\TextEntry::make('property_type')
                            ->label('Property Type')
                            ->badge(),
                        Infolists\Components\TextEntry::make('description')
                            ->markdown()
                            ->columnSpanFull(),
                    ])->columns(2),

                Infolists\Components\Section::make('Address')
                    ->schema([
                        Infolists\Components\TextEntry::make('address')
                            ->label('Full Address'),
                        Infolists\Components\TextEntry::make('city')
                            ->label('City'),
                        Infolists\Components\TextEntry::make('state')
                            ->label('State'),
                        Infolists\Components\TextEntry::make('postal_code')
                            ->label('Postal Code'),
                        Infolists\Components\TextEntry::make('distance_to_institute')
                            ->label('Distance to Institute')
                            ->suffix(' km'),
                    ])->columns(2),

                Infolists\Components\Section::make('Room Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('total_rooms')
                            ->label('Total Rooms'),
                        Infolists\Components\TextEntry::make('available_rooms')
                            ->label('Available Rooms'),
                        Infolists\Components\TextEntry::make('occupancy_rate')
                            ->label('Occupancy Rate')
                            ->suffix('%'),
                        Infolists\Components\TextEntry::make('lease_duration_min')
                            ->label('Min Lease Duration')
                            ->suffix(' months'),
                        Infolists\Components\TextEntry::make('lease_duration_max')
                            ->label('Max Lease Duration')
                            ->suffix(' months'),
                    ])->columns(2),

                Infolists\Components\Section::make('Pricing')
                    ->schema([
                        Infolists\Components\TextEntry::make('price_per_month')
                            ->label('Monthly Rent')
                            ->money('USD'),
                        Infolists\Components\TextEntry::make('security_deposit')
                            ->label('Security Deposit')
                            ->money('USD'),
                        Infolists\Components\TextEntry::make('monthly_expenses')
                            ->label('Monthly Expenses')
                            ->money('USD'),
                    ])->columns(3),

                Infolists\Components\Section::make('Availability')
                    ->schema([
                        Infolists\Components\TextEntry::make('available_from')
                            ->label('Available From')
                            ->date(),
                        Infolists\Components\TextEntry::make('available_until')
                            ->label('Available Until')
                            ->date(),
                    ])->columns(2),

                Infolists\Components\Section::make('Features')
                    ->schema([
                        Infolists\Components\TextEntry::make('utility_costs_included')
                            ->label('Utilities Included')
                            ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')
                            ->icon(fn ($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn ($state) => $state ? 'success' : 'danger'),
                        Infolists\Components\TextEntry::make('furnished')
                            ->label('Furnished')
                            ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')
                            ->icon(fn ($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn ($state) => $state ? 'success' : 'danger'),
                        Infolists\Components\TextEntry::make('maintenance_status')
                            ->label('Maintenance Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'excellent' => 'success',
                                'good' => 'info',
                                'fair' => 'warning',
                                'under_maintenance' => 'danger',
                            }),
                    ])->columns(3),

                Infolists\Components\Section::make('Settings')
                    ->schema([
                        Infolists\Components\TextEntry::make('is_active')
                            ->label('Active Status')
                            ->formatStateUsing(fn ($state) => $state ? 'Active' : 'Inactive')
                            ->icon(fn ($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn ($state) => $state ? 'success' : 'danger'),
                        Infolists\Components\TextEntry::make('property_manager_notes')
                            ->label('Manager Notes')
                            ->markdown()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('acquisition_date')
                            ->label('Acquisition Date')
                            ->date(),
                    ])->columns(2),

                Infolists\Components\Section::make('Statistics')
                    ->schema([
                        Infolists\Components\TextEntry::make('bookings_count')
                            ->label('Total Bookings')
                            ->state(fn ($record) => $record->bookings()->count()),
                        Infolists\Components\TextEntry::make('reviews_count')
                            ->label('Total Reviews')
                            ->state(fn ($record) => $record->reviews()->count()),
                        Infolists\Components\TextEntry::make('maintenance_requests_count')
                            ->label('Maintenance Requests')
                            ->state(fn ($record) => $record->maintenanceRequests()->count()),
                        Infolists\Components\TextEntry::make('average_rating')
                            ->label('Average Rating')
                            ->state(fn ($record) => $record->average_rating)
                            ->suffix('/ 5'),
                    ])->columns(4),
            ]);
    }
} 