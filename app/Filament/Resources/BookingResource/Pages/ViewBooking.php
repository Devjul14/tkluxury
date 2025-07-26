<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewBooking extends ViewRecord
{
    protected static string $resource = BookingResource::class;

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
                Infolists\Components\Section::make('Booking Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('booking_reference')
                            ->label('Booking Reference'),
                        Infolists\Components\TextEntry::make('property.title')
                            ->label('Property'),
                        Infolists\Components\TextEntry::make('student.name')
                            ->label('Student'),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'confirmed' => 'info',
                                'active' => 'success',
                                'completed' => 'primary',
                                'cancelled' => 'danger',
                            }),
                    ])->columns(2),

                Infolists\Components\Section::make('Dates')
                    ->schema([
                        Infolists\Components\TextEntry::make('check_in_date')
                            ->label('Check-in Date')
                            ->date(),
                        Infolists\Components\TextEntry::make('check_out_date')
                            ->label('Check-out Date')
                            ->date(),
                        Infolists\Components\TextEntry::make('duration_months')
                            ->label('Duration')
                            ->suffix(' months'),
                        Infolists\Components\TextEntry::make('booking_date')
                            ->label('Booking Date')
                            ->date(),
                        Infolists\Components\TextEntry::make('key_handover_date')
                            ->label('Key Handover Date')
                            ->date(),
                    ])->columns(2),

                Infolists\Components\Section::make('Financial Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('monthly_rent')
                            ->label('Monthly Rent')
                            ->money('USD'),
                        Infolists\Components\TextEntry::make('security_deposit')
                            ->label('Security Deposit')
                            ->money('USD'),
                        Infolists\Components\TextEntry::make('total_amount')
                            ->label('Total Amount')
                            ->money('USD'),
                    ])->columns(3),

                Infolists\Components\Section::make('Additional Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('assigned_room_number')
                            ->label('Assigned Room Number'),
                        Infolists\Components\TextEntry::make('special_requests')
                            ->label('Special Requests')
                            ->markdown()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('check_in_notes')
                            ->label('Check-in Notes')
                            ->markdown()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('check_out_notes')
                            ->label('Check-out Notes')
                            ->markdown()
                            ->columnSpanFull(),
                    ])->columns(1),

                Infolists\Components\Section::make('Related Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('payments_count')
                            ->label('Total Payments')
                            ->state(fn ($record) => $record->payments()->count()),
                        Infolists\Components\TextEntry::make('contracts_count')
                            ->label('Contracts')
                            ->state(fn ($record) => $record->contracts()->count()),
                        Infolists\Components\TextEntry::make('maintenance_requests_count')
                            ->label('Maintenance Requests')
                            ->state(fn ($record) => $record->maintenanceRequests()->count()),
                    ])->columns(3),
            ]);
    }
} 