<?php

namespace Database\Factories;

use App\Enums\DressingColor;
use Illuminate\Database\Eloquent\Factories\Factory;
use function fake;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dressing>
 */
class DressingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->city(),
            'color' => fake()->randomElement(DressingColor::cases()),
        ];
    }
}
