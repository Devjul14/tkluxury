<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Room;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationGroup = 'Property Management';

    protected static ?int $navigationSort = 3;
    public static function shouldRegisterNavigation(): bool
    {
        return false; // supaya tidak tampil di sidebar
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Room Information')
                    ->schema([
                        Forms\Components\Select::make('property_id')
                            ->relationship('property', 'title')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Property'),
                        Forms\Components\TextInput::make('room_number')
                            ->required()
                            ->maxLength(255)
                            ->label('Room Number'),
                        Forms\Components\Select::make('room_type')
                            ->options([
                                'single' => 'Single Room',
                                'double' => 'Double Room',
                                'triple' => 'Triple Room',
                                'quad' => 'Quad Room',
                                'studio' => 'Studio',
                                'suite' => 'Suite',
                            ])
                            ->required()
                            ->default('single')
                            ->label('Room Type'),
                        Forms\Components\TextInput::make('floor_number')
                            ->numeric()
                            ->default(1)
                            ->label('Floor Number'),
                        Forms\Components\TextInput::make('size_sqm')
                            ->numeric()
                            ->step(0.01)
                            ->label('Size (sqm)'),
                        Forms\Components\TextInput::make('capacity')
                            ->numeric()
                            ->default(1)
                            ->label('Capacity'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Pricing')
                    ->schema([
                        Forms\Components\TextInput::make('price_per_month')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->label('Price per Month'),
                        Forms\Components\TextInput::make('security_deposit')
                            ->numeric()
                            ->prefix('$')
                            ->default(0)
                            ->label('Security Deposit'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Availability & Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_available')
                            ->label('Available')
                            ->default(true),
                        Forms\Components\Select::make('maintenance_status')
                            ->options([
                                'excellent' => 'Excellent',
                                'good' => 'Good',
                                'fair' => 'Fair',
                                'under_maintenance' => 'Under Maintenance',
                            ])
                            ->default('good')
                            ->label('Maintenance Status'),
                        Forms\Components\DatePicker::make('last_inspection_date')
                            ->label('Last Inspection Date'),
                    ])
                    ->columns(3),
                Forms\Components\Section::make('Amenities')
                    ->schema([
                        Forms\Components\Toggle::make('is_furnished')
                            ->label('Furnished'),
                        Forms\Components\Toggle::make('has_private_bathroom')
                            ->label('Private Bathroom'),
                        Forms\Components\Toggle::make('has_balcony')
                            ->label('Balcony'),
                        Forms\Components\Toggle::make('has_air_conditioning')
                            ->label('Air Conditioning'),
                        Forms\Components\Toggle::make('has_heating')
                            ->label('Heating'),
                        Forms\Components\TagsInput::make('amenities')
                            ->label('Additional Amenities')
                            ->separator(','),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->maxLength(65535)
                            ->columnSpanFull()
                            ->label('Description'),
                        Forms\Components\Textarea::make('notes')
                            ->maxLength(65535)
                            ->columnSpanFull()
                            ->label('Notes'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('property.title')
                    ->searchable()
                    ->sortable()
                    ->label('Property'),
                Tables\Columns\TextColumn::make('full_room_number')
                    ->searchable()
                    ->sortable()
                    ->label('Room Number'),
                Tables\Columns\TextColumn::make('room_type_label')
                    ->badge()
                    ->color('info')
                    ->label('Type'),
                Tables\Columns\TextColumn::make('price_per_month')
                    ->money('USD')
                    ->sortable()
                    ->label('Price'),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean()
                    ->label('Available'),
                Tables\Columns\TextColumn::make('maintenance_status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'excellent' => 'success',
                        'good' => 'info',
                        'fair' => 'warning',
                        'under_maintenance' => 'danger',
                    })
                    ->label('Status'),
                Tables\Columns\TextColumn::make('capacity')
                    ->numeric()
                    ->sortable()
                    ->label('Capacity'),
                Tables\Columns\TextColumn::make('current_student.name')
                    ->label('Current Student')
                    ->placeholder('Vacant'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('property')
                    ->relationship('property', 'title')
                    ->label('Property'),
                Tables\Filters\SelectFilter::make('room_type')
                    ->options([
                        'single' => 'Single Room',
                        'double' => 'Double Room',
                        'triple' => 'Triple Room',
                        'quad' => 'Quad Room',
                        'studio' => 'Studio',
                        'suite' => 'Suite',
                    ])
                    ->label('Room Type'),
                Tables\Filters\TernaryFilter::make('is_available')
                    ->label('Availability'),
                Tables\Filters\SelectFilter::make('maintenance_status')
                    ->options([
                        'excellent' => 'Excellent',
                        'good' => 'Good',
                        'fair' => 'Fair',
                        'under_maintenance' => 'Under Maintenance',
                    ])
                    ->label('Maintenance Status'),
                Tables\Filters\Filter::make('price_range')
                    ->form([
                        Forms\Components\TextInput::make('min_price')
                            ->numeric()
                            ->label('Min Price'),
                        Forms\Components\TextInput::make('max_price')
                            ->numeric()
                            ->label('Max Price'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['min_price'],
                                fn(Builder $query, $minPrice): Builder => $query->where('price_per_month', '>=', $minPrice),
                            )
                            ->when(
                                $data['max_price'],
                                fn(Builder $query, $maxPrice): Builder => $query->where('price_per_month', '<=', $maxPrice),
                            );
                    })
                    ->label('Price Range'),
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
            \App\Filament\Resources\RoomResource\RelationManagers\BookingsRelationManager::class,
            \App\Filament\Resources\RoomResource\RelationManagers\MaintenanceRequestsRelationManager::class,
            \App\Filament\Resources\RoomResource\RelationManagers\InspectionsRelationManager::class,
            \App\Filament\Resources\RoomResource\RelationManagers\RoomImageRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'view' => Pages\ViewRoom::route('/{record}'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
