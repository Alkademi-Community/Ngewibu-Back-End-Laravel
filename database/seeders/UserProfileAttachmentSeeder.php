<?php

namespace Database\Seeders;

use App\Models\UserProfileAttachment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProfileAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserProfileAttachment::factory(11)->create();
    }
}
