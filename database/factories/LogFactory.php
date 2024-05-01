<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Str;

class LogFactory extends Factory
{
    protected $model = Log::class;

    public function definition()
    {
        // Either find an existing user or create a new one to associate with the log
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        // Generate an array of random puuids plus the current user's puuid
        $participants = collect([$user->puuid]); // Start with the user's puuid
        for ($i = 0; $i < 7; $i++) {
            $participants->push(Str::uuid()->toString()); // Add seven new random puuids
        }

        return [
            'puuid' => $user->puuid,  // Use the puuid of the user
            'match_id' => $this->faker->regexify('[A-Z0-9]{10}'),  // Generate a fake match ID
            'placement' => $this->faker->numberBetween(1, 8),
            'participants' => json_encode($participants),  // Encode the participants array as JSON
        ];
    }
}

