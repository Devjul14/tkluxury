<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\LineChartWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RevenueChart extends LineChartWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Revenue';
    public ?string $filter = 'monthly';  // default filter

    public function getFilters(): ?array
    {
        return [
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
        ];
    }

    public static function canView(): bool
    {
        return in_array(auth()->user()->user_type, ['admin', 'staff']);
    }

    protected function getData(): array
    {
        $query = Booking::query()->where('status', 'completed');

        $labels = [];
        $taxData = [];
        $servicesData = [];
        $rentFeesData = [];

        switch ($this->filter) {
            case 'daily':
                $startDate = Carbon::now()->subDays(6)->startOfDay();
                $endDate = Carbon::now();

                $query->whereBetween('booking_date', [$startDate, $endDate]);

                $results = $query
                    ->selectRaw('DATE(booking_date) as label, SUM(tax) as tax, SUM(service_fee) as service, SUM(total_amount - tax - service_fee) as rent')
                    ->groupBy(DB::raw('DATE(booking_date)'))
                    ->orderBy(DB::raw('DATE(booking_date)'))
                    ->get()
                    ->keyBy('label');

                for ($i = 0; $i < 7; $i++) {
                    $date = $startDate->copy()->addDays($i)->format('Y-m-d');
                    $labels[] = Carbon::parse($date)->format('d M');

                    $taxData[] = (float) ($results[$date]->tax ?? 0);
                    $servicesData[] = (float) ($results[$date]->service ?? 0);
                    $rentFeesData[] = (float) ($results[$date]->rent ?? 0);
                }
                break;

            case 'weekly':
                $startDate = Carbon::now()->subWeeks(6)->startOfWeek();
                $endDate = Carbon::now();

                $query->whereBetween('booking_date', [$startDate, $endDate]);

                $results = $query
                    ->selectRaw('YEARWEEK(booking_date, 1) as label, SUM(tax) as tax, SUM(service_fee) as service, SUM(total_amount - tax - service_fee) as rent')
                    ->groupBy(DB::raw('YEARWEEK(booking_date, 1)'))
                    ->orderBy(DB::raw('YEARWEEK(booking_date, 1)'))
                    ->get()
                    ->keyBy('label');

                for ($i = 0; $i < 7; $i++) {
                    $weekDate = $startDate->copy()->addWeeks($i);
                    $key = $weekDate->format('oW');

                    $labels[] = 'W' . $weekDate->weekOfYear . ' ' . $weekDate->year;

                    $taxData[] = (float) ($results[$key]->tax ?? 0);
                    $servicesData[] = (float) ($results[$key]->service ?? 0);
                    $rentFeesData[] = (float) ($results[$key]->rent ?? 0);
                }
                break;

            default:  // monthly
                $startDate = Carbon::now()->subMonths(6)->startOfMonth();
                $endDate = Carbon::now();

                $query->whereBetween('booking_date', [$startDate, $endDate]);

                $results = $query
                    ->selectRaw('DATE_FORMAT(booking_date, "%Y-%m") as label, SUM(tax) as tax, SUM(service_fee) as service, SUM(total_amount - tax - service_fee) as rent')
                    ->groupBy(DB::raw('DATE_FORMAT(booking_date, "%Y-%m")'))
                    ->orderBy(DB::raw('DATE_FORMAT(booking_date, "%Y-%m")'))
                    ->get()
                    ->keyBy('label');

                for ($i = 0; $i < 7; $i++) {
                    $monthDate = $startDate->copy()->addMonths($i);
                    $key = $monthDate->format('Y-m');

                    $labels[] = $monthDate->format('M Y');

                    $taxData[] = (float) ($results[$key]->tax ?? 0);
                    $servicesData[] = (float) ($results[$key]->service ?? 0);
                    $rentFeesData[] = (float) ($results[$key]->rent ?? 0);
                }
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Tax',
                    'data' => $taxData,
                    'borderColor' => 'rgba(239, 68, 68, 0.8)',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.3)',
                ],
                [
                    'label' => 'Service Fee',
                    'data' => $servicesData,
                    'borderColor' => 'rgba(59, 130, 246, 0.8)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.3)',
                ],
                [
                    'label' => 'Rent Fee',
                    'data' => $rentFeesData,
                    'borderColor' => 'rgba(34, 197, 94, 0.8)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.3)',
                ],
            ],
        ];
    }
}
