<?php

namespace Tests\Feature\Clothing;

use App\Models\ClothesCategory;
use App\Models\ClothesCategoryRequirement;
use App\Models\Clothing;
use App\Models\Dressing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClothesCategoryCRUDTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_clothes_category(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post("/clothes-categories", [
                'name' => 'T-shirts',
            ]);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect("/clothes-categories");

        $this->assertDatabaseHas(ClothesCategory::class, [
            'name' => 'T-shirts',
        ]);
    }

    public function test_create_clothes_category_create_requirements_for_all_dressing(): void
    {
        $user = User::factory()->create();
        $dressing = Dressing::factory()->for($user)->create();

        $response = $this
            ->actingAs($user)
            ->post("/clothes-categories", [
                'name' => 'T-shirts',
            ]);

        $clothesCategory = ClothesCategory::first();
        $this->assertDatabaseHas(ClothesCategoryRequirement::class, [
            'dressing_id' => $dressing->id,
            'clothes_category_id' => $clothesCategory->id,
        ]);
    }

    public function test_can_update_clothes_category(): void
    {
        $user = User::factory()->create();
        $clothesCategory = ClothesCategory::factory()->for($user)->create([
            'name' => 'T-shirts',
        ]);

        $response = $this
            ->actingAs($user)
            ->put("/clothes-categories/$clothesCategory->id", [
                'name' => 'Pantalons',
            ]);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect("/clothes-categories");

        $this->assertDatabaseHas(ClothesCategory::class, [
            'name' => 'Pantalons',
        ]);
    }

    public function test_can_update_clothes_category_of_another_user(): void
    {
        $anotherUser = User::factory()->create();
        $clothesCategory = ClothesCategory::factory()->for($anotherUser)->create([
            'name' => 'T-shirts',
        ]);

        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->put("/clothes-categories/$clothesCategory->id", [
                'name' => 'Pantalons',
            ]);

        $response->assertForbidden();

        $this->assertDatabaseHas(ClothesCategory::class, [
            'name' => 'T-shirts',
        ]);
    }

    public function test_delete_clothes_category_will_unset_category_id_for_related_clothes(): void
    {
        $user = User::factory()->create();
        $dressing = Dressing::factory()->for($user)->create();
        $clothesCategory = ClothesCategory::factory()->for($user)->create([
            'name' => 'T-shirts',
        ]);
        $clothing = Clothing::factory()->for($dressing)->for($clothesCategory)->create();

        $response = $this
            ->actingAs($user)
            ->delete("/clothes-categories/$clothesCategory->id");

        $response->assertRedirect();

        $this->assertNull($clothing->fresh()->clothes_category_id);
    }

    public function test_cannot_delete_clothes_category_of_another_user(): void
    {
        $anotherUser = User::factory()->create();
        $clothesCategory = ClothesCategory::factory()->for($anotherUser)->create([
            'name' => 'T-shirts',
        ]);

        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->delete("/clothes-categories/$clothesCategory->id");

        $response->assertForbidden();

        $this->assertDatabaseCount(ClothesCategory::class, 1);
    }
}
