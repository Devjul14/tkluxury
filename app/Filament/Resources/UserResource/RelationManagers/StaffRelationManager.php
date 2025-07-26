<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class StaffRelationManager extends RelationManager
{
    protected static string $relationship = 'staff';

    public function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name'),
        ]);
    }
} 