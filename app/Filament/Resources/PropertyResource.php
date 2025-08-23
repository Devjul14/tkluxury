<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Http;
use Exception;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function getNavigationGroup(): ?string
    {
        return __('navigations.group_properties');
    }

    public static function getNavigationLabel(): string
    {
        return __('navigations.properties');
    }

    public static function getModelLabel(): string
    {
        return __('navigations.properties');
    }

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\Select::make('institute_id')
                            ->relationship('institute', 'name')
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('property_code')
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
                        Forms\Components\Select::make('property_type')
                            ->options([
                                'apartment' => 'Apartment',
                                'room' => 'Room',
                                'studio' => 'Studio',
                                'house' => 'House',
                                'dormitory' => 'Dormitory',
                            ])
                            ->required(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Address')
                    ->schema([
                        Forms\Components\Textarea::make('address')
                            ->required()
                            ->maxLength(65535),
                        Forms\Components\TextInput::make('city')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('state')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('postal_code')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Location Map')
                    ->schema([
                        // These fields are now in a new section with a 3-column layout.
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('latitude')
                                    ->numeric()
                                    ->step(0.000001)
                                    ->readOnly()
                                    ->live()
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('longitude')
                                    ->numeric()
                                    ->step(0.000001)
                                    ->readOnly()
                                    ->live()
                                    ->columnSpan(1),
                                // Forms\Components\TextInput::make('distance_to_institute')
                                //     ->numeric()
                                //     ->step(0.001)
                                //     ->suffix('km')
                                //     ->label('Distance to Institute (km)')
                                //     ->columnSpan(1),
                            ]),
                        // The ViewField for the map remains, now in its own section.
                        ViewField::make('location_map')
                            ->label('Location on Map')
                            ->view('forms.components.google-maps-location')
                            ->columnSpanFull()
                            ->hiddenLabel(),
                    ])
                    ->columns(1),
                Forms\Components\Section::make('Room Information')
                    ->schema([
                        Forms\Components\TextInput::make('total_rooms')
                            ->required()
                            ->numeric()
                            ->minValue(1),
                        Forms\Components\TextInput::make('available_rooms')
                            ->required()
                            ->numeric()
                            ->minValue(0),
                        Forms\Components\TextInput::make('lease_duration_min')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->suffix('months'),
                        Forms\Components\TextInput::make('lease_duration_max')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->suffix('months'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Pricing')
                    ->schema([
                        Forms\Components\TextInput::make('price_per_month')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('security_deposit')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('monthly_expenses')
                            ->label('Monthly Rental')
                            ->numeric()
                            ->prefix('$')
                            ->default(0),
                        Forms\Components\Select::make('down_payment_type')
                            ->label('Down Payment Type')
                            ->options([
                                'fixed' => 'Fixed Value',
                                'percentage' => 'Percentage',
                            ])
                            ->default('percentage')
                            ->reactive(),
                        Forms\Components\TextInput::make('down_payment_value')
                            ->label('Down Payment Value')
                            ->required()
                            ->numeric()
                            ->prefix(fn($get) => $get('down_payment_type') === 'fixed' ? '$' : null)
                            ->suffix(fn($get) => $get('down_payment_type') === 'percentage' ? '%' : null)
                            ->default(config('hostel.booking.down_payment_rate', 0.1) * 100)
                    ])
                    ->columns(3),
                Forms\Components\Section::make('Availability')
                    ->schema([
                        Forms\Components\DatePicker::make('available_from')
                            ->required(),
                        Forms\Components\DatePicker::make('available_until'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Features')
                    ->schema([
                        Forms\Components\Toggle::make('utility_costs_included')
                            ->required(),
                        Forms\Components\Toggle::make('furnished')
                            ->required(),
                        Forms\Components\Select::make('features')
                            ->label('Additional Features')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->relationship('features', 'name')
                            ->optionsLimit(50)
                            ->placeholder('Select additional features...')
                            ->helperText('Search and select additional features for this property')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('maintenance_status')
                            ->options([
                                'excellent' => 'Excellent',
                                'good' => 'Good',
                                'fair' => 'Fair',
                                'under_maintenance' => 'Under Maintenance',
                            ])
                            ->required(),
                    ])
                    ->columns(3),
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->required(),
                        Forms\Components\Textarea::make('property_manager_notes')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('acquisition_date'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('property_code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('institute.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('property_type')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_per_month')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('down_payment_value')
                    ->formatStateUsing(function ($state, $record) {
                        if ($record->down_payment_type === 'percentage') {
                            return $state . '%';
                        }
                        if ($record->down_payment_type === 'fixed') {
                            return '$' . number_format($state, 2);
                        }
                        return $state;
                    })
                    ->color(function ($record) {
                        return match ($record->down_payment_type) {
                            'fixed' => 'success',
                            'percentage' => 'warning',
                            default => 'secondary',
                        };
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('occupancy_rate')
                    ->label('Occupancy')
                    ->suffix('%')
                    ->sortable(),
                Tables\Columns\TextColumn::make('distance_to_institute')
                    ->label('Distance')
                    ->suffix(' km')
                    ->sortable(),
                Tables\Columns\TextColumn::make('maintenance_status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'excellent' => 'success',
                        'good' => 'info',
                        'fair' => 'warning',
                        'under_maintenance' => 'danger',
                    }),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('institute')
                    ->relationship('institute', 'name'),
                Tables\Filters\SelectFilter::make('property_type')
                    ->options([
                        'apartment' => 'Apartment',
                        'room' => 'Room',
                        'studio' => 'Studio',
                        'house' => 'House',
                        'dormitory' => 'Dormitory',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active'),
                Tables\Filters\TernaryFilter::make('furnished'),
                Tables\Filters\TernaryFilter::make('utility_costs_included'),
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
            \App\Filament\Resources\PropertyResource\RelationManagers\RoomsRelationManager::class,
            \App\Filament\Resources\PropertyResource\RelationManagers\NearbyPlacesRelationManager::class,
            \App\Filament\Resources\PropertyResource\RelationManagers\BookingsRelationManager::class,
            \App\Filament\Resources\PropertyResource\RelationManagers\ReviewsRelationManager::class,
            \App\Filament\Resources\PropertyResource\RelationManagers\MaintenanceRequestsRelationManager::class,
            \App\Filament\Resources\PropertyResource\RelationManagers\InspectionsRelationManager::class,
            \App\Filament\Resources\PropertyResource\RelationManagers\PropertyImageRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'view' => Pages\ViewProperty::route('/{record}'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
