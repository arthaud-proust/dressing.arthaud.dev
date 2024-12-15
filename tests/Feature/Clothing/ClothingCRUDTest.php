<?php

namespace Tests\Feature\Clothing;

use App\Models\ClothesCategory;
use App\Models\Clothing;
use App\Models\Dressing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClothingCRUDTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_clothing(): void
    {
        $user = User::factory()->create();
        $dressing = Dressing::factory()->for($user)->create();
        $category = ClothesCategory::factory()->for($user)->create();
        $image = $this->uploadedImageFile();

        $response = $this
            ->actingAs($user)
            ->post("/dressings/$dressing->id/clothes", [
                'images' => [$image],
                'description' => 'White t-shirt',
                'clothes_category_id' => $category->id,
            ]);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect("/dressings/$dressing->id/clothes/create");

        $clothing = Clothing::first();
        $this->assertNotNull($clothing);
        $this->assertSame($category->id, $clothing->clothes_category_id);
        $this->assertSame('White t-shirt', $clothing->description);
        $this->assertNotNull($clothing->getMedia()->first());
    }

    public function test_can_update_clothes_category(): void
    {
        $user = User::factory()->create();
        $dressing = Dressing::factory()->for($user)->create();
        $categoryA = ClothesCategory::factory()->for($user)->create();
        $categoryB = ClothesCategory::factory()->for($user)->create();

        $clothing = $dressing->clothes()->create([
            'clothes_category_id' => $categoryA->id,
            'description' => '',
        ]);

        $response = $this
            ->actingAs($user)
            ->put("/clothes/$clothing->id", [
                'clothes_category_id' => $categoryB->id,
            ]);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect("/dressings/$dressing->id");

        $clothing->refresh();
        $this->assertSame($categoryB->id, $clothing->clothes_category_id);
    }

    public function test_cannot_update_with_another_user_clothes_category(): void
    {
        $user = User::factory()->create();
        $dressing = Dressing::factory()->for($user)->create();
        $category = ClothesCategory::factory()->for($user)->create();

        $clothing = $dressing->clothes()->create([
            'clothes_category_id' => $category->id,
            'description' => '',
        ]);

        $anotherUser = User::factory()->create();
        Dressing::factory()->for($anotherUser)->create();
        $anotherUserCategory = ClothesCategory::factory()->for($anotherUser)->create();

        $response = $this
            ->actingAs($user)
            ->put("/clothes/$clothing->id", [
                'clothes_category_id' => $anotherUserCategory->id,
            ]);

        $response->assertSessionHasErrors();

        $clothing->refresh();
        $this->assertSame($category->id, $clothing->clothes_category_id);
    }

    public function test_can_delete_clothing(): void
    {
        $user = User::factory()->create();
        $dressing = Dressing::factory()->for($user)->create();
        $category = ClothesCategory::factory()->for($user)->create();
        $clothing = $dressing->clothes()->create([
            'clothes_category_id' => $category->id,
            'description' => '',
        ]);

        $response = $this
            ->actingAs($user)
            ->delete("/clothes/$clothing->id");

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect("/dressings/$dressing->id");

        $this->assertDatabaseCount(Clothing::class, 0);
    }

    public function test_cannot_delete_clothing_of_other_user(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $dressing = Dressing::factory()->for($user)->create();
        $category = ClothesCategory::factory()->for($user)->create();
        $clothing = $dressing->clothes()->create([
            'clothes_category_id' => $category->id,
            'description' => '',
        ]);

        $response = $this
            ->actingAs($otherUser)
            ->delete("/clothes/$clothing->id");

        $response->assertForbidden();

        $this->assertDatabaseCount(Clothing::class, 1);
    }
}
