<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Actor>
 */
class ActorFactory extends Factory
{
    protected $model = Actor::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'description' => $this->faker->sentence(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'address' => $this->faker->address(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'height' => (string)$this->faker->numberBetween(160, 200),
            'weight' => (string)$this->faker->numberBetween(50, 100),
            'age' => $this->faker->numberBetween(20, 60),
        ];
    }
}
