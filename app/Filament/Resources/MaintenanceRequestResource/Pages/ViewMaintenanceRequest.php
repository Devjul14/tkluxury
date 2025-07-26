<?php

namespace App\Filament\Resources\MaintenanceRequestResource\Pages;

use App\Filament\Resources\MaintenanceRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewMaintenanceRequest extends ViewRecord
{
    protected static string $resource = MaintenanceRequestResource::class;

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
                Infolists\Components\Section::make('Request Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('request_reference')
                            ->label('Request Reference'),
                        Infolists\Components\TextEntry::make('property.title')
                            ->label('Property'),
                        Infolists\Components\TextEntry::make('student.name')
                            ->label('Student'),
                        Infolists\Components\TextEntry::make('title')
                            ->label('Issue Title'),
                        Infolists\Components\TextEntry::make('priority')
                            ->label('Priority')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'low' => 'success',
                                'medium' => 'info',
                                'high' => 'warning',
                                'urgent' => 'danger',
                            }),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'assigned' => 'info',
                                'in_progress' => 'primary',
                                'completed' => 'success',
                                'cancelled' => 'gray',
                            }),
                    ])->columns(2),

                Infolists\Components\Section::make('Issue Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('description')
                            ->label('Description')
                            ->markdown()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('category')
                            ->label('Category')
                            ->badge(),
                        Infolists\Components\TextEntry::make('room_location')
                            ->label('Room Location')
                            ->badge(),
                    ])->columns(3),

                Infolists\Components\Section::make('Scheduling')
                    ->schema([
                        Infolists\Components\TextEntry::make('request_date')
                            ->label('Request Date')
                            ->date(),
                        Infolists\Components\TextEntry::make('preferred_date')
                            ->label('Preferred Date')
                            ->date(),
                        Infolists\Components\TextEntry::make('preferred_time_slot')
                            ->label('Preferred Time'),
                        Infolists\Components\TextEntry::make('completion_date')
                            ->label('Completion Date')
                            ->date(),
                    ])->columns(2),

                Infolists\Components\Section::make('Assignment')
                    ->schema([
                        Infolists\Components\TextEntry::make('assignedStaff.name')
                            ->label('Assigned Staff'),
                        Infolists\Components\TextEntry::make('estimated_cost')
                            ->label('Estimated Cost')
                            ->money('USD'),
                        Infolists\Components\TextEntry::make('actual_cost')
                            ->label('Actual Cost')
                            ->money('USD'),
                    ])->columns(3),

                Infolists\Components\Section::make('Additional Information')
                    ->schema([
                        Infolists\Components\ImageEntry::make('photos')
                            ->label('Photos')
                            ->circular()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('staff_notes')
                            ->label('Staff Notes')
                            ->markdown()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('resolution_notes')
                            ->label('Resolution Notes')
                            ->markdown()
                            ->columnSpanFull(),
                    ])->columns(1),
            ]);
    }
} 