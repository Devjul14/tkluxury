<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use GuzzleHttp\Client;
use Dotswan\MapPicker\Fields\Map;


class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationGroup = 'Property Management';

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

                Forms\Components\Section::make('Map Location')
                    ->schema([
                        // Mengganti TextInput dengan Select untuk fungsionalitas pencarian dinamis
                        Select::make('search_location')
                            ->label('Search for a location in Malaysia')
                            ->placeholder('e.g., Kuala Lumpur, Selangor')
                            ->live()
                            ->searchable() // Mengaktifkan fitur pencarian
                            ->getSearchResultsUsing(function (string $search) {
                                if (empty($search)) {
                                    return [];
                                }

                                $results = [];
                                // Ganti dengan panggilan API geocoding Anda sendiri.
                                // Contoh ini menggunakan Nominatim OpenStreetMap.
                                try {
                                    $client = new Client(['verify' => false]);
                                    $response = $client->get('https://nominatim.openstreetmap.org/search', [
                                        'query' => [
                                            'q' => $search . ', Malaysia', // Membatasi pencarian ke Malaysia
                                            'format' => 'json',
                                            'limit' => 5, // Mengambil 5 hasil teratas
                                            'addressdetails' => 1
                                        ]
                                    ]);

                                    $data = json_decode($response->getBody()->getContents(), true);

                                    foreach ($data as $item) {
                                        $lat = number_format((float) $item['lat'], 6);
                                        $lon = number_format((float) $item['lon'], 6);
                                        $displayName = $item['display_name'];
                                        $results["$lat,$lon"] = $displayName;
                                    }
                                } catch (\Exception $e) {
                                    // Anda dapat menangani error di sini, misalnya, log error
                                    // atau menampilkan notifikasi

                                }

                                return $results;
                            })
                            ->afterStateUpdated(function ($state, Set $set) {
                                if ($state) {
                                    // Mengurai string 'lat,lng' yang dipilih dari Select
                                    [$latitude, $longitude] = explode(',', $state);

                                    $set('latitude', (float) $latitude);
                                    $set('longitude', (float) $longitude);

                                    // Perbarui state 'map' agar komponen peta merespons
                                    $set('map', [
                                        'lat' => (float) $latitude,
                                        'lng' => (float) $longitude,
                                        'zoom' => 12, // Atur zoom ke level yang lebih dekat
                                    ]);
                                }
                            })
                            ->columnSpanFull(),

                        Map::make('map')
                            ->label('Location')
                            ->columnSpanFull()
                            ->defaultLocation(latitude: 3.139003, longitude: 101.686855)
                            ->draggable(true)
                            ->clickable(true)
                            ->zoom(8)
                            ->minZoom(0)
                            ->maxZoom(28)
                            ->tilesUrl('https://tile.openstreetmap.de/{z}/{x}/{y}.png')
                            ->detectRetina(true)
                            // Marker Configuration
                            ->showMarker(true)
                            ->markerColor('#3b82f6')
                            ->markerIconSize([36, 36])
                            ->markerIconAnchor([18, 36])
                            // Controls
                            ->showFullscreenControl(true)
                            ->showZoomControl(true)
                            // Location Features
                            ->rangeSelectField('distance')
                            // GeoMan Integration
                            ->geoManPosition('topleft')
                            ->drawCircleMarker(true)
                            ->dragMode(true)
                            ->cutPolygon(true)
                            ->editPolygon(true)
                            ->deleteLayer(true)
                            ->setColor('#3388ff')
                            ->setFilledColor('#cad9ec')
                            ->snappable(true, 20)
                            ->extraControl(['customControl' => true])
                            ->extraTileControl(['customTileOption' => 'value'])
                            ->afterStateHydrated(function ($state, ?Model $record, callable $set) {
                                if (!$record) {
                                    return;
                                }

                                if ($record->latitude && $record->longitude) {
                                    $set('map', [
                                        'lat' => (float) number_format((float) $record->latitude, 5, '.', ''),
                                        'lng' => (float) number_format((float) $record->longitude, 5, '.', ''),
                                    ]);
                                    $set('latitude', (float) number_format((float) $record->latitude, 5, '.', ''));
                                    $set('longitude', (float) number_format((float) $record->longitude, 5, '.', ''));
                                }
                            })
                            ->afterStateUpdated(function ($state, Set $set) {
                                if (is_array($state) && isset($state['lat'], $state['lng'])) {
                                    $set('latitude', (float) number_format((float) $state['lat'], 5, '.', ''));
                                    $set('longitude', (float) number_format((float) $state['lng'], 5, '.', ''));
                                }
                            }),
                        Forms\Components\TextInput::make('latitude')
                            ->numeric()
                            ->step(0.000001),
                        Forms\Components\TextInput::make('longitude')
                            ->numeric()
                            ->step(0.000001),
                        Forms\Components\TextInput::make('distance_to_institute')
                            ->numeric()
                            ->step(0.001)
                            ->suffix('km'),
                    ])
                    ->columns(3),

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
                            ->numeric()
                            ->prefix('$')
                            ->default(0),
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
