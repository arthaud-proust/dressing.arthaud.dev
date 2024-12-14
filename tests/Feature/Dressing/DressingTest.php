<?php

namespace Tests\Feature\Dressing;

use App\Enums\DressingColor;
use App\Models\ClothesCategory;
use App\Models\ClothesCategoryRequirement;
use App\Models\Dressing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DressingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_dressing(): void
    {
        $user = User::factory()->create();
        $dressing = Dressing::factory()->for($user)->create([
            'name' => 'Home A',
        ]);

        $response = $this
            ->actingAs($user)
            ->get("/dressings/$dressing->id");

        $response->assertOk();
    }

    public function test_cannot_view_dressing_of_other_user(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $dressing = Dressing::factory()->for($user)->create([
            'name' => 'Home A',
        ]);

        $response = $this
            ->actingAs($otherUser)
            ->get("/dressings/$dressing->id");

        $response->assertForbidden();
    }

    public function test_can_create_dressing(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/dressings', [
                'name' => 'Home',
                'color' => DressingColor::AMBER->value,
            ]);

        $dressing = Dressing::first();
        $this->assertNotNull($dressing);
        $response->assertRedirect("/dressings/$dressing->id");
    }

    public function test_can_update_dressing(): void
    {
        $user = User::factory()->create();
        $dressing = Dressing::factory()->for($user)->create([
            'name' => 'Home A',
            'color' => DressingColor::RED->value,
        ]);

        $response = $this
            ->actingAs($user)
            ->put("/dressings/$dressing->id", [
                'name' => 'Home B',
                'color' => DressingColor::AMBER->value,
                'clothesMinByCategory' => [],
            ]);

        $response->assertRedirect("/dressings/$dressing->id");
        $this->assertDatabaseHas(Dressing::class, [
            'name' => 'Home B',
            'color' => DressingColor::AMBER->value,
        ]);
    }

    public function test_can_update_dressing_clothing_category_requirements(): void
    {
        $user = User::factory()->create();
        $clothesCategory = ClothesCategory::factory()->for($user)->create();
        $dressing = Dressing::factory()->for($user)->create([
            'name' => 'Home A',
            'color' => DressingColor::RED->value,
        ]);

        $this->assertDatabaseHas(ClothesCategoryRequirement::class, [
            'min' => 0,
        ]);

        $response = $this
            ->actingAs($user)
            ->put("/dressings/$dressing->id", [
                'name' => 'Home B',
                'color' => DressingColor::RED->value,
                'clothesMinByCategory' => [
                    (string) $clothesCategory->id => 2,
                ],
            ]);

        $response->assertRedirect("/dressings/$dressing->id");
        $this->assertDatabaseHas(ClothesCategoryRequirement::class, [
            'min' => 2,
        ]);
    }

    public function test_cannot_update_dressing_of_other_user(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $dressing = Dressing::factory()->for($user)->create([
            'name' => 'Home A',
            'color' => DressingColor::RED->value,
        ]);

        $response = $this
            ->actingAs($otherUser)
            ->put("/dressings/$dressing->id", [
                'name' => 'Home B',
                'color' => DressingColor::AMBER->value,
                'clothesMinByCategory' => [],
            ]);

        $response->assertForbidden();
        $this->assertDatabaseHas(Dressing::class, [
            'name' => 'Home A',
            'color' => DressingColor::RED->value,
        ]);
    }

    public function test_can_delete_dressing(): void
    {
        $user = User::factory()->create();
        $dressing = Dressing::factory()->for($user)->create([
            'name' => 'Home A',
        ]);

        $response = $this
            ->actingAs($user)
            ->delete("/dressings/$dressing->id", [
                'name' => 'Home B',
            ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseCount(Dressing::class, 0);
    }

    public function test_cannot_delete_dressing_of_other_user(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $dressing = Dressing::factory()->for($user)->create([
            'name' => 'Home',
        ]);

        $response = $this
            ->actingAs($otherUser)
            ->delete("/dressings/$dressing->id");

        $response->assertForbidden();
        $this->assertDatabaseCount(Dressing::class, 1);
    }
}
