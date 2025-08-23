<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceRequestResource\Pages;
use App\Filament\Resources\MaintenanceRequestResource\RelationManagers;
use App\Models\MaintenanceRequest;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenanceRequestResource extends Resource
{
    protected static ?string $model = MaintenanceRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    public static function getNavigationGroup(): ?string
    {
        return __('navigations.group_maintenance_operations');
    }

    public static function getNavigationLabel(): string
    {
        return __('navigations.maintenance_requests');
    }

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Request Information')
                    ->schema([
                        Forms\Components\Select::make('property_id')
                            ->relationship('property', 'title')
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('student_id')
                            ->relationship('student', 'name')
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('request_reference')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
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
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Issue Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
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
                        Forms\Components\Select::make('room_location')
                            ->options([
                                'bedroom' => 'Bedroom',
                                'bathroom' => 'Bathroom',
                                'kitchen' => 'Kitchen',
                                'living_room' => 'Living Room',
                                'common_area' => 'Common Area',
                                'exterior' => 'Exterior',
                                'other' => 'Other',
                            ]),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Scheduling')
                    ->schema([
                        Forms\Components\DatePicker::make('request_date')
                            ->required(),
                        Forms\Components\DatePicker::make('preferred_date')
                            ->required(),
                        Forms\Components\TimePicker::make('preferred_time_slot')
                            ->required(),
                        Forms\Components\DatePicker::make('completion_date'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Assignment')
                    ->schema([
                        Forms\Components\Select::make('assigned_staff_id')
                            ->relationship('assignedStaff', 'name')
                            ->searchable(),
                        Forms\Components\TextInput::make('estimated_cost')
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('actual_cost')
                            ->numeric()
                            ->prefix('$'),
                    ])
                    ->columns(3),
                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\FileUpload::make('photos')
                            ->multiple()
                            ->image()
                            ->directory('maintenance/photos'),
                        Forms\Components\Textarea::make('staff_notes')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('resolution_notes')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('request_reference')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('property.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('priority')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'low' => 'success',
                        'medium' => 'info',
                        'high' => 'warning',
                        'urgent' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'assigned' => 'info',
                        'in_progress' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'gray',
                    }),
                Tables\Columns\TextColumn::make('request_date')
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
                Tables\Filters\SelectFilter::make('property')
                    ->relationship('property', 'title'),
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
            'index' => Pages\ListMaintenanceRequests::route('/'),
            'create' => Pages\CreateMaintenanceRequest::route('/create'),
            'view' => Pages\ViewMaintenanceRequest::route('/{record}'),
            'edit' => Pages\EditMaintenanceRequest::route('/{record}/edit'),
        ];
    }
}
