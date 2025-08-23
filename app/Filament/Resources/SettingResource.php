<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Components\{TextInput, Select, Textarea, FileUpload, Toggle};
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // public static function getNavigationLabel(): string
    // {
    //     return 'Site Settings';
    // }

    // public static function getNavigationGroup(): ?string
    // {
    //     return 'Configuration';
    // }

    public static function getNavigationLabel(): string
    {
        return __('navigations.settings');
    }

    public static function getModelLabel(): string
    {
        return __('navigations.settings');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('navigations.group_configurations');
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-cog';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function getNavigationSort(): int
    {
        return 9999;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('group')
                    ->options([
                        'homepage' => 'Homepage',
                        'seo' => 'SEO',
                        'footer' => 'Footer',
                        'general' => 'General',
                    ])
                    ->native(false)
                    ->required(),
                TextInput::make('key')
                    ->required()
                    ->unique(ignoreRecord: true),
                Select::make('type')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'boolean' => 'Boolean',
                        'image' => 'Image',
                        'json' => 'JSON',
                        'map' => 'Map',
                    ])
                    ->native(false)
                    ->required()
                    ->reactive(),
                // Dinamis tergantung 'type'
                TextInput::make('value')
                    ->label('Value')
                    ->visible(fn($get) => $get('type') === 'text'),
                Textarea::make('value')
                    ->label('Value')
                    ->visible(fn($get) => $get('type') === 'textarea'),
                Toggle::make('value')
                    ->label('Value')
                    ->visible(fn($get) => $get('type') === 'boolean'),
                FileUpload::make('value')
                    ->label('Value')
                    ->disk('public')
                    ->directory('settings')
                    ->visible(fn($get) => $get('type') === 'image'),
                Select::make('parent_id')
                    ->label('Parent Setting')
                    ->relationship('parent', 'key')
                    ->native(false)
                    ->nullable(),
                Hidden::make('value')
                    ->visible(fn($get) => $get('type') === 'map'),
                Map::make('map')
                    ->visible(fn($get) => $get('type') === 'map')
                    ->label('Location')
                    ->columnSpanFull()
                    ->defaultLocation(latitude: 3.139003, longitude: 101.686855)
                    ->draggable(true)
                    ->clickable(true)
                    ->zoom(10)
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
                        $coordinates = explode(',', $record->value);
                        if ($coordinates && count($coordinates) === 2) {
                            $set('map', [
                                'lat' => (float) $coordinates[0],
                                'lng' => (float) $coordinates[1],
                            ]);
                        }
                    })
                    ->afterStateUpdated(function ($state, Set $set) {
                        if (is_array($state) && isset($state['lat'], $state['lng'])) {
                            $set('value', sprintf('%f,%f', $state['lat'], $state['lng']));
                        }
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group'),
                TextColumn::make('key'),
                TextColumn::make('value')->limit(50),
                TextColumn::make('type'),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->options([
                        'homepage' => 'Homepage',
                        'seo' => 'SEO',
                        'footer' => 'Footer',
                        'general' => 'General',
                    ]),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
