<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewPayment extends ViewRecord
{
    protected static string $resource = PaymentResource::class;

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
                Infolists\Components\Section::make('Payment Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('payment_reference')
                            ->label('Payment Reference'),
                        Infolists\Components\TextEntry::make('booking.booking_reference')
                            ->label('Booking Reference'),
                        Infolists\Components\TextEntry::make('booking.student.name')
                            ->label('Student'),
                        Infolists\Components\TextEntry::make('payment_type')
                            ->label('Payment Type')
                            ->badge(),
                        Infolists\Components\TextEntry::make('amount')
                            ->label('Amount')
                            ->money('USD'),
                        Infolists\Components\TextEntry::make('payment_method')
                            ->label('Payment Method')
                            ->badge(),
                    ])->columns(2),

                Infolists\Components\Section::make('Payment Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('payment_date')
                            ->label('Payment Date')
                            ->date(),
                        Infolists\Components\TextEntry::make('due_date')
                            ->label('Due Date')
                            ->date(),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'processing' => 'info',
                                'completed' => 'success',
                                'failed' => 'danger',
                                'refunded' => 'primary',
                                'cancelled' => 'gray',
                            }),
                        Infolists\Components\TextEntry::make('transaction_id')
                            ->label('Transaction ID'),
                    ])->columns(2),

                Infolists\Components\Section::make('Additional Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('description')
                            ->label('Description')
                            ->markdown()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('notes')
                            ->label('Notes')
                            ->markdown()
                            ->columnSpanFull(),
                        Infolists\Components\FileEntry::make('receipt')
                            ->label('Receipt')
                            ->columnSpanFull(),
                    ])->columns(1),
            ]);
    }
} 