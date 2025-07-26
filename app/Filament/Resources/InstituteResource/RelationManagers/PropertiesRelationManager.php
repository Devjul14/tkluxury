<?php

namespace App\Filament\Resources\InstituteResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertiesRelationManager extends RelationManager
{
    protected static string $relationship = 'properties';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('property_code')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\Select::make('property_type')
                    ->options([
                        'apartment' => 'Apartment',
                        'room' => 'Room',
                        'studio' => 'Studio',
                        'house' => 'House',
                        'dormitory' => 'Dormitory',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('price_per_month')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('total_rooms')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('available_rooms')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('property_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('property_type')
                    ->badge(),
                Tables\Columns\TextColumn::make('price_per_month')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_rooms')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('available_rooms')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('occupancy_rate')
                    ->label('Occupancy')
                    ->suffix('%')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('maintenance_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'excellent' => 'success',
                        'good' => 'info',
                        'fair' => 'warning',
                        'under_maintenance' => 'danger',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('property_type')
                    ->options([
                        'apartment' => 'Apartment',
                        'room' => 'Room',
                        'studio' => 'Studio',
                        'house' => 'House',
                        'dormitory' => 'Dormitory',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
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