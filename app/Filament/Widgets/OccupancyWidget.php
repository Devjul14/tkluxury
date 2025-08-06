<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class OccupancyWidget extends ChartWidget
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
            '5_years' => 'Last 5 Years',
        ];
    }

    protected function getData(): array
    {
        $labels = [];
        $occupiedData = [];
        $nonOccupiedData = [];

        $occupiedStatuses = ['confirmed', 'active', 'completed'];

        if ($this->filter === 'daily') {
            $startDate = Carbon::now()->subDays(6)->startOfDay();

            for ($i = 0; $i < 7; $i++) {
                $date = $startDate->copy()->addDays($i)->format('Y-m-d');

                $occupied = Booking::whereDate('booking_date', $date)
                    ->whereIn('status', $occupiedStatuses)
                    ->count();

                $nonOccupied = Booking::whereDate('booking_date', $date)
                    ->whereNotIn('status', $occupiedStatuses)
                    ->count();

                $labels[] = Carbon::parse($date)->format('d M');
                $occupiedData[] = $occupied;
                $nonOccupiedData[] = $nonOccupied;
            }
        } elseif ($this->filter === 'weekly') {
            $startDate = Carbon::now()->subWeeks(6)->startOfWeek();

            for ($i = 0; $i < 6; $i++) {
                $weekDate = $startDate->copy()->addWeeks($i);
                $start = $weekDate->startOfWeek();
                $end = $weekDate->endOfWeek();

                $occupied = Booking::whereBetween('booking_date', [$start, $end])
                    ->whereIn('status', $occupiedStatuses)
                    ->count();

                $nonOccupied = Booking::whereBetween('booking_date', [$start, $end])
                    ->whereNotIn('status', $occupiedStatuses)
                    ->count();

                $labels[] = $weekDate->format('d M Y');
                $occupiedData[] = $occupied;
                $nonOccupiedData[] = $nonOccupied;
            }
        } elseif ($this->filter === '5_years') {
            $startYear = Carbon::now()->subYears(4)->startOfYear();  // total 5 tahun termasuk tahun sekarang
            for ($i = 0; $i < 5; $i++) {
                $year = $startYear->copy()->addYears($i);
                $start = $year->copy()->startOfYear();
                $end = $year->copy()->endOfYear();

                $occupied = Booking::whereBetween('booking_date', [$start, $end])
                    ->whereIn('status', $occupiedStatuses)
                    ->count();

                $nonOccupied = Booking::whereBetween('booking_date', [$start, $end])
                    ->whereNotIn('status', $occupiedStatuses)
                    ->count();

                $labels[] = $year->format('Y');
                $occupiedData[] = $occupied;
                $nonOccupiedData[] = $nonOccupied;
            }
        } else {
            // yearly (13 bulan terakhir)
            $startDate = Carbon::now()->subMonths(12)->startOfMonth();

            for ($i = 1; $i <= 12; $i++) {
                $monthDate = $startDate->copy()->addMonths($i);
                $start = $monthDate->startOfMonth();
                $end = $monthDate->endOfMonth();

                $occupied = Booking::whereBetween('booking_date', [$start, $end])
                    ->whereIn('status', $occupiedStatuses)
                    ->count();

                $nonOccupied = Booking::whereBetween('booking_date', [$start, $end])
                    ->whereNotIn('status', $occupiedStatuses)
                    ->count();

                $labels[] = $monthDate->format('M Y');
                $occupiedData[] = $occupied;
                $nonOccupiedData[] = $nonOccupied;
            }
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Occupied',
                    'data' => $occupiedData,
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                ],
                [
                    'label' => 'Non-Occupied',
                    'data' => $nonOccupiedData,
                    'borderColor' => '#F59E0B',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.2)',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
