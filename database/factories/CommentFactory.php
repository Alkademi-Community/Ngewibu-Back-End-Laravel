<?php

namespace Database\Factories;

use App\Traits\WithFactoryDataCount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    use WithFactoryDataCount;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $eventCount = $this->getEventCount();
        $userCount  = $this->getUserCount();
        return [
            'event_id'     => $this->faker->numberBetween(1, $eventCount),
            'user_id'      => $this->faker->numberBetween(1, $userCount),
            'comment_body' => $this->faker->paragraphs(3, true),
        ];
    }
}
