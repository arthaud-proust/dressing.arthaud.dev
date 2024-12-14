<?php

namespace Database\Factories;

use App\Models\ClothesCategory;
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
            'clothes_category_id' => ClothesCategory::factory(),
        ];
    }

    public function category(ClothesCategory $category): static
    {
        return $this->state(fn(array $attributes) => [
            'clothes_category_id' => $category,
        ]);
    }
}
