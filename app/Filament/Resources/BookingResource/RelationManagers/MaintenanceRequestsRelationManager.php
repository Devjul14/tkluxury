<?php

namespace App\Filament\Resources\BookingResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenanceRequestsRelationManager extends RelationManager
{
    protected static string $relationship = 'maintenanceRequests';

    protected static ?string $recordTitleAttribute = 'request_reference';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('request_reference')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Select::make('priority')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                        'urgent' => 'Urgent',
                    ])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'assigned' => 'Assigned',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),
                Forms\Components\Select::make('category')
                    ->options([
                        'plumbing' => 'Plumbing',
                        'electrical' => 'Electrical',
                        'heating_cooling' => 'Heating/Cooling',
                        'appliances' => 'Appliances',
                        'structural' => 'Structural',
                        'cleaning' => 'Cleaning',
                        'pest_control' => 'Pest Control',
                        'other' => 'Other',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('request_date')
                    ->required(),
                Forms\Components\DatePicker::make('preferred_date')
                    ->required(),
                Forms\Components\TimePicker::make('preferred_time_slot')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('request_reference')
            ->columns([
                Tables\Columns\TextColumn::make('request_reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->badge(),
                Tables\Columns\BadgeColumn::make('priority')
                    ->colors([
                        'success' => 'low',
                        'info' => 'medium',
                        'warning' => 'high',
                        'danger' => 'urgent',
                    ]),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'assigned',
                        'primary' => 'in_progress',
                        'success' => 'completed',
                        'gray' => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('request_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('preferred_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assignedStaff.name')
                    ->label('Assigned To'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('priority')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                        'urgent' => 'Urgent',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'assigned' => 'Assigned',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'plumbing' => 'Plumbing',
                        'electrical' => 'Electrical',
                        'heating_cooling' => 'Heating/Cooling',
                        'appliances' => 'Appliances',
                        'structural' => 'Structural',
                        'cleaning' => 'Cleaning',
                        'pest_control' => 'Pest Control',
                        'other' => 'Other',
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