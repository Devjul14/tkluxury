<?php

namespace App\Filament\Resources\PropertyResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class NearbyPlacesRelationManager extends RelationManager
{
    protected static string $relationship = 'nearbyPlaces';

    public function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name'),
        ]);
    }
} 