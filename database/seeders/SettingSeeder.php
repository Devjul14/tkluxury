<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'group' => 'branding',
                'key' => 'name',
                'type' => 'text',
                'value' => 'Luxury',
            ],
            [
                'group' => 'branding',
                'key' => 'brand_logo',
                'type' => 'image',
                'value' => 'settings/brand.jpg', //manually upload
            ],
            [
                'group' => 'homepage',
                'key' => 'hero_main_text',
                'type' => 'text',
                'value' => 'Find Your Ideal Student Home — 3 to 12 Month Rentals',
            ],
            [
                'group' => 'homepage',
                'key' => 'hero_sub_text',
                'type' => 'text',
                'value' => 'Discover comfortable, fully-furnished student accommodations near top universities and vibrant city centers. Flexible stays. Hassle-free living.',
            ],
            [
                'group' => 'homepage',
                'key' => 'map',
                'type' => 'text',
                'value' => '-35.23729851439285, 139.5592634004934',
            ],
            [
                'group' => 'contact',
                'key' => 'contact_text',
                'type' => 'text',
                'value' => 'Contact text pharetra magna ac. Et tortor consequat id porta nibh venenatis cras sed',
            ],
            [
                'group' => 'contact',
                'key' => 'phone_primary',
                'type' => 'text',
                'value' => '+62 812-3456-7890',
            ],
            [
                'group' => 'contact',
                'key' => 'phone_secondary',
                'type' => 'text',
                'value' => '+62 812-3456-7890',
            ],
            [
                'group' => 'contact',
                'key' => 'email',
                'type' => 'text',
                'value' => 'support@studenthousing.com',
            ],
            [
                'group' => 'contact',
                'key' => 'address_line1',
                'type' => 'text',
                'value' => 'St Test 54739',
            ],
            [
                'group' => 'contact',
                'key' => 'address_line2',
                'type' => 'text',
                'value' => 'Kuala Lumpur, Malaysia',
            ],
            [
                'group' => 'contact',
                'key' => 'hours_days',
                'type' => 'text',
                'value' => 'Everyday',
            ],
            [
                'group' => 'contact',
                'key' => 'hours_time',
                'type' => 'text',
                'value' => '10 am — 20 pm',
            ],
            [
                'group' => 'socialmedia',
                'key' => 'facebook',
                'type' => 'text',
                'value' => 'facebook.com',
            ],
            [
                'group' => 'socialmedia',
                'key' => 'instagram',
                'type' => 'text',
                'value' => 'instagram.com',
            ],
            [
                'group' => 'socialmedia',
                'key' => 'twitter',
                'type' => 'text',
                'value' => 'twitter.com',
            ],
            [
                'group' => 'socialmedia',
                'key' => 'twitter',
                'type' => 'text',
                'value' => 'twitter.com',
            ],
            [
                'group' => 'socialmedia',
                'key' => 'whatsapp',
                'type' => 'text',
                'value' => '+608389222',
            ],
            [
                'group' => 'socialmedia',
                'key' => 'description',
                'type' => 'text',
                'value' => 'Lorem ipsum dolor sit ament amnesinia daritullarua',
            ],
            [
                'group' => 'payment',
                'key' => 'currency',
                'type' => 'text',
                'value' => 'RM',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate([
                'key' => $setting['key'],
            ], $setting);
        }
    }
}
