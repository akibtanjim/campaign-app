<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        $fromTime = $this->faker->dateTimeBetween('-30 days', '+30 days');
        return [
            'name' => $this->faker->words(3, true),
            'from_date' => $fromTime,
            'to_date' => $this->faker->dateTimeBetween($fromTime, $fromTime->modify('+15 days')),
            'total_budget' => $this->faker->randomFloat(2, 1000, 15000),
            'daily_budget' => $this->faker->randomFloat(2, 500, 999),
            'creative_upload' => $this->faker->shuffleArray([
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
            ]),
        ];
    }
}