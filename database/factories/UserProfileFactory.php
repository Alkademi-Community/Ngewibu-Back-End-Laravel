<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'           => $this->faker->numberBetween(1, 11),
            'gender_id'         => $this->faker->numberBetween(1, 2),
            'full_name'         => $this->faker->name(),
            'profile_bio'       => $this->faker->paragraphs(2, true), 
            'address'           => $this->faker->address(),
            'date_of_birth'     => $this->faker->date(), 
            'profile_image_url' => $this->faker->imageUrl(),
        ];
    }
}
