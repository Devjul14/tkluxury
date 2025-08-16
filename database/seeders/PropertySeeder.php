<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Institute;
use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutes = Institute::all();

        $properties = [
            [
                'institute_id' => $institutes->where('code', 'UTS')->first()->id,
                'property_code' => 'UTS001',
                'title' => 'Modern Student Apartment near UTS',
                'description' => 'Beautiful modern apartment within walking distance to UTS campus. Features include WiFi, kitchen, and study area.',
                'property_type' => 'apartment',
                'address' => '123 Broadway',
                'city' => 'Ultimo',
                'state' => 'NSW',
                'postal_code' => '2007',
                'latitude' => -33.8833,
                'longitude' => 151.2,
                'distance_to_institute' => 0.5,
                'total_rooms' => 4,
                'available_rooms' => 2,
                'price_per_month' => 1200.0,
                'security_deposit' => 2400.0,
                'utility_costs_included' => true,
                'furnished' => true,
                'lease_duration_min' => 6,
                'lease_duration_max' => 12,
                'available_from' => now()->addDays(30),
                'maintenance_status' => 'excellent',
                'monthly_expenses' => 200.0,
                'down_payment_type' => 'percentage',
                'down_payment_value' => 10,
            ],
            [
                'institute_id' => $institutes->where('code', 'USYD')->first()->id,
                'property_code' => 'USYD001',
                'title' => 'Cozy Studio near University of Sydney',
                'description' => 'Perfect studio apartment for students. Close to campus with all essential amenities.',
                'property_type' => 'studio',
                'address' => '456 Glebe Point Road',
                'city' => 'Glebe',
                'state' => 'NSW',
                'postal_code' => '2037',
                'latitude' => -33.8885,
                'longitude' => 151.1873,
                'distance_to_institute' => 0.8,
                'total_rooms' => 1,
                'available_rooms' => 1,
                'price_per_month' => 900.0,
                'security_deposit' => 1800.0,
                'utility_costs_included' => false,
                'furnished' => true,
                'lease_duration_min' => 6,
                'lease_duration_max' => 12,
                'available_from' => now()->addDays(15),
                'maintenance_status' => 'good',
                'monthly_expenses' => 150.0,
                'down_payment_type' => 'percentage',
                'down_payment_value' => 10,
            ],
            [
                'institute_id' => $institutes->where('code', 'UNSW')->first()->id,
                'property_code' => 'UNSW001',
                'title' => 'Shared House near UNSW',
                'description' => 'Spacious shared house perfect for students. Large common areas and garden.',
                'property_type' => 'house',
                'address' => '789 Anzac Parade',
                'city' => 'Kensington',
                'state' => 'NSW',
                'postal_code' => '2033',
                'latitude' => -33.9173,
                'longitude' => 151.2313,
                'distance_to_institute' => 1.2,
                'total_rooms' => 5,
                'available_rooms' => 3,
                'price_per_month' => 800.0,
                'security_deposit' => 1600.0,
                'utility_costs_included' => true,
                'furnished' => false,
                'lease_duration_min' => 6,
                'lease_duration_max' => 12,
                'available_from' => now()->addDays(45),
                'maintenance_status' => 'good',
                'monthly_expenses' => 300.0,
                'down_payment_type' => 'fixed',
                'down_payment_value' => 100,
            ],
            [
                'institute_id' => $institutes->where('code', 'MQ')->first()->id,
                'property_code' => 'MQ001',
                'title' => 'Student Dormitory near Macquarie University',
                'description' => 'Modern dormitory-style accommodation with shared facilities and study areas.',
                'property_type' => 'dormitory',
                'address' => '321 Epping Road',
                'city' => 'Macquarie Park',
                'state' => 'NSW',
                'postal_code' => '2113',
                'latitude' => -33.7731,
                'longitude' => 151.1144,
                'distance_to_institute' => 0.3,
                'total_rooms' => 20,
                'available_rooms' => 8,
                'price_per_month' => 750.0,
                'security_deposit' => 1500.0,
                'utility_costs_included' => true,
                'furnished' => true,
                'lease_duration_min' => 6,
                'lease_duration_max' => 12,
                'available_from' => now()->addDays(60),
                'maintenance_status' => 'excellent',
                'monthly_expenses' => 400.0,
                'down_payment_type' => 'percentage',
                'down_payment_value' => 10,
            ],
        ];

        foreach ($properties as $propertyData) {
            $property = Property::create($propertyData);

            // Attach some features to each property
            $features = Feature::inRandomOrder()->limit(5)->get();
            $property->features()->attach($features);
        }
    }
}
