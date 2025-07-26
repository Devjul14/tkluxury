<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

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
                        Infolists\Components\ImageEntry::make('profile_image')
                            ->label('Profile Image')
                            ->circular(),
                        Infolists\Components\TextEntry::make('name')
                            ->label('Full Name'),
                        Infolists\Components\TextEntry::make('email')
                            ->label('Email Address'),
                        Infolists\Components\TextEntry::make('phone')
                            ->label('Phone Number'),
                        Infolists\Components\TextEntry::make('user_type')
                            ->label('User Type')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'admin' => 'primary',
                                'student' => 'success',
                                'staff' => 'warning',
                            }),
                    ])->columns(2),

                Infolists\Components\Section::make('Personal Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('date_of_birth')
                            ->label('Date of Birth')
                            ->date(),
                        Infolists\Components\TextEntry::make('gender')
                            ->label('Gender'),
                        Infolists\Components\TextEntry::make('nationality')
                            ->label('Nationality'),
                    ])->columns(3),

                Infolists\Components\Section::make('Emergency Contact')
                    ->schema([
                        Infolists\Components\TextEntry::make('emergency_contact_name')
                            ->label('Emergency Contact Name'),
                        Infolists\Components\TextEntry::make('emergency_contact_phone')
                            ->label('Emergency Contact Phone'),
                    ])->columns(2),

                Infolists\Components\Section::make('Account Status')
                    ->schema([
                        Infolists\Components\TextEntry::make('is_active')
                            ->label('Active Status')
                            ->formatStateUsing(fn ($state) => $state ? 'Active' : 'Inactive')
                            ->icon(fn ($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn ($state) => $state ? 'success' : 'danger'),
                        Infolists\Components\TextEntry::make('email_verified_at')
                            ->label('Email Verified')
                            ->dateTime(),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Member Since')
                            ->dateTime(),
                    ])->columns(3),

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
                    ])->columns(3),
            ]);
    }
} 