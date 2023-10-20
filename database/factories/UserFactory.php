<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role_id'      => $this->faker->numberBetween(1, 2),
            'username'     => $this->faker->unique()->userName(),
            'email'        => $this->faker->unique()->safeEmail(),
            'is_verified'  => $this->faker->numberBetween(1, 2),
            'password'     => bcrypt('password123'),
            'is_activated' => 1,
        ]; 
    }
}
