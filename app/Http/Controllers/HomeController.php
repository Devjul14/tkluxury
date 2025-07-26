<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Sample featured rooms data
        $featuredRooms = [
            [
                'id' => 1,
                'name' => 'Superior Double Bed Private Ensuite',
                'description' => 'Comfortable double room with private bathroom, perfect for couples or solo travelers.',
                'price' => 89,
                'image' => 'img/room-1.jpg',
                'type' => 'Private Room',
                'capacity' => 2,
                'rating' => 4.8,
                'is_featured' => true,
            ],
            [
                'id' => 2,
                'name' => 'Deluxe Single Room',
                'description' => 'Cozy single room with modern amenities and city view.',
                'price' => 65,
                'image' => 'img/room-2.jpg',
                'type' => 'Single Room',
                'capacity' => 1,
                'rating' => 4.6,
                'is_featured' => true,
            ],
            [
                'id' => 3,
                'name' => 'Mixed Dormitory 6-Bed',
                'description' => 'Spacious dormitory with 6 comfortable beds and shared facilities.',
                'price' => 25,
                'image' => 'img/room-3.jpg',
                'type' => 'Dormitory',
                'capacity' => 6,
                'rating' => 4.4,
                'is_featured' => true,
            ],
            [
                'id' => 4,
                'name' => 'Female Dormitory 4-Bed',
                'description' => 'Exclusive female dormitory with 4 beds and enhanced security.',
                'price' => 28,
                'image' => 'img/room-4.jpg',
                'type' => 'Dormitory',
                'capacity' => 4,
                'rating' => 4.7,
                'is_featured' => true,
            ],
            [
                'id' => 5,
                'name' => 'Premium Twin Room',
                'description' => 'Luxury twin room with two single beds and premium amenities.',
                'price' => 95,
                'image' => 'img/room-5.jpg',
                'type' => 'Twin Room',
                'capacity' => 2,
                'rating' => 4.9,
                'is_featured' => true,
            ],
            [
                'id' => 6,
                'name' => 'Budget Single Room',
                'description' => 'Affordable single room with all essential amenities.',
                'price' => 45,
                'image' => 'img/room-6.jpg',
                'type' => 'Single Room',
                'capacity' => 1,
                'rating' => 4.3,
                'is_featured' => true,
            ],
        ];

        // Convert to objects for easier use in Blade templates
        $featuredRooms = collect($featuredRooms)->map(function ($room) {
            return (object) $room;
        });

        return view('home', compact('featuredRooms'));
    }
} 