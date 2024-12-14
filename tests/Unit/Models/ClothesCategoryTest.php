<?php

namespace Tests\Unit\Models;

use App\Models\ClothesCategory;
use App\Models\ClothesCategoryRequirement;
use App\Models\Dressing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClothesCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_category_requirement_for_each_dressing(): void
    {
        $user = User::factory()->create();
        $dressingA = Dressing::factory()->for($user)->create();
        $dressingB = Dressing::factory()->for($user)->create();

        $this->assertDatabaseCount(ClothesCategoryRequirement::class, 0);
        $clothesCategory = ClothesCategory::factory()->for($user)->create();
        $this->assertDatabaseCount(ClothesCategoryRequirement::class, 2);
    }

    public function test_delete_category_requirement_for_each_dressing(): void
    {
        $user = User::factory()->create();
        $dressingA = Dressing::factory()->for($user)->create();
        $dressingB = Dressing::factory()->for($user)->create();

        $clothesCategory = ClothesCategory::factory()->for($user)->create();
        $this->assertDatabaseCount(ClothesCategoryRequirement::class, 2);

        $clothesCategory->delete();
        $this->assertDatabaseCount(ClothesCategoryRequirement::class, 0);
    }
}
