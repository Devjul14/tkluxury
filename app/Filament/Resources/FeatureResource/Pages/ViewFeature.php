<?php

namespace App\Filament\Resources\FeatureResource\Pages;

use App\Filament\Resources\FeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewFeature extends ViewRecord
{
    protected static string $resource = FeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Feature Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Feature Name'),
                        Infolists\Components\TextEntry::make('icon')
                            ->label('Icon'),
                        Infolists\Components\TextEntry::make('category')
                            ->label('Category')
                            ->badge(),
                        Infolists\Components\TextEntry::make('description')
                            ->label('Description')
                            ->markdown()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('is_active')
                            ->label('Active Status')
                            ->formatStateUsing(fn ($state) => $state ? 'Active' : 'Inactive')
                            ->icon(fn ($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn ($state) => $state ? 'success' : 'danger'),
                    ])->columns(2),

                Infolists\Components\Section::make('Statistics')
                    ->schema([
                        Infolists\Components\TextEntry::make('properties_count')
                            ->label('Properties with this Feature')
                            ->state(fn ($record) => $record->properties()->count()),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Created')
                            ->dateTime(),
                        Infolists\Components\TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime(),
                    ])->columns(3),
            ]);
    }
} 