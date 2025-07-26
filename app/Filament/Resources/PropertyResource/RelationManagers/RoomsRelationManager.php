<?php

namespace App\Filament\Resources\PropertyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomsRelationManager extends RelationManager
{
    protected static string $relationship = 'rooms';

    protected static ?string $recordTitleAttribute = 'room_number';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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

                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->label('Description'),

                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->label('Notes'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('room_number')
            ->columns([
                Tables\Columns\TextColumn::make('full_room_number')
                    ->searchable()
                    ->sortable()
                    ->label('Room Number'),

                Tables\Columns\TextColumn::make('room_type_label')
                    ->badge()
                    ->color('info')
                    ->label('Type'),

                Tables\Columns\TextColumn::make('floor_number')
                    ->numeric()
                    ->sortable()
                    ->label('Floor'),

                Tables\Columns\TextColumn::make('size_sqm')
                    ->numeric()
                    ->suffix(' sqm')
                    ->sortable()
                    ->label('Size'),

                Tables\Columns\TextColumn::make('capacity')
                    ->numeric()
                    ->sortable()
                    ->label('Capacity'),

                Tables\Columns\TextColumn::make('price_per_month')
                    ->money('USD')
                    ->sortable()
                    ->label('Price'),

                Tables\Columns\IconColumn::make('is_available')
                    ->boolean()
                    ->label('Available'),

                Tables\Columns\BadgeColumn::make('maintenance_status')
                    ->colors([
                        'success' => 'excellent',
                        'info' => 'good',
                        'warning' => 'fair',
                        'danger' => 'under_maintenance',
                    ])
                    ->label('Status'),

                Tables\Columns\TextColumn::make('current_student.name')
                    ->label('Current Student')
                    ->placeholder('Vacant'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
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
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
} 