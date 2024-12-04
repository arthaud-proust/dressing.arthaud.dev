<?php

namespace Database\Factories;

use App\Enums\ClothingCategory;
use App\Models\Dressing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clothing>
 */
class ClothingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dressing_id' => Dressing::factory(),
            'description' => fake()->sentence(),
            'category' => fake()->randomElement(ClothingCategory::cases()),
        ];
    }
}
