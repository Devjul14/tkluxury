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
                'key' => 'logo',
                'type' => 'image',
                'value' => 'settings/brand.jpg', // upload manual dulu ke storage/app/public/settings/
            ],
            [
                'group' => 'homepage',
                'key' => 'hero_main_text',
                'type' => 'text',
                'value' => 'Luxury — amazing hostel for the free spirited traveler',
            ],
            [
                'group' => 'homepage',
                'key' => 'hero_sub_text',
                'type' => 'text',
                'value' => 'Hero sub text aenean pharetra magna ac. Et tortor consequat id porta nibh venenatis cras sed. Vel turpis nunc eget lorem dolor sed',
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
                'key' => 'contact_email',
                'type' => 'text',
                'value' => 'support@studenthousing.com',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate([
                'key' => $setting['key'],
            ], $setting);
        }
    }
}
