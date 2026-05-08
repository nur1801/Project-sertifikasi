<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => fake()->words(3, true),
            'photo' => null,
            'unit' => fake()->randomElement(['pcs', 'pack', 'box', 'kg', 'gram']),
            'stock' => fake()->numberBetween(0, 120),
            'min_stock' => fake()->numberBetween(5, 20),
            'selling_price' => fake()->numberBetween(10000, 250000),
            'purchase_price' => fake()->numberBetween(8000, 220000),
            'weight' => fake()->randomElement(['250 gram', '500 gram', '1 kg', '2 kg', null]),
            'location' => fake()->randomElement(['Freezer A1', 'Freezer A2', 'Rak B1', 'Rak B2', null]),
            'description' => fake()->sentence(),
        ];
    }
}