<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstituteResource\Pages;
use App\Filament\Resources\InstituteResource\RelationManagers;
use App\Models\Institute;
use Dotswan\MapPicker\Fields\Map;
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

class InstituteResource extends Resource
{
    protected static ?string $model = Institute::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function getNavigationGroup(): ?string
    {
        return __('navigations.group_properties');
    }

    public static function getNavigationLabel(): string
    {
        return __('navigations.institutes');
    }

    public static function getModelLabel(): string
    {
        return __('navigations.institute');
    }

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(50),
                        Forms\Components\Textarea::make('description')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('contact_email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('website')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(3),
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
                        Forms\Components\TextInput::make('country')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('postal_code')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Location Map')
                    ->schema([
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
                            ]),
                        ViewField::make('location_map')
                            ->label('Location on Map')
                            ->view('forms.components.google-maps-location')
                            ->columnSpanFull()
                            ->hiddenLabel(),
                    ])
                    ->columns(1),
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->image()
                            ->directory('institutes/logos'),
                        Forms\Components\Select::make('partnership_status')
                            ->options([
                                'active' => 'Active',
                                'pending' => 'Pending',
                                'inactive' => 'Inactive',
                            ])
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->required(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('partnership_status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'inactive' => 'danger',
                    }),
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
                Tables\Filters\SelectFilter::make('partnership_status')
                    ->options([
                        'active' => 'Active',
                        'pending' => 'Pending',
                        'inactive' => 'Inactive',
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
            RelationManagers\StudentProfilesRelationManager::class,
            RelationManagers\ContractTemplatesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInstitutes::route('/'),
            'create' => Pages\CreateInstitute::route('/create'),
            'view' => Pages\ViewInstitute::route('/{record}'),
            'edit' => Pages\EditInstitute::route('/{record}/edit'),
        ];
    }
}
