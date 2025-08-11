<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use App\Filament\Resources\FeatureResource\RelationManagers;
use App\Models\Feature;
use App\Services\IconifyService;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'Property Management';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Feature Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('icon')
                            ->native(false)
                            ->options(function () {
                                $icons = IconifyService::getIcons();
                                return array_combine($icons, $icons);
                            })
                            ->suffixIcon(fn($state) => IconifyService::getIcon($state))
                            ->reactive()
                            ->searchable()
                            ->suffixIconColor(Color::Amber)
                            ->dehydrated(fn($state): array => ['icon' => $state])
                            ->afterStateUpdated(function ($record, $state) {
                                $record->refresh();
                            })
                            ->required(),
                        Forms\Components\Select::make('category')
                            ->native(false)
                            ->searchable()
                            ->options([
                                'amenities' => 'Amenities',
                                'accessibility' => 'Accessibility',
                                'safety' => 'Safety',
                                'study_spaces' => 'Study Spaces',
                                'entertainment' => 'Entertainment',
                                'utilities' => 'Utilities',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon'),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('properties_count')
                    ->counts('properties')
                    ->label('Properties'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'amenities' => 'Amenities',
                        'accessibility' => 'Accessibility',
                        'safety' => 'Safety',
                        'study_spaces' => 'Study Spaces',
                        'entertainment' => 'Entertainment',
                        'utilities' => 'Utilities',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active'),
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
            RelationManagers\PropertiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'view' => Pages\ViewFeature::route('/{record}'),
            'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
