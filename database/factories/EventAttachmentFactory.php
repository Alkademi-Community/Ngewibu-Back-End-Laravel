<?php

namespace Database\Factories;

use App\Traits\WithFactoryDataCount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventAttachment>
 */
class EventAttachmentFactory extends Factory
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

        return [
            'event_id'  => $this->faker->numberBetween(1, $eventCount),
            'url'       => $this->faker->imageUrl(640, 480),
            'extension' => 'jpg',
            'size'      => $this->faker->numberBetween(1000, 1000000),
            'name'      => $this->faker->word(),
        ];
    }
}
