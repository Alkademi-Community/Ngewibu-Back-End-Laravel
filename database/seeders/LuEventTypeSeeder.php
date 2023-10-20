<?php

namespace Database\Seeders;

use App\Models\LuEventType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LuEventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LuEventType::insert([
            [
                'name'       => 'Offline',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Online',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
