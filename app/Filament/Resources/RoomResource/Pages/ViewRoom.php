<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\KeyValue;

class ViewRoom extends ViewRecord
{
    protected static string $resource = RoomResource::class;

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
                Section::make('Room Information')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('full_room_number')
                                    ->label('Room Number')
                                    ->size(TextEntry\TextEntrySize::Large)
                                    ->weight('bold'),

                                TextEntry::make('room_type_label')
                                    ->label('Room Type')
                                    ->badge()
                                    ->color('info'),

                                TextEntry::make('property.title')
                                    ->label('Property')
                                    ->url(fn ($record) => $record->property ? route('filament.admin.resources.properties.view', $record->property) : null),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextEntry::make('floor_number')
                                    ->label('Floor'),

                                TextEntry::make('size_sqm')
                                    ->label('Size')
                                    ->suffix(' sqm'),

                                TextEntry::make('capacity')
                                    ->label('Capacity'),

                                TextEntry::make('price_per_month')
                                    ->label('Monthly Rent')
                                    ->money('USD'),
                            ]),
                    ]),

                Section::make('Availability & Status')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('is_available')
                                    ->label('Available')
                                    ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')
                                    ->icon(fn ($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                                    ->color(fn ($state) => $state ? 'success' : 'danger'),

                                TextEntry::make('maintenance_status')
                                    ->label('Maintenance Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'excellent' => 'success',
                                        'good' => 'info',
                                        'fair' => 'warning',
                                        'under_maintenance' => 'danger',
                                        default => 'gray',
                                    }),

                                TextEntry::make('last_inspection_date')
                                    ->label('Last Inspection')
                                    ->date(),
                            ]),

                        TextEntry::make('current_student.name')
                            ->label('Current Student')
                            ->placeholder('Vacant')
                            ->url(fn ($record) => $record->current_student ? route('filament.admin.resources.users.view', $record->current_student) : null),

                        TextEntry::make('days_until_available')
                            ->label('Days Until Available')
                            ->placeholder('Available now')
                            ->suffix(' days'),
                    ]),

                Section::make('Amenities')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('is_furnished')
                                    ->label('Furnished')
                                    ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),

                                TextEntry::make('has_private_bathroom')
                                    ->label('Private Bathroom')
                                    ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),

                                TextEntry::make('has_balcony')
                                    ->label('Balcony')
                                    ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),

                                TextEntry::make('has_air_conditioning')
                                    ->label('Air Conditioning')
                                    ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),

                                TextEntry::make('has_heating')
                                    ->label('Heating')
                                    ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),
                            ]),

                        TextEntry::make('amenities_list')
                            ->label('Additional Amenities')
                            ->listWithLineBreaks()
                            ->placeholder('No additional amenities'),
                    ]),

                Section::make('Financial Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('price_per_month')
                                    ->label('Monthly Rent')
                                    ->money('USD')
                                    ->size(TextEntry\TextEntrySize::Large)
                                    ->weight('bold'),

                                TextEntry::make('security_deposit')
                                    ->label('Security Deposit')
                                    ->money('USD'),
                            ]),

                        Grid::make(3)
                            ->schema([
                                TextEntry::make('total_revenue')
                                    ->label('Total Revenue')
                                    ->money('USD'),

                                TextEntry::make('monthly_revenue')
                                    ->label('Current Monthly Revenue')
                                    ->money('USD'),

                                TextEntry::make('occupancy_rate')
                                    ->label('Occupancy Rate')
                                    ->suffix('%')
                                    ->formatStateUsing(fn ($state) => number_format($state, 1)),
                            ]),
                    ]),

                Section::make('Related Information')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('bookings_count')
                                    ->label('Total Bookings')
                                    ->state(fn ($record) => $record->bookings()->count()),

                                TextEntry::make('maintenance_requests_count')
                                    ->label('Maintenance Requests')
                                    ->state(fn ($record) => $record->maintenanceRequests()->count()),

                                TextEntry::make('inspections_count')
                                    ->label('Inspections')
                                    ->state(fn ($record) => $record->inspections()->count()),
                            ]),
                    ]),

                Section::make('Additional Information')
                    ->schema([
                        TextEntry::make('description')
                            ->label('Description')
                            ->markdown()
                            ->placeholder('No description available'),

                        TextEntry::make('notes')
                            ->label('Notes')
                            ->markdown()
                            ->placeholder('No notes available'),
                    ])
                    ->collapsible(),
            ]);
    }
} 