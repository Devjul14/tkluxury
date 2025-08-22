<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use Filament\Widgets\ChartWidget;

class TopPropertiesByRoomsWidget extends ChartWidget
{
    public static function canView(): bool
    {
        return false;
    }

    protected static ?string $heading = 'Top 5 Properties by Total Rooms';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $topProperties = Property::query()
            ->select('property_code', 'total_rooms')
            ->orderByDesc('total_rooms')
            ->limit(5)
            ->get();

        $labels = $topProperties->pluck('property_code')->toArray();
        $data = $topProperties->pluck('total_rooms')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Total Rooms',
                    'data' => $data,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.5)',  // green-500
                    'borderColor' => 'rgba(16, 185, 129, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
