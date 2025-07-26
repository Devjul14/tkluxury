<?php

namespace App\Filament\Resources\PropertyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $recordTitleAttribute = 'image_path';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image_path')
                    ->image()
                    ->directory('properties/images')
                    ->required(),
                Forms\Components\TextInput::make('alt_text')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_primary')
                    ->required(),
                Forms\Components\Select::make('room_type')
                    ->options([
                        'common_area' => 'Common Area',
                        'bedroom' => 'Bedroom',
                        'bathroom' => 'Bathroom',
                        'kitchen' => 'Kitchen',
                        'exterior' => 'Exterior',
                    ]),
                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('image_path')
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->circular(),
                Tables\Columns\TextColumn::make('alt_text')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_primary')
                    ->boolean()
                    ->label('Primary'),
                Tables\Columns\TextColumn::make('room_type')
                    ->badge(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('room_type')
                    ->options([
                        'common_area' => 'Common Area',
                        'bedroom' => 'Bedroom',
                        'bathroom' => 'Bathroom',
                        'kitchen' => 'Kitchen',
                        'exterior' => 'Exterior',
                    ]),
                Tables\Filters\TernaryFilter::make('is_primary'),
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
            ])
            ->defaultSort('sort_order');
    }
} 