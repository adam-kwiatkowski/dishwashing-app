<?php

namespace Database\Factories;

use App\Models\Utensil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Utensil>
 */
class UtensilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $total = $this->faker->numberBetween(1, 10);
        return [
            'name' => $this->faker->word(),
            'total_amount' => $total,
            'available' => $this->faker->numberBetween(0, $total),
            'image_url' => 'https://loremflickr.com/400/400/kitchenware?lock=' . $this->faker->randomNumber(4),
        ];
    }
}
