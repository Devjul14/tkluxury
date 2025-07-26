<?php

namespace App\Filament\Resources\RoomResource\RelationManagers;

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

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                Forms\Components\Select::make('category')
                    ->options([
                        'plumbing' => 'Plumbing',
                        'electrical' => 'Electrical',
                        'heating' => 'Heating',
                        'cleaning' => 'Cleaning',
                        'security' => 'Security',
                        'other' => 'Other',
                    ])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'submitted' => 'Submitted',
                        'assigned' => 'Assigned',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'closed' => 'Closed',
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable()
                    ->label('Student'),
                Tables\Columns\BadgeColumn::make('priority')
                    ->colors([
                        'success' => 'low',
                        'info' => 'medium',
                        'warning' => 'high',
                        'danger' => 'urgent',
                    ]),
                Tables\Columns\BadgeColumn::make('category')
                    ->colors([
                        'primary' => 'plumbing',
                        'secondary' => 'electrical',
                        'info' => 'heating',
                        'success' => 'cleaning',
                        'warning' => 'security',
                        'gray' => 'other',
                    ]),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'submitted',
                        'info' => 'assigned',
                        'primary' => 'in_progress',
                        'success' => 'completed',
                        'gray' => 'closed',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                        'submitted' => 'Submitted',
                        'assigned' => 'Assigned',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'closed' => 'Closed',
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