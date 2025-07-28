<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Room;
use Illuminate\Support\Number;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        // Apply filters
        $rooms = Room::query();

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
            $checkIn = $request->check_in;
            $checkOut = $request->check_out;
            $rooms = $rooms->where('check_in', '>=', $checkIn)->where('check_out', '<=', $checkOut);
        }

        if ($request->filled('guests')) {
            $guests = $request->guests;
            $rooms = $rooms->where('capacity', '>=', $guests);
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
        $rangeSize = 100; // step per 100
        $ranges = [];

        foreach ($roomPrices as $price) {
            $min = floor($price / $rangeSize) * $rangeSize;
            $max = $min + $rangeSize - 1;

            // Kalau mau rentang terakhir open-ended
            if ($price > 1000) {
                $label = sprintf("%s+", Number::currency($min, env("APP_DEFAULT_CURRENCY", "USD")));
            } else {
                $label = sprintf("%s - %s", Number::currency($min, env("APP_DEFAULT_CURRENCY", "USD")), Number::currency($max, env("APP_DEFAULT_CURRENCY", "USD")));
            }

            $ranges[$label] = true;
        }

        $priceRanges = array_keys($ranges);

        return view('rooms.index', [
            'rooms' => $roomCollection,
            "pagedRooms" => $pagedRooms,
            "roomGuests" => Room::all()->pluck('capacity')->unique()->toArray(),
            "roomPrices" => $priceRanges,
        ]);
    }

    public function show($id)
    {
        // Sample room data
        // $room = (object) [
        //     'id' => $id,
        //     'name' => 'Superior Double Bed Private Ensuite',
        //     'description' => 'Comfortable double room with private bathroom, perfect for couples or solo travelers. This spacious room features a queen-size bed with premium linens, an en-suite bathroom with shower, and a beautiful city view. The room is equipped with modern amenities including air conditioning, free WiFi, a flat-screen TV, and a work desk.',
        //     'short_description' => 'Comfortable double room with private bathroom',
        //     'price' => 89,
        //     'image' => 'img/room-1.jpg',
        //     'main_image' => 'img/room-1.jpg',
        //     'type' => 'Private Room',
        //     'capacity' => 2,
        //     'rating' => 4.8,
        //     'size' => 25,
        //     'beds' => 1,
        //     'images' => collect([
        //         ['path' => 'img/room-1-1.jpg'],
        //         ['path' => 'img/room-1-2.jpg'],
        //         ['path' => 'img/room-1-3.jpg'],
        //         ['path' => 'img/room-1-4.jpg'],
        //     ]),
        //     'amenities' => collect([
        //         ['name' => 'Private Bathroom', 'icon' => 'shower'],
        //         ['name' => 'WiFi', 'icon' => 'wifi'],
        //         ['name' => 'Air Conditioning', 'icon' => 'conditioning'],
        //         ['name' => 'TV', 'icon' => 'room'],
        //         ['name' => 'Desk', 'icon' => 'room'],
        //         ['name' => 'Wardrobe', 'icon' => 'room'],
        //         ['name' => 'Hair Dryer', 'icon' => 'room'],
        //         ['name' => 'Towels', 'icon' => 'room'],
        //     ])->map(function ($amenity) {
        //         return (object) $amenity;
        //     }),
        //     'reviews' => collect([
        //         [
        //             'id' => 1,
        //             'rating' => 5,
        //             'comment' => 'Excellent room! Very clean and comfortable. The staff was friendly and helpful.',
        //             'created_at' => now()->subDays(2),
        //             'user' => (object) [
        //                 'name' => 'Sarah Johnson',
        //                 'avatar' => 'img/avatar-1.jpg',
        //             ],
        //         ],
        //         [
        //             'id' => 2,
        //             'rating' => 4,
        //             'comment' => 'Great location and good value for money. The room was clean and had everything we needed.',
        //             'created_at' => now()->subDays(5),
        //             'user' => (object) [
        //                 'name' => 'Mike Chen',
        //                 'avatar' => 'img/avatar-2.jpg',
        //             ],
        //         ],
        //         [
        //             'id' => 3,
        //             'rating' => 5,
        //             'comment' => 'Perfect stay! The room was spacious and the bathroom was spotless. Highly recommended!',
        //             'created_at' => now()->subDays(8),
        //             'user' => (object) [
        //                 'name' => 'Emma Davis',
        //                 'avatar' => 'img/avatar-3.jpg',
        //             ],
        //         ],
        //     ])->map(function ($review) {
        //         $review['created_at'] = \Carbon\Carbon::parse($review['created_at']);
        //         return (object) $review;
        //     }),
        // ];

        // Sample related rooms
        // $relatedRooms = collect([
        //     [
        //         'id' => 2,
        //         'name' => 'Deluxe Single Room',
        //         'description' => 'Cozy single room with modern amenities and city view.',
        //         'price' => 65,
        //         'image' => 'img/room-2.jpg',
        //     ],
        //     [
        //         'id' => 5,
        //         'name' => 'Premium Twin Room',
        //         'description' => 'Luxury twin room with two single beds and premium amenities.',
        //         'price' => 95,
        //         'image' => 'img/room-5.jpg',
        //     ],
        //     [
        //         'id' => 7,
        //         'name' => 'Family Room 4-Bed',
        //         'description' => 'Spacious family room with 4 beds, perfect for families.',
        //         'price' => 120,
        //         'image' => 'img/room-7.jpg',
        //     ],
        //     [
        //         'id' => 8,
        //         'name' => 'Deluxe Suite',
        //         'description' => 'Luxury suite with separate living area and premium amenities.',
        //         'price' => 150,
        //         'image' => 'img/room-8.jpg',
        //     ],
        // ])->map(function ($room) {
        //     return (object) $room;
        // });

        $room = Room::findOrFail($id);
        $relatedRooms = Room::where('id', '!=', $id)->get();
        return view('rooms.show', compact('room', 'relatedRooms'));
    }
}
