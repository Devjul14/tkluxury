<?php

namespace App\Filament\Resources\RoomResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InspectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'inspections';

    protected static ?string $recordTitleAttribute = 'inspection_date';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('inspection_date')
                    ->required(),
                Forms\Components\Select::make('inspector_id')
                    ->relationship('inspector', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Inspector'),
                Forms\Components\Select::make('inspection_type')
                    ->options([
                        'routine' => 'Routine',
                        'move_in' => 'Move-in',
                        'move_out' => 'Move-out',
                        'maintenance' => 'Maintenance',
                        'safety' => 'Safety',
                    ])
                    ->required(),
                Forms\Components\Select::make('overall_condition')
                    ->options([
                        'excellent' => 'Excellent',
                        'good' => 'Good',
                        'fair' => 'Fair',
                        'poor' => 'Poor',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('inspection_date')
            ->columns([
                Tables\Columns\TextColumn::make('inspection_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('inspector.name')
                    ->searchable()
                    ->label('Inspector'),
                Tables\Columns\BadgeColumn::make('inspection_type')
                    ->colors([
                        'primary' => 'routine',
                        'info' => 'move_in',
                        'warning' => 'move_out',
                        'success' => 'maintenance',
                        'danger' => 'safety',
                    ]),
                Tables\Columns\BadgeColumn::make('overall_condition')
                    ->colors([
                        'success' => 'excellent',
                        'info' => 'good',
                        'warning' => 'fair',
                        'danger' => 'poor',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('inspection_type')
                    ->options([
                        'routine' => 'Routine',
                        'move_in' => 'Move-in',
                        'move_out' => 'Move-out',
                        'maintenance' => 'Maintenance',
                        'safety' => 'Safety',
                    ]),
                Tables\Filters\SelectFilter::make('overall_condition')
                    ->options([
                        'excellent' => 'Excellent',
                        'good' => 'Good',
                        'fair' => 'Fair',
                        'poor' => 'Poor',
                    ]),
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