<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Traits\WithFactoryDataCount;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    use WithFactoryDataCount;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cityCount        = $this->getCityCount();
        $userCount        = $this->getUserCount();
        $eventStatusCount = $this->getEventStatusCount();
        $eventTypeCount   = $this->getEventTypeCount();

        return [
            'lu_event_type_id'   => $this->faker->numberBetween(1, $eventTypeCount),
            'lu_event_status_id' => $this->faker->numberBetween(1, $eventStatusCount),
            'user_id'            => $this->faker->numberBetween(1, $userCount),
            'city_id'            => $this->faker->numberBetween(1, $cityCount),
            'title'              => $this->faker->words(5, true),
            'slug'               => $this->faker->unique()->slug(),
            'description'        => $this->faker->paragraphs(3, true),
            'address'            => $this->faker->address(),
            'start_date'         => now(),
            'end_date'           => now()->addDays(1),
        ];
    }
}
