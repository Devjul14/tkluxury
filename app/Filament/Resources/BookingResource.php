<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    
    protected static ?string $navigationGroup = 'Student Management';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Booking Information')
                    ->schema([
                        Forms\Components\Select::make('property_id')
                            ->relationship('property', 'title')
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('student_id')
                            ->relationship('student', 'name')
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('booking_reference')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'active' => 'Active',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Dates')
                    ->schema([
                        Forms\Components\DatePicker::make('check_in_date')
                            ->required(),
                        Forms\Components\DatePicker::make('check_out_date')
                            ->required(),
                        Forms\Components\TextInput::make('duration_months')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->suffix('months'),
                        Forms\Components\DatePicker::make('booking_date')
                            ->required(),
                        Forms\Components\DatePicker::make('key_handover_date'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Financial Information')
                    ->schema([
                        Forms\Components\TextInput::make('monthly_rent')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('security_deposit')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('total_amount')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                    ])->columns(3),
                
                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\TextInput::make('assigned_room_number')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('special_requests')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('check_in_notes')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('check_out_notes')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_reference')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('property.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_in_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_out_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_months')
                    ->numeric()
                    ->sortable()
                    ->suffix(' months'),
                Tables\Columns\TextColumn::make('monthly_rent')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'info',
                        'active' => 'success',
                        'completed' => 'primary',
                        'cancelled' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('payments_count')
                    ->label('Payments')
                    ->counts('payments')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'active' => 'Active',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
                Tables\Filters\SelectFilter::make('property')
                    ->relationship('property', 'title'),
                Tables\Filters\SelectFilter::make('student')
                    ->relationship('student', 'name'),
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
            RelationManagers\PaymentsRelationManager::class,
            RelationManagers\ContractRelationManager::class,
            RelationManagers\MaintenanceRequestsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'view' => Pages\ViewBooking::route('/{record}'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
