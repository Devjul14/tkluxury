<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    
    protected static ?string $navigationGroup = 'Financial Management';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Payment Information')
                    ->schema([
                        Forms\Components\Select::make('booking_id')
                            ->relationship('booking', 'booking_reference')
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('payment_reference')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('payment_type')
                            ->options([
                                'rent' => 'Rent',
                                'security_deposit' => 'Security Deposit',
                                'late_fee' => 'Late Fee',
                                'maintenance_fee' => 'Maintenance Fee',
                                'other' => 'Other',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\Select::make('payment_method')
                            ->options([
                                'credit_card' => 'Credit Card',
                                'debit_card' => 'Debit Card',
                                'bank_transfer' => 'Bank Transfer',
                                'cash' => 'Cash',
                                'check' => 'Check',
                                'paypal' => 'PayPal',
                                'stripe' => 'Stripe',
                            ])
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Payment Details')
                    ->schema([
                        Forms\Components\DatePicker::make('payment_date')
                            ->required(),
                        Forms\Components\DatePicker::make('due_date')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'completed' => 'Completed',
                                'failed' => 'Failed',
                                'refunded' => 'Refunded',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('transaction_id')
                            ->maxLength(255),
                    ])->columns(2),
                
                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('notes')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('receipt')
                            ->directory('payments/receipts'),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('payment_reference')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('booking.booking_reference')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('booking.student.name')
                    ->label('Student')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_type')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'completed' => 'success',
                        'failed' => 'danger',
                        'refunded' => 'primary',
                        'cancelled' => 'gray',
                    }),
                Tables\Columns\TextColumn::make('transaction_id')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_type')
                    ->options([
                        'rent' => 'Rent',
                        'security_deposit' => 'Security Deposit',
                        'late_fee' => 'Late Fee',
                        'maintenance_fee' => 'Maintenance Fee',
                        'other' => 'Other',
                    ]),
                Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        'credit_card' => 'Credit Card',
                        'debit_card' => 'Debit Card',
                        'bank_transfer' => 'Bank Transfer',
                        'cash' => 'Cash',
                        'check' => 'Check',
                        'paypal' => 'PayPal',
                        'stripe' => 'Stripe',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                        'cancelled' => 'Cancelled',
                    ]),
                Tables\Filters\Filter::make('payment_date')
                    ->form([
                        Forms\Components\DatePicker::make('payment_date_from'),
                        Forms\Components\DatePicker::make('payment_date_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['payment_date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('payment_date', '>=', $date),
                            )
                            ->when(
                                $data['payment_date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('payment_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'view' => Pages\ViewPayment::route('/{record}'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
