<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = Property::all();

        foreach ($properties as $property) {
            // Create different types of rooms for each property
            $roomTypes = ['single', 'double', 'triple', 'studio'];
            $prices = [800, 1200, 1500, 2000];

            for ($i = 1; $i <= 30; $i++) {
                $roomType = $roomTypes[rand(0, 3)];
                $price = $prices[rand(0, 3)];
                $capacity = rand(1, 4);

                Room::create([
                    'property_id' => $property->id,
                    'room_number' => sprintf('%s-%s', preg_replace('/\d/', '', $property->property_code), str_pad($i, 2, '0', STR_PAD_LEFT)),
                    'room_type' => $roomType,
                    'floor_number' => rand(1, 3),
                    'size_sqm' => rand(15, 35),
                    'capacity' => $capacity,
                    'price_per_month' => $price,
                    'security_deposit' => $price * 0.5,
                    'is_available' => rand(0, 1),
                    'is_furnished' => rand(0, 1),
                    'has_private_bathroom' => rand(0, 1),
                    'has_balcony' => rand(0, 1),
                    'has_air_conditioning' => rand(0, 1),
                    'has_heating' => rand(0, 1),
                    'description' => "Comfortable {$roomType} room with modern amenities.",
                    'amenities' => ['WiFi', 'Study Desk', 'Wardrobe'],
                    'maintenance_status' => ['excellent', 'good', 'fair'][rand(0, 2)],
                    'last_inspection_date' => now()->subDays(rand(1, 30)),
                    'notes' => 'Sample room for testing purposes.',
                ]);
            }
        }
    }
}
