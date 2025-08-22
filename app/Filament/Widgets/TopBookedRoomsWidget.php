<?php

namespace App\Filament\Widgets;

use App\Models\Room;
use Filament\Widgets\ChartWidget;

class TopBookedRoomsWidget extends ChartWidget
{
    public static function canView(): bool
    {
        return false;
    }

    protected static ?string $heading = 'Top 5 Most Booked Rooms';
    protected static ?int $sort = 5;

    protected function getData(): array
    {
        $topRooms = Room::withCount('bookings')
            ->orderByDesc('bookings_count')
            ->limit(5)
            ->get();

        $labels = $topRooms->map(function ($room) {
            return $room->full_room_number ?? "Room #{$room->id}";
        })->toArray();

        $data = $topRooms->pluck('bookings_count')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Total Bookings',
                    'data' => $data,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.5)',  // Tailwind blue-500
                    'borderColor' => 'rgba(59, 130, 246, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';  // Chart.js default is vertical; use CSS options to flip if needed
    }
}
