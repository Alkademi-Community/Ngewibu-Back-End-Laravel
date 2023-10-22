<?php

namespace Database\Factories;

use App\Traits\WithFactoryDataCount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfileAttachment>
 */
class UserProfileAttachmentFactory extends Factory
{
    use WithFactoryDataCount;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userCount = $this->getUserCount();
        return [
            'user_id'   => $this->faker->numberBetween(1, $userCount),
            'url'       => $this->faker->imageUrl(640, 480),
            'extension' => 'jpg',
            'size'      => $this->faker->numberBetween(1000, 1000000),
            'path'      => $this->faker->word(),
        ];
    }
}
