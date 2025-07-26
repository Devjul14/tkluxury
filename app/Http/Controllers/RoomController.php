<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        // Sample rooms data
        $allRooms = [
            [
                'id' => 1,
                'name' => 'Superior Double Bed Private Ensuite',
                'description' => 'Comfortable double room with private bathroom, perfect for couples or solo travelers. Features a queen-size bed, en-suite bathroom, and city view.',
                'price' => 89,
                'image' => 'img/hero.webp',
                'type' => 'Private Room',
                'capacity' => 2,
                'rating' => 4.8,
                'is_featured' => true,
                'size' => 25,
                'beds' => 1,
                'amenities' => [
                    ['name' => 'Private Bathroom', 'icon' => 'shower'],
                    ['name' => 'WiFi', 'icon' => 'wifi'],
                    ['name' => 'Air Conditioning', 'icon' => 'conditioning'],
                ],
            ],
            [
                'id' => 2,
                'name' => 'Deluxe Single Room',
                'description' => 'Cozy single room with modern amenities and city view. Perfect for solo travelers seeking comfort and privacy.',
                'price' => 65,
                'image' => 'img/hero.webp',
                'type' => 'Single Room',
                'capacity' => 1,
                'rating' => 4.6,
                'is_featured' => true,
                'size' => 18,
                'beds' => 1,
                'amenities' => [
                    ['name' => 'Shared Bathroom', 'icon' => 'shower'],
                    ['name' => 'WiFi', 'icon' => 'wifi'],
                    ['name' => 'Desk', 'icon' => 'room'],
                ],
            ],
            [
                'id' => 3,
                'name' => 'Mixed Dormitory 6-Bed',
                'description' => 'Spacious dormitory with 6 comfortable beds and shared facilities. Great for budget travelers and social experiences.',
                'price' => 25,
                'image' => 'img/room-3.jpg',
                'type' => 'Dormitory',
                'capacity' => 6,
                'rating' => 4.4,
                'is_featured' => true,
                'size' => 35,
                'beds' => 6,
                'amenities' => [
                    ['name' => 'Shared Bathroom', 'icon' => 'shower'],
                    ['name' => 'WiFi', 'icon' => 'wifi'],
                    ['name' => 'Lockers', 'icon' => 'keys'],
                ],
            ],
            [
                'id' => 4,
                'name' => 'Female Dormitory 4-Bed',
                'description' => 'Exclusive female dormitory with 4 beds and enhanced security. Perfect for female travelers seeking a safe environment.',
                'price' => 28,
                'image' => 'img/room-4.jpg',
                'type' => 'Dormitory',
                'capacity' => 4,
                'rating' => 4.7,
                'is_featured' => true,
                'size' => 28,
                'beds' => 4,
                'amenities' => [
                    ['name' => 'Shared Bathroom', 'icon' => 'shower'],
                    ['name' => 'WiFi', 'icon' => 'wifi'],
                    ['name' => 'Security Lock', 'icon' => 'keys'],
                ],
            ],
            [
                'id' => 5,
                'name' => 'Premium Twin Room',
                'description' => 'Luxury twin room with two single beds and premium amenities. Ideal for friends traveling together.',
                'price' => 95,
                'image' => 'img/room-5.jpg',
                'type' => 'Twin Room',
                'capacity' => 2,
                'rating' => 4.9,
                'is_featured' => true,
                'size' => 30,
                'beds' => 2,
                'amenities' => [
                    ['name' => 'Private Bathroom', 'icon' => 'shower'],
                    ['name' => 'WiFi', 'icon' => 'wifi'],
                    ['name' => 'Mini Bar', 'icon' => 'minibar'],
                ],
            ],
            [
                'id' => 6,
                'name' => 'Budget Single Room',
                'description' => 'Affordable single room with all essential amenities. Perfect for budget-conscious travelers.',
                'price' => 45,
                'image' => 'img/room-6.jpg',
                'type' => 'Single Room',
                'capacity' => 1,
                'rating' => 4.3,
                'is_featured' => false,
                'size' => 15,
                'beds' => 1,
                'amenities' => [
                    ['name' => 'Shared Bathroom', 'icon' => 'shower'],
                    ['name' => 'WiFi', 'icon' => 'wifi'],
                    ['name' => 'Basic Amenities', 'icon' => 'room'],
                ],
            ],
            [
                'id' => 7,
                'name' => 'Family Room 4-Bed',
                'description' => 'Spacious family room with 4 beds, perfect for families or groups of friends.',
                'price' => 120,
                'image' => 'img/room-7.jpg',
                'type' => 'Family Room',
                'capacity' => 4,
                'rating' => 4.5,
                'is_featured' => false,
                'size' => 40,
                'beds' => 4,
                'amenities' => [
                    ['name' => 'Private Bathroom', 'icon' => 'shower'],
                    ['name' => 'WiFi', 'icon' => 'wifi'],
                    ['name' => 'TV', 'icon' => 'room'],
                ],
            ],
            [
                'id' => 8,
                'name' => 'Deluxe Suite',
                'description' => 'Luxury suite with separate living area and premium amenities. The ultimate comfort experience.',
                'price' => 150,
                'image' => 'img/room-8.jpg',
                'type' => 'Suite',
                'capacity' => 3,
                'rating' => 5.0,
                'is_featured' => false,
                'size' => 50,
                'beds' => 2,
                'amenities' => [
                    ['name' => 'Private Bathroom', 'icon' => 'shower'],
                    ['name' => 'WiFi', 'icon' => 'wifi'],
                    ['name' => 'Balcony', 'icon' => 'room'],
                ],
            ],
        ];

        // Convert to objects
        $allRooms = collect($allRooms)->map(function ($room) {
            $room['amenities'] = collect($room['amenities'])->map(function ($amenity) {
                return (object) $amenity;
            });
            return (object) $room;
        });

        // Apply filters
        $rooms = $allRooms;

        // Filter by price range
        if ($request->filled('price_range')) {
            $priceRange = $request->price_range;
            switch ($priceRange) {
                case '0-50':
                    $rooms = $rooms->where('price', '<=', 50);
                    break;
                case '50-100':
                    $rooms = $rooms->where('price', '>', 50)->where('price', '<=', 100);
                    break;
                case '100-150':
                    $rooms = $rooms->where('price', '>', 100)->where('price', '<=', 150);
                    break;
                case '150+':
                    $rooms = $rooms->where('price', '>', 150);
                    break;
            }
        }

        // Filter by room type
        if ($request->filled('room_type')) {
            $roomType = $request->room_type;
            $rooms = $rooms->where('type', 'like', '%' . ucfirst($roomType) . '%');
        }

        // Paginate results
        $perPage = config('hostel.rooms.per_page', 12);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $pagedRooms = new LengthAwarePaginator(
            $rooms->forPage($currentPage, $perPage)->values(),
            $rooms->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('rooms.index', ['rooms' => $pagedRooms]);
    }

    public function show($id)
    {
        // Sample room data
        $room = (object) [
            'id' => $id,
            'name' => 'Superior Double Bed Private Ensuite',
            'description' => 'Comfortable double room with private bathroom, perfect for couples or solo travelers. This spacious room features a queen-size bed with premium linens, an en-suite bathroom with shower, and a beautiful city view. The room is equipped with modern amenities including air conditioning, free WiFi, a flat-screen TV, and a work desk.',
            'short_description' => 'Comfortable double room with private bathroom',
            'price' => 89,
            'image' => 'img/room-1.jpg',
            'main_image' => 'img/room-1.jpg',
            'type' => 'Private Room',
            'capacity' => 2,
            'rating' => 4.8,
            'size' => 25,
            'beds' => 1,
            'images' => collect([
                ['path' => 'img/room-1-1.jpg'],
                ['path' => 'img/room-1-2.jpg'],
                ['path' => 'img/room-1-3.jpg'],
                ['path' => 'img/room-1-4.jpg'],
            ]),
            'amenities' => collect([
                ['name' => 'Private Bathroom', 'icon' => 'shower'],
                ['name' => 'WiFi', 'icon' => 'wifi'],
                ['name' => 'Air Conditioning', 'icon' => 'conditioning'],
                ['name' => 'TV', 'icon' => 'room'],
                ['name' => 'Desk', 'icon' => 'room'],
                ['name' => 'Wardrobe', 'icon' => 'room'],
                ['name' => 'Hair Dryer', 'icon' => 'room'],
                ['name' => 'Towels', 'icon' => 'room'],
            ])->map(function ($amenity) {
                return (object) $amenity;
            }),
            'reviews' => collect([
                [
                    'id' => 1,
                    'rating' => 5,
                    'comment' => 'Excellent room! Very clean and comfortable. The staff was friendly and helpful.',
                    'created_at' => now()->subDays(2),
                    'user' => (object) [
                        'name' => 'Sarah Johnson',
                        'avatar' => 'img/avatar-1.jpg',
                    ],
                ],
                [
                    'id' => 2,
                    'rating' => 4,
                    'comment' => 'Great location and good value for money. The room was clean and had everything we needed.',
                    'created_at' => now()->subDays(5),
                    'user' => (object) [
                        'name' => 'Mike Chen',
                        'avatar' => 'img/avatar-2.jpg',
                    ],
                ],
                [
                    'id' => 3,
                    'rating' => 5,
                    'comment' => 'Perfect stay! The room was spacious and the bathroom was spotless. Highly recommended!',
                    'created_at' => now()->subDays(8),
                    'user' => (object) [
                        'name' => 'Emma Davis',
                        'avatar' => 'img/avatar-3.jpg',
                    ],
                ],
            ])->map(function ($review) {
                $review['created_at'] = \Carbon\Carbon::parse($review['created_at']);
                return (object) $review;
            }),
        ];

        // Sample related rooms
        $relatedRooms = collect([
            [
                'id' => 2,
                'name' => 'Deluxe Single Room',
                'description' => 'Cozy single room with modern amenities and city view.',
                'price' => 65,
                'image' => 'img/room-2.jpg',
            ],
            [
                'id' => 5,
                'name' => 'Premium Twin Room',
                'description' => 'Luxury twin room with two single beds and premium amenities.',
                'price' => 95,
                'image' => 'img/room-5.jpg',
            ],
            [
                'id' => 7,
                'name' => 'Family Room 4-Bed',
                'description' => 'Spacious family room with 4 beds, perfect for families.',
                'price' => 120,
                'image' => 'img/room-7.jpg',
            ],
            [
                'id' => 8,
                'name' => 'Deluxe Suite',
                'description' => 'Luxury suite with separate living area and premium amenities.',
                'price' => 150,
                'image' => 'img/room-8.jpg',
            ],
        ])->map(function ($room) {
            return (object) $room;
        });

        return view('rooms.show', compact('room', 'relatedRooms'));
    }
} 