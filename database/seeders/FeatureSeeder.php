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
                'icon' => 'truck', // Changed from 'car' to 'truck'
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
                'icon' => 'shirt', // Changed from 'tshirt' to 'shirt'
                'category' => 'amenities',
                'description' => 'Washing and drying facilities',
            ],
            [
                'name' => 'Kitchen',
                'icon' => 'kitchen-set', // Changed from 'utensils' to 'kitchen-set'
                'category' => 'amenities',
                'description' => 'Fully equipped kitchen',
            ],
            [
                'name' => 'Balcony',
                'icon' => 'house', // Changed from 'home' to 'house'
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
                'icon' => 'thermometer', // Changed from 'thermometer-half' to 'thermometer'
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
                'icon' => 'shield', // Changed from 'shield-alt' to 'shield'
                'category' => 'safety',
                'description' => '24/7 security monitoring',
            ],
            [
                'name' => 'Fire Alarm',
                'icon' => 'fire-extinguisher', // Changed from 'fire' to 'fire-extinguisher'
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
                'icon' => 'desktop', // Changed from 'book' to 'desktop'
                'category' => 'study_spaces',
                'description' => 'Dedicated study area',
            ],
            [
                'name' => 'Library Access',
                'icon' => 'book-open', // Changed from 'library' to 'book-open'
                'category' => 'study_spaces',
                'description' => 'Access to university library',
            ],
            [
                'name' => 'Quiet Hours',
                'icon' => 'clock-rotate-left', // Changed from 'volume-mute' to 'clock-rotate-left'
                'category' => 'study_spaces',
                'description' => 'Designated quiet study hours',
            ],
            [
                'name' => 'Computer Lab',
                'icon' => 'computer', // Changed from 'laptop' to 'computer'
                'category' => 'study_spaces',
                'description' => 'Access to computer facilities',
            ],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
