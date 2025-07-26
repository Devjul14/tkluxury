<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewReview extends ViewRecord
{
    protected static string $resource = ReviewResource::class;

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
                Infolists\Components\Section::make('Review Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('title')
                            ->label('Review Title'),
                        Infolists\Components\TextEntry::make('student.name')
                            ->label('Student'),
                        Infolists\Components\TextEntry::make('property.title')
                            ->label('Property'),
                        Infolists\Components\TextEntry::make('content')
                            ->label('Review Content')
                            ->markdown()
                            ->columnSpanFull(),
                    ])->columns(2),

                Infolists\Components\Section::make('Ratings')
                    ->schema([
                        Infolists\Components\TextEntry::make('overall_rating')
                            ->label('Overall Rating')
                            ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state)),
                        Infolists\Components\TextEntry::make('cleanliness_rating')
                            ->label('Cleanliness')
                            ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state)),
                        Infolists\Components\TextEntry::make('location_rating')
                            ->label('Location')
                            ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state)),
                        Infolists\Components\TextEntry::make('value_rating')
                            ->label('Value for Money')
                            ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state)),
                        Infolists\Components\TextEntry::make('maintenance_rating')
                            ->label('Maintenance')
                            ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state)),
                        Infolists\Components\TextEntry::make('noise_level_rating')
                            ->label('Noise Level')
                            ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state)),
                    ])->columns(3),

                Infolists\Components\Section::make('Review Status')
                    ->schema([
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'approved' => 'success',
                                'rejected' => 'danger',
                                'flagged' => 'info',
                            }),
                        Infolists\Components\TextEntry::make('is_verified')
                            ->label('Verified')
                            ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')
                            ->icon(fn ($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn ($state) => $state ? 'success' : 'danger'),
                        Infolists\Components\TextEntry::make('is_featured')
                            ->label('Featured')
                            ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')
                            ->icon(fn ($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn ($state) => $state ? 'success' : 'danger'),
                        Infolists\Components\TextEntry::make('review_date')
                            ->label('Review Date')
                            ->date(),
                    ])->columns(2),

                Infolists\Components\Section::make('Additional Information')
                    ->schema([
                        Infolists\Components\ImageEntry::make('photos')
                            ->label('Photos')
                            ->circular()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('admin_notes')
                            ->label('Admin Notes')
                            ->markdown()
                            ->columnSpanFull(),
                    ])->columns(1),
            ]);
    }
} 