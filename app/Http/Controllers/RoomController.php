<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Number;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        // Apply filters
        $rooms = Room::query()->where('is_available', true);

        // Filter by price range
        if ($request->filled('price_range')) {
            // price_range, ex: $100+, IDR100-IDR200+
            $priceRange = preg_replace('/[^0-9-]/', '', $request->price_range);
            $priceRange = explode('-', $priceRange);
            $priceRange = array_map(function ($price) {
                return (int) $price;
            }, $priceRange);

            $rooms = $rooms->whereBetween('price_per_month', $priceRange);
        }

        // Filter by room type
        if ($request->filled('room_type')) {
            $roomType = $request->room_type;
            $rooms = $rooms->where('room_type', 'like', '%' . ucfirst($roomType) . '%');
        }

        // Filter by check-in and check-out dates
        if ($request->filled('check_in') && $request->filled('check_out')) {
            $rooms->whereDoesntHave('bookings', function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q
                        ->where('check_in_date', '<', $request->check_out)
                        ->where('check_out_date', '>', $request->check_in);
                });
            });
        }

        if ($request->filled('student')) {
            $rooms->where('capacity', '>=', $request->student);
        }

        // Paginate results
        $perPage = config('hostel.rooms.per_page', 12);
        $roomCollection = $rooms->get();
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $pagedRooms = new LengthAwarePaginator(
            $roomCollection->forPage($currentPage, $perPage)->values(),
            $roomCollection->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $roomPrices = Room::pluck('price_per_month')->unique()->sort()->values()->toArray();

        array_unshift($roomPrices, 0);
        $rangeSize = 100;  // step per 100
        $ranges = [];

        foreach ($roomPrices as $price) {
            $min = floor($price / $rangeSize) * $rangeSize;
            $max = $min + $rangeSize - 1;

            // Kalau mau rentang terakhir open-ended
            if ($price > 1000) {
                $label = sprintf('%s+', Number::currency($min, env('APP_DEFAULT_CURRENCY', 'USD')));
            } else {
                $label = sprintf('%s - %s', Number::currency($min, env('APP_DEFAULT_CURRENCY', 'USD')), Number::currency($max, env('APP_DEFAULT_CURRENCY', 'USD')));
            }

            $ranges[$label] = true;
        }

        $priceRanges = array_keys($ranges);

        return view('rooms.index', [
            'rooms' => $pagedRooms,
            'pagedRooms' => $pagedRooms,
            'roomGuests' => Room::all()->pluck('capacity')->unique()->toArray(),
            'roomPrices' => $priceRanges,
            'roomTypes' => Room::all()->pluck('room_type')->unique()->toArray(),
        ]);
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        $relatedRooms = Room::where('id', '!=', $id)->get();
        $services = Service::where('status', 'active')
            ->orderBy('title', 'asc')
            ->get();
        return view('rooms.show', compact('room', 'relatedRooms', 'services'));
    }
}
