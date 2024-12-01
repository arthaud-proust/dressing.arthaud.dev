<?php

namespace Tests\Feature;

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
        ]);

        $response = $this
            ->actingAs($user)
            ->put("/dressings/$dressing->id", [
                'name' => 'Home B',
            ]);

        $response->assertRedirect("/dressings/$dressing->id");
        $this->assertDatabaseHas(Dressing::class, [
            'name' => 'Home B',
        ]);
    }

    public function test_cannot_update_dressing_of_other_user(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $dressing = Dressing::factory()->for($user)->create([
            'name' => 'Home A',
        ]);

        $response = $this
            ->actingAs($otherUser)
            ->put("/dressings/$dressing->id", [
                'name' => 'Home B',
            ]);

        $response->assertForbidden();
        $this->assertDatabaseHas(Dressing::class, [
            'name' => 'Home A',
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
