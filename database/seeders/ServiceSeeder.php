<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Airport Pickup',
                'description' => 'Pickup service from the airport to your accommodation.',
                'price' => 25.00,
                'status' => 'active',
            ],
            [
                'title' => 'Laundry Service',
                'description' => 'Weekly laundry service including washing and ironing.',
                'price' => 15.00,
                'status' => 'active',
            ],
            [
                'title' => 'Cleaning Service',
                'description' => 'Bi-weekly room cleaning service.',
                'price' => 20.00,
                'status' => 'active',
            ],
            [
                'title' => 'Meal Plan',
                'description' => 'Daily meals (breakfast and dinner) provided.',
                'price' => 100.00,
                'status' => 'active',
            ],
            [
                'title' => 'Bicycle Rental',
                'description' => 'Monthly bicycle rental for easier transportation.',
                'price' => 30.00,
                'status' => 'active',
            ],
            [
                'title' => 'Extra Storage Space',
                'description' => 'Additional storage locker provided in the building.',
                'price' => 10.00,
                'status' => 'active',
            ],
            [
                'title' => '24/7 Security Upgrade',
                'description' => 'Extra security features including keycard access and CCTV.',
                'price' => 12.50,
                'status' => 'active',
            ],
            [
                'title' => 'Student desk rental',
                'description' => 'Faster internet connection (up to 100Mbps).',
                'price' => 8.00,
                'status' => 'active',
            ],
            [
                'title' => 'Gym Membership',
                'description' => 'Monthly access to partner gym facility.',
                'price' => 35.00,
                'status' => 'active',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
