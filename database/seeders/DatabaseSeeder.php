<?php

namespace Database\Seeders;

use App\Models\Dressing;
use App\Models\User;
use Illuminate\Database\Seeder;
use function config;

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

        Dressing::factory(2)->for($user)->create();
    }
}
