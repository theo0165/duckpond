<?php

namespace Tests\Feature;

use App\Models\Community;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\UserFollowsCommunity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;



    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $request = $this
            ->followingRedirects()
            ->post('login', [
                'username' => $user->username,
                'password' => 'password'
            ]);

        $request->assertOk();
    }

    public function test_user_can_not_see_register_form()
    {
        $user = User::factory()->create();

        $request = $this
            ->actingAs($user)
            ->get('register');

        $request->assertRedirect();
    }

    public function test_user_can_update_username()
    {
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

    public function test_user_can_update_email()
    {
        $user = User::factory()->create();

        $request = $this
            ->actingAs($user)
            ->patch("/u/{$user->username}/update", [
                'username' => $user->username,
                'email' => 'new@email.com',
                'password' => null
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'new@email.com'
        ]);
    }

    public function test_user_can_update_password()
    {
        $user = User::factory()->create();

        $request = $this
            ->actingAs($user)
            ->patch("/u/{$user->username}/update", [
                'username' => $user->username,
                'email' => 'new@email.com',
                'password' => 'newpassword'
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'new@email.com'
        ]);
    }

    public function test_user_can_not_update_to_existing_username()
    {
        $user = User::factory()->create();
        $secondUser = User::factory()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->from("/u/{$user->username}/edit")
            ->patch("/u/{$user->username}/update", [
                'username' => $secondUser->username,
                'email' => $user->email,
                'password' => null
            ]);

        $request->assertSeeText("The username has already been taken.");
    }

    public function test_user_can_not_update_to_existing_email()
    {
        $user = User::factory()->create();
        $secondUser = User::factory()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->from("/u/{$user->username}/edit")
            ->patch("/u/{$user->username}/update", [
                'username' => $user->username,
                'email' => $secondUser->email,
                'password' => null
            ]);

        $request->assertSeeText("The email has already been taken.");
    }

    public function test_user_can_see_front_page_posts()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();
        UserFollowsCommunity::factory()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->get('/');

        $request->assertOk();
        $request->assertSeeText($post->title);
    }

    public function test_user_can_not_see_posts_if_not_following_communities()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->actingAs($user)
            ->get('/');

        $request->assertOk();
        $request->assertSeeText("You don't follow any communities. Explore communities here.", false);
    }

    public function test_user_can_delete_own_user()
    {
        $user = User::factory()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->delete("/u/{$user->username}/delete", [
                'username' => $user->username,
                'email' => $user->email,
                'password' => 'password'
            ]);

        $request->assertOk();
        $this->assertModelMissing($user);
    }

    public function test_user_can_see_their_own_posts()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->get("u/{$user->username}/posts");

        $request->assertOk();
        $request->assertSeeText($post->title);
    }

    public function test_user_can_see_their_own_comments()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->get("u/{$user->username}/comments");

        $request->assertOk();
        $request->assertSeeText($comment->title);
    }

    public function test_user_can_see_their_followed_communities()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        UserFollowsCommunity::factory()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->get("u/{$user->username}/followed-communities");

        $request->assertOk();
        $request->assertSeeText($community->title);
    }

    public function test_user_can_see_their_owned_communities()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->get("u/{$user->username}/owned-communities");

        $request->assertOk();
        $request->assertSeeText($community->title);
    }

    public function test_user_can_see_search_form()
    {
        $user = User::factory()->create();

        $request = $this
            ->actingAs($user)
            ->get('/search');

        $request->assertOk();
        $request->assertSeeText('Query:');
    }

    public function test_user_can_search()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->actingAs($user)
            ->get("/search?q=$post->title");

        $request->assertOk();
        $request->assertSeeText($post->title);
    }
}
