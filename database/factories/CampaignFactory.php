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
        return [
            'name' => $this->faker->words(3, true),
            'from_date' => $this->faker->dateTimeBetween('-30 days', '+30 days'),
            'to_date' => $this->faker->dateTimeBetween('+8 days', '+30 days'),
            'total_budget' => $this->faker->randomFloat(2, 1000, 15000),
            'daily_budget' => $this->faker->randomFloat(2, 500, 999),
            'creative_upload' => $this->faker->shuffleArray([
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
            ]),
        ];
    }
}