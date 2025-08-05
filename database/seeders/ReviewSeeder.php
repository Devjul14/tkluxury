<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = Property::all();
        $students = User::where('user_type', 'student')->get();

        foreach ($properties as $property) {
            foreach ($students as $student) {
                Review::create([
                    'property_id' => $property->id,
                    'student_id' => $student->id,
                    'booking_id' => null,
                    'overall_rating' => rand(1, 5),
                    'cleanliness_rating' => rand(1, 5),
                    'location_rating' => rand(1, 5),
                    'value_rating' => rand(1, 5),
                    'management_rating' => rand(1, 5),
                    'title' => 'Review for ' . $property->name,
                    'comment' => 'This is a review for ' . $property->name,
                    'admin_response' => 'This is an admin response for ' . $property->name,
                    'is_verified' => true,
                    'is_featured' => true,
                ]);
            }
        }
    }
}
