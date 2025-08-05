<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class OccupancyRateWidget extends ChartWidget
{
    protected static ?string $heading = 'Occupancy Rate';
    protected static ?int $sort = 3;

    public ?string $filter = 'yearly';

    public static function canView(): bool
    {
        return in_array(auth()->user()->user_type, ['admin', 'staff']);
    }

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
        $this->reset();
    }

    protected function getFilters(): ?array
    {
        return [
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'yearly' => 'Yearly',
        ];
    }

    protected function getData(): array
    {
        $query = Booking::query();
        $labels = [];
        $data = [];

        if ($this->filter === 'daily') {
            $startDate = Carbon::now()->subDays(6)->startOfDay();

            for ($i = 0; $i < 7; $i++) {
                $date = $startDate->copy()->addDays($i)->format('Y-m-d');

                $total = Booking::whereDate('booking_date', $date)->count();
                $occupied = Booking::whereDate('booking_date', $date)
                    ->whereIn('status', ['confirmed', 'active', 'completed'])
                    ->count();

                $rate = $total > 0 ? round(($occupied / $total) * 100, 2) : 0;

                $labels[] = Carbon::parse($date)->format('d M');
                $data[] = $rate;
            }
        } elseif ($this->filter === 'weekly') {
            $startDate = Carbon::now()->subWeeks(6)->startOfWeek();

            for ($i = 0; $i < 6; $i++) {
                $weekDate = $startDate->copy()->addWeeks($i);
                $start = $weekDate->startOfWeek();
                $end = $weekDate->endOfWeek();

                $total = Booking::whereBetween('booking_date', [$start, $end])->count();
                $occupied = Booking::whereBetween('booking_date', [$start, $end])
                    ->whereIn('status', ['confirmed', 'active', 'completed'])
                    ->count();

                $rate = $total > 0 ? round(($occupied / $total) * 100, 2) : 0;

                $labels[] = Carbon::parse($weekDate)->format('d M Y');
                $data[] = $rate;
            }
        } else {
            // default yearly (6 bulan terakhir)
            $startDate = Carbon::now()->subMonths(12)->startOfMonth();

            for ($i = 0; $i < 13; $i++) {
                $monthDate = $startDate->copy()->addMonths($i);
                $start = $monthDate->startOfMonth();
                $end = $monthDate->endOfMonth();

                $total = Booking::whereBetween('booking_date', [$start, $end])->count();
                $occupied = Booking::whereBetween('booking_date', [$start, $end])
                    ->whereIn('status', ['confirmed', 'active', 'completed'])
                    ->count();
                $rate = $total > 0 ? round(($occupied / $total) * 100, 2) : 0;

                $labels[] = $monthDate->format('M Y');
                $data[] = $rate;
            }
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Occupancy Rate (%)',
                    'data' => $data,
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
