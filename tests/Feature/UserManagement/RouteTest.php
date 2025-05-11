<?php

namespace Tests\Feature\UserManagement;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIsSeeTheUserListPage()
    {
        $administrator = User::factory()->create();

        $this
            ->actingAs($administrator)
            ->get('/users')
            ->assertOk()
            ->assertSee('email')
            ->assertDontSee('password')
        ;
    }
}
