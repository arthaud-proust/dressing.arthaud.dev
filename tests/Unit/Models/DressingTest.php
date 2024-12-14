<?php

namespace Tests\Unit\Models;

use App\Models\ClothesCategory;
use App\Models\ClothesCategoryRequirement;
use App\Models\Dressing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DressingTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_category_requirement_for_each_clothes_category(): void
    {
        $user = User::factory()->create();
        $clothesCategoryA = ClothesCategory::factory()->for($user)->create();
        $clothesCategoryB = ClothesCategory::factory()->for($user)->create();

        $this->assertDatabaseCount(ClothesCategoryRequirement::class, 0);
        $dressing = Dressing::factory()->for($user)->create();
        $this->assertDatabaseCount(ClothesCategoryRequirement::class, 2);
    }

    public function test_delete_category_requirement_for_clothes_category(): void
    {
        $user = User::factory()->create();
        $clothesCategoryA = ClothesCategory::factory()->for($user)->create();
        $clothesCategoryB = ClothesCategory::factory()->for($user)->create();

        $dressing = Dressing::factory()->for($user)->create();
        $this->assertDatabaseCount(ClothesCategoryRequirement::class, 2);

        $dressing->delete();
        $this->assertDatabaseCount(ClothesCategoryRequirement::class, 0);
    }
}
