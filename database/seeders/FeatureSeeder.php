<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            // Amenities
            [
                'name' => 'WiFi',
                'icon' => 'wifi',
                'category' => 'amenities',
                'description' => 'High-speed internet access',
            ],
            [
                'name' => 'Parking',
                'icon' => 'car',
                'category' => 'amenities',
                'description' => 'On-site parking available',
            ],
            [
                'name' => 'Gym',
                'icon' => 'dumbbell',
                'category' => 'amenities',
                'description' => 'Fitness center access',
            ],
            [
                'name' => 'Laundry',
                'icon' => 'tshirt',
                'category' => 'amenities',
                'description' => 'Washing and drying facilities',
            ],
            [
                'name' => 'Kitchen',
                'icon' => 'utensils',
                'category' => 'amenities',
                'description' => 'Fully equipped kitchen',
            ],
            [
                'name' => 'Balcony',
                'icon' => 'home',
                'category' => 'amenities',
                'description' => 'Private balcony or terrace',
            ],
            [
                'name' => 'Air Conditioning',
                'icon' => 'snowflake',
                'category' => 'amenities',
                'description' => 'Climate control system',
            ],
            [
                'name' => 'Heating',
                'icon' => 'thermometer-half',
                'category' => 'amenities',
                'description' => 'Central heating system',
            ],
            
            // Accessibility
            [
                'name' => 'Wheelchair Accessible',
                'icon' => 'wheelchair',
                'category' => 'accessibility',
                'description' => 'Wheelchair accessible facilities',
            ],
            [
                'name' => 'Elevator',
                'icon' => 'arrow-up',
                'category' => 'accessibility',
                'description' => 'Elevator access to all floors',
            ],
            [
                'name' => 'Ground Floor',
                'icon' => 'house',
                'category' => 'accessibility',
                'description' => 'Ground floor accommodation',
            ],
            
            // Safety
            [
                'name' => 'Security System',
                'icon' => 'shield-alt',
                'category' => 'safety',
                'description' => '24/7 security monitoring',
            ],
            [
                'name' => 'Fire Alarm',
                'icon' => 'fire',
                'category' => 'safety',
                'description' => 'Fire detection and alarm system',
            ],
            [
                'name' => 'CCTV',
                'icon' => 'video',
                'category' => 'safety',
                'description' => 'Closed-circuit television monitoring',
            ],
            [
                'name' => 'Secure Entry',
                'icon' => 'lock',
                'category' => 'safety',
                'description' => 'Secure building entry system',
            ],
            
            // Study Spaces
            [
                'name' => 'Study Room',
                'icon' => 'book',
                'category' => 'study_spaces',
                'description' => 'Dedicated study area',
            ],
            [
                'name' => 'Library Access',
                'icon' => 'library',
                'category' => 'study_spaces',
                'description' => 'Access to university library',
            ],
            [
                'name' => 'Quiet Hours',
                'icon' => 'volume-mute',
                'category' => 'study_spaces',
                'description' => 'Designated quiet study hours',
            ],
            [
                'name' => 'Computer Lab',
                'icon' => 'laptop',
                'category' => 'study_spaces',
                'description' => 'Access to computer facilities',
            ],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
