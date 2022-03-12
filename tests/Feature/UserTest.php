<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register(){}

    public function test_user_can_login(){}

    public function test_user_can_not_register_with_existing_username(){}

    public function test_user_can_not_register_with_existing_password(){}

    public function test_user_can_update_username(){
        $user = User::factory()->create();

        $request = $this
                    ->actingAs($user)
                    ->patch("/u/{$user->username}/update", [
                        'username' => 'new_username',
                        'email' => $user->email,
                        'password' => null
                    ]);

        $this->assertDatabaseHas('users', [
            'username' => 'new_username'
        ]);
    }

    public function test_user_can_update_email(){
        $user = User::factory()->create();

        $request = $this
                    ->actingAs($user)
                    ->patch("/u/{$user->username}/update", [
                        'username' => $user->email,
                        'email' => 'new@email.com',
                        'password' => null
                    ]);

        $this->assertDatabaseHas('users', [
            'email' => 'new@email.com'
        ]);
    }

    public function test_user_can_update_password(){}

    public function test_user_can_not_update_to_existing_username(){}

    public function test_user_can_not_update_to_existing_email(){}

    public function test_user_can_see_front_page_posts(){}

    public function test_user_can_delete_own_user(){}

    public function test_user_can_see_their_own_posts(){}

    public function test_user_can_see_their_own_comments(){}

    public function test_user_can_see_their_followed_communities(){}

    public function test_user_can_see_their_owned_communities(){}
}
