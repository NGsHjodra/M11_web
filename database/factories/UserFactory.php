<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'tagline' => $this->faker->word,
            'tier' => $this->faker->randomElement(['IRON', 'BRONZE', 'SILVER', 'GOLD', 'PLATINUM', 'DIAMOND', 'MASTER', 'GRANDMASTER', 'CHALLENGER']),
            'rank' => $this->faker->randomElement(['IV', 'III', 'II', 'I']),
            'point' => $this->faker->numberBetween(0, 100),
        ];
    }
}
