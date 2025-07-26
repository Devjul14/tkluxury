<?php

namespace App\Filament\Resources\ContractResource\Pages;

use App\Filament\Resources\ContractResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewContract extends ViewRecord
{
    protected static string $resource = ContractResource::class;

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
                Infolists\Components\Section::make('Contract Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('contract_number')
                            ->label('Contract Number'),
                        Infolists\Components\TextEntry::make('booking.booking_reference')
                            ->label('Booking Reference'),
                        Infolists\Components\TextEntry::make('booking.student.name')
                            ->label('Student'),
                        Infolists\Components\TextEntry::make('contractTemplate.name')
                            ->label('Contract Template'),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'draft' => 'gray',
                                'pending_signature' => 'warning',
                                'active' => 'success',
                                'expired' => 'danger',
                                'terminated' => 'primary',
                            }),
                    ])->columns(2),

                Infolists\Components\Section::make('Contract Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('start_date')
                            ->label('Start Date')
                            ->date(),
                        Infolists\Components\TextEntry::make('end_date')
                            ->label('End Date')
                            ->date(),
                        Infolists\Components\TextEntry::make('duration_months')
                            ->label('Duration')
                            ->suffix(' months'),
                        Infolists\Components\TextEntry::make('monthly_rent')
                            ->label('Monthly Rent')
                            ->money('USD'),
                        Infolists\Components\TextEntry::make('security_deposit')
                            ->label('Security Deposit')
                            ->money('USD'),
                    ])->columns(2),

                Infolists\Components\Section::make('Terms and Conditions')
                    ->schema([
                        Infolists\Components\TextEntry::make('terms_and_conditions')
                            ->label('Terms and Conditions')
                            ->html()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('special_conditions')
                            ->label('Special Conditions')
                            ->markdown()
                            ->columnSpanFull(),
                    ])->columns(1),

                Infolists\Components\Section::make('Signatures')
                    ->schema([
                        Infolists\Components\TextEntry::make('student_signed_date')
                            ->label('Student Signed')
                            ->date(),
                        Infolists\Components\TextEntry::make('landlord_signed_date')
                            ->label('Landlord Signed')
                            ->date(),
                        Infolists\Components\TextEntry::make('witness_signed_date')
                            ->label('Witness Signed')
                            ->date(),
                        Infolists\Components\FileEntry::make('student_signature')
                            ->label('Student Signature'),
                        Infolists\Components\FileEntry::make('landlord_signature')
                            ->label('Landlord Signature'),
                    ])->columns(2),

                Infolists\Components\Section::make('Additional Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('notes')
                            ->label('Notes')
                            ->markdown()
                            ->columnSpanFull(),
                        Infolists\Components\FileEntry::make('attachments')
                            ->label('Attachments')
                            ->columnSpanFull(),
                    ])->columns(1),
            ]);
    }
} 