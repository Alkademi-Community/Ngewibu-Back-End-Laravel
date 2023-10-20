<?php

namespace Database\Seeders;

use App\Models\LuEventStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LuEventStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventStatuses = [
            [
                'name'       => 'Verfying',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'In Progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Canceled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        LuEventStatus::insert($eventStatuses);
    }
}
