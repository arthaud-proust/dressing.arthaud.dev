<?php

namespace Tests\Feature\Clothing;

use App\Models\ClothesCategory;
use App\Models\Clothing;
use App\Models\Dressing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MoveClothingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_move_clothing_to_another_dressing(): void
    {
        $user = User::factory()->create();
        $category = ClothesCategory::factory()->for($user)->create();
        $dressingSource = Dressing::factory()->for($user)->create();
        $clothing = $dressingSource->clothes()->create([
            'clothes_category_id' => $category->id,
            'description' => '',
        ]);
        $dressingDestination = Dressing::factory()->for($user)->create();

        $response = $this
            ->actingAs($user)
            ->post("/clothes/$clothing->id/move-to-dressing/$dressingDestination->id");

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect("/dressings/$dressingSource->id");

        $clothing = Clothing::first();
        $this->assertSame($clothing->dressing_id, $dressingDestination->id);
    }

    public function test_cannot_move_clothing_to_another_user_dressing(): void
    {
        $user = User::factory()->create();
        $category = ClothesCategory::factory()->for($user)->create();
        $dressingSource = Dressing::factory()->for($user)->create();
        $clothing = $dressingSource->clothes()->create([
            'clothes_category_id' => $category->id,
            'description' => '',
        ]);

        $anotherUser = User::factory()->create();
        $dressingDestination = Dressing::factory()->for($anotherUser)->create();

        $response = $this
            ->actingAs($user)
            ->post("/clothes/$clothing->id/move-to-dressing/$dressingDestination->id");

        $response->assertForbidden();

        $clothing = Clothing::first();
        $this->assertSame($clothing->dressing_id, $dressingSource->id);
    }

    public function test_cannot_move_clothing_from_another_user_dressing(): void
    {
        $anotherUser = User::factory()->create();
        $category = ClothesCategory::factory()->for($anotherUser)->create();
        $dressingSource = Dressing::factory()->for($anotherUser)->create();
        $clothing = $dressingSource->clothes()->create([
            'clothes_category_id' => $category->id,
            'description' => '',
        ]);

        $user = User::factory()->create();
        $dressingDestination = Dressing::factory()->for($user)->create();

        $response = $this
            ->actingAs($user)
            ->post("/clothes/$clothing->id/move-to-dressing/$dressingDestination->id");

        $response->assertForbidden();

        $clothing = Clothing::first();
        $this->assertSame($clothing->dressing_id, $dressingSource->id);
    }
}
