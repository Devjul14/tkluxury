<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Institute;

class InstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutes = [
            [
                'name' => 'University of Technology Sydney',
                'code' => 'UTS',
                'address' => '15 Broadway',
                'city' => 'Ultimo',
                'state' => 'NSW',
                'country' => 'Australia',
                'postal_code' => '2007',
                'latitude' => -33.8833,
                'longitude' => 151.2000,
                'website' => 'https://www.uts.edu.au',
                'contact_email' => 'info@uts.edu.au',
                'contact_phone' => '+61 2 9514 2000',
                'description' => 'A leading university of technology in Australia',
                'partnership_status' => 'active',
                'is_active' => true,
            ],
            [
                'name' => 'University of Sydney',
                'code' => 'USYD',
                'address' => 'Camperdown',
                'city' => 'Sydney',
                'state' => 'NSW',
                'country' => 'Australia',
                'postal_code' => '2006',
                'latitude' => -33.8885,
                'longitude' => 151.1873,
                'website' => 'https://www.sydney.edu.au',
                'contact_email' => 'info@sydney.edu.au',
                'contact_phone' => '+61 2 9351 2222',
                'description' => 'Australia\'s first university',
                'partnership_status' => 'active',
                'is_active' => true,
            ],
            [
                'name' => 'University of New South Wales',
                'code' => 'UNSW',
                'address' => 'Kensington',
                'city' => 'Sydney',
                'state' => 'NSW',
                'country' => 'Australia',
                'postal_code' => '2052',
                'latitude' => -33.9173,
                'longitude' => 151.2313,
                'website' => 'https://www.unsw.edu.au',
                'contact_email' => 'info@unsw.edu.au',
                'contact_phone' => '+61 2 9385 1000',
                'description' => 'A world-leading university',
                'partnership_status' => 'active',
                'is_active' => true,
            ],
            [
                'name' => 'Macquarie University',
                'code' => 'MQ',
                'address' => 'Macquarie Park',
                'city' => 'Sydney',
                'state' => 'NSW',
                'country' => 'Australia',
                'postal_code' => '2109',
                'latitude' => -33.7731,
                'longitude' => 151.1144,
                'website' => 'https://www.mq.edu.au',
                'contact_email' => 'info@mq.edu.au',
                'contact_phone' => '+61 2 9850 7111',
                'description' => 'A research-intensive university',
                'partnership_status' => 'pending',
                'is_active' => true,
            ],
        ];

        foreach ($institutes as $institute) {
            Institute::create($institute);
        }
    }
}
