<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $room = Room::all()->random();

        $checkInDate = fake()->dateTimeBetween(now()->startOfYear(), now()->endOfYear());

        return [
            'property_id' => $room->property_id,
            'room_id' => $room->id,
            'student_id' => User::factory()->create(['user_type' => 'student'])->id,
            'booking_reference' => fake()->uuid(),
            'check_in_date' => $checkInDate,
            'check_out_date' => fake()->dateTimeBetween($checkInDate, '+1 year'),
            'duration_months' => fake()->numberBetween(1, 12),
            'monthly_rent' => $room->price_per_month,
            'security_deposit' => $room->security_deposit,
            'total_amount' => fake()->numberBetween(100000, 500000),
            'status' => fake()->randomElement(['pending', 'completed', 'cancelled', 'active', 'confirmed']),
            'booking_date' => $checkInDate,
            'special_requests' => fake()->text(),
            'assigned_room_number' => fake()->numberBetween(1, 20),
            'key_handover_date' => fake()->dateTimeBetween(now(), '+1 year'),
            'check_in_notes' => fake()->text(),
            'check_out_notes' => fake()->text(),
            'down_payment_amount' => fake()->numberBetween(100000, 500000),
            'tax' => fake()->numberBetween(100000, 500000),
            'service_fee' => fake()->numberBetween(100000, 500000),
            'subtotal' => fake()->numberBetween(100000, 500000),
        ];
    }
}
