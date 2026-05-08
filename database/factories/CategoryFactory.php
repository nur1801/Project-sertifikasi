<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'Daging Ayam',
            'Seafood',
            'Daging Sapi',
            'Sayuran Beku',
            'Olahan Beku',
        ];

        return [
            'name' => fake()->unique()->randomElement($names) . ' ' . fake()->unique()->numberBetween(1, 99),
            'description' => fake()->sentence(),
        ];
    }
}