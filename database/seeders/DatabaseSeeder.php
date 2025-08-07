<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'user_type' => 'admin',
            'is_active' => true,
            'date_of_birth' => '2000-01-01',
            'gender' => 'male',
            'nationality' => 'Indonesian',
            'emergency_contact_name' => 'Emergency Contact',
            'emergency_contact_phone' => '1234567890',
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => 'password',
            'user_type' => 'staff',
            'is_active' => true,
            'date_of_birth' => '2000-01-01',
            'gender' => 'male',
            'nationality' => 'Indonesian',
            'emergency_contact_name' => 'Emergency Contact',
            'emergency_contact_phone' => '08123456781',
        ]);

        User::create([
            'name' => 'Student',
            'email' => 'student@gmail.com',
            'password' => 'password',
            'user_type' => 'student',
            'is_active' => true,
            'date_of_birth' => '2000-01-01',
            'gender' => 'male',
            'nationality' => 'Indonesian',
            'emergency_contact_name' => 'Emergency Contact',
            'emergency_contact_phone' => '08123456789',
        ]);

        $this->call([
            InstituteSeeder::class,
            FeatureSeeder::class,
            PropertySeeder::class,
            RoomSeeder::class,
            SettingSeeder::class,
            ReviewSeeder::class,
            BookingSeeder::class,
            ServiceSeeder::class
        ]);
    }
}
