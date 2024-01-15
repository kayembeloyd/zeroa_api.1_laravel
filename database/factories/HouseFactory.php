<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rent' => $this->faker->randomElement([
                20000, 30500, 40000, 50000, 65000, 68000, 70000,
                75500, 80000, 90000, 102000, 112000, 150000, 170000,
                180000, 190000, 200000, 210000, 250000, 270000, 300000,
                350000, 370000, 400000, 500000, 550000
            ]),
            'payment_period' => $this->faker->numberBetween(1, 3),
            'available_on' => $this->faker->dateTimeBetween('now', '+120 days'),
            'rooms' => $this->faker->randomDigitNot(0),
            'views' => $this->faker->numberBetween(0, 100),
            'details' => $this->faker->paragraph()
        ];
    }
}
