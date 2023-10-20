<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProvinceSeeder::class,
            CitySeeder::class,
            GenderSeeder::class,
            LuEventStatusSeeder::class,
            LuEventTypeSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            UserProfileSeeder::class,
            EventSeeder::class,
            EventParticipantSeeder::class,
            CommentSeeder::class,
            EventLikeSeeder::class,
            EventAttachmentSeeder::class,

        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
