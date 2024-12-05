<?php

namespace Feature\Dressing;

use App\Enums\ClothingCategory;
use App\Models\Clothing;
use App\Models\Dressing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClothingMovingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_move_clothing_to_another_dressing(): void
    {
        $user = User::factory()->create();
        $dressingSource = Dressing::factory()->for($user)->create();
        $clothingA = $dressingSource->clothing()->create([
            'category' => ClothingCategory::OTHERS,
            'description' => '',
        ]);
        $clothingB = $dressingSource->clothing()->create([
            'category' => ClothingCategory::OTHERS,
            'description' => '',
        ]);
        $dressingDestination = Dressing::factory()->for($user)->create();

        $response = $this
            ->actingAs($user)
            ->post("/clothing/move/from/$dressingSource->id/to/$dressingDestination->id/", [
                'clothes_id' => [$clothingA->id, $clothingB->id],
            ]);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect("/dressings/$dressingDestination->id");

        $this->assertSame($clothingA->fresh()->dressing_id, $dressingDestination->id);
        $this->assertSame($clothingB->fresh()->dressing_id, $dressingDestination->id);
    }

    public function test_cannot_move_clothing_from_another_user_dressing(): void
    {
        $anotherUser = User::factory()->create();
        $dressingSource = Dressing::factory()->for($anotherUser)->create();
        $clothing = $dressingSource->clothing()->create([
            'category' => ClothingCategory::OTHERS,
            'description' => '',
        ]);

        $user = User::factory()->create();
        $dressingDestination = Dressing::factory()->for($user)->create();

        $response = $this
            ->actingAs($user)
            ->post("/clothing/move/from/$dressingSource->id/to/$dressingDestination->id/", [
                'clothes_id' => [$clothing->id],
            ]);

        $response->assertForbidden();

        $clothing = Clothing::first();
        $this->assertSame($clothing->dressing_id, $dressingSource->id);
    }

    public function test_cannot_move_clothing_to_another_user_dressing(): void
    {
        $user = User::factory()->create();
        $dressingSource = Dressing::factory()->for($user)->create();
        $clothing = $dressingSource->clothing()->create([
            'category' => ClothingCategory::OTHERS,
            'description' => '',
        ]);

        $anotherUser = User::factory()->create();
        $dressingDestination = Dressing::factory()->for($anotherUser)->create();

        $response = $this
            ->actingAs($user)
            ->post("/clothing/move/from/$dressingSource->id/to/$dressingDestination->id/", [
                'clothes_id' => [$clothing->id],
            ]);

        $response->assertForbidden();

        $clothing = Clothing::first();
        $this->assertSame($clothing->dressing_id, $dressingSource->id);
    }
}
