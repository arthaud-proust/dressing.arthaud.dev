<?php

namespace Database\Seeders;

use App\Models\ClothesCategory;
use App\Models\Clothing;
use App\Models\Dressing;
use App\Models\User;
use Illuminate\Database\Seeder;
use function config;
use function fake;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => config('app.test_user.email'),
            'password' => config('app.test_user.password'),
        ]);

        $defaultCategories = collect([
            "Autres",
            "Pantalons et leggings",
            "Shorts",
            "Hauts et t-shirts",
            "Sweats et pulls",
            "Chaussettes",
            "Culottes/Caleçons",
            "Soutiens-gorge",
            "Pyjamas",
            "Costumes et blazers",
            "Vêtements de sport",
        ]);

        $categories = $defaultCategories->map(function (string $name) use ($user) {
            return ClothesCategory::factory()->for($user)->create(['name' => $name]);
        });

        $fatherDressing = Dressing::factory()->for($user)->create(['name' => 'Chez Papa']);
        foreach ($categories as $category) {
            Clothing::factory()
                ->for($fatherDressing)
                ->category($category)
                ->count(fake()->numberBetween(7, 10))
                ->create();
        }

        $motherDressing = Dressing::factory()->for($user)->create(['name' => 'Chez Maman']);
        foreach ($categories as $category) {
            Clothing::factory()
                ->for($motherDressing)
                ->category($category)
                ->count(fake()->numberBetween(7, 10))
                ->create();
        }

        $internatDressing = Dressing::factory()->for($user)->create(['name' => 'Internat']);
        foreach ($categories as $category) {
            Clothing::factory()
                ->for($internatDressing)
                ->category($category)
                ->count(fake()->numberBetween(1, 3))
                ->create();
        }
    }
}
