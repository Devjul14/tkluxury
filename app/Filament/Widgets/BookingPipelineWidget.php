<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BookingPipelineWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $statuses = [
            'pending' => 'warning',
            'confirmed' => 'primary',
            'active' => 'success',
            'completed' => 'info',
            'cancelled' => 'danger',
        ];

        $today = now()->toDateString();
        $yesterday = now()->subDay()->toDateString();

        $stats = [];

        foreach ($statuses as $status => $color) {
            $total = Booking::where('status', $status)->count();
            $todayCount = Booking::where('status', $status)->whereDate('created_at', $today)->count();
            $yesterdayCount = Booking::where('status', $status)->whereDate('created_at', $yesterday)->count();

            $difference = $todayCount - $yesterdayCount;

            $description = match (true) {
                $difference > 0 => "+{$difference} dari kemarin",
                $difference < 0 => "{$difference} dari kemarin",
                default => 'Tidak berubah',
            };

            $descriptionColor = match (true) {
                $difference > 0 => 'success',
                $difference < 0 => 'danger',
                default => 'gray',
            };

            $descriptionIcon = match (true) {
                $difference > 0 => 'heroicon-m-arrow-trending-up',
                $difference < 0 => 'heroicon-m-arrow-trending-down',
                default => 'heroicon-m-minus',
            };

            $stats[] = Stat::make(ucfirst($status), $total)
                ->description($description)
                ->descriptionColor($color)
                ->descriptionIcon($descriptionIcon)
                ->color($color)
                ->chart([
                    $yesterdayCount,
                    $todayCount
                ]);
        }

        return $stats;
    }
}
