<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';

    public function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title'),
        ]);
    }
} 