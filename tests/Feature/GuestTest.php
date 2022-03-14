<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Community;
use App\Models\Post;
use App\Models\User;
use App\Models\UserFollowsCommunity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GuestTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_see_register_form()
    {
        $response = $this->get('register');
        $response->assertOk();
        $response->assertSeeText('Email');
    }

    public function test_guest_can_see_login_form()
    {
        $response = $this->get('login');
        $response->assertOk();
        $response->assertSeeText('Username');
    }

    public function test_guest_can_not_register_with_existing_username()
    {
        $user = User::factory()->create();

        $request = $this
            ->followingRedirects()
            ->from('register')
            ->post('register', [
                'username' => $user->username,
                'email' => 'new_email@yrgo.com',
                'password' => 'password'
            ]);

        $request->assertSeeText("The username has already been taken.");
    }

    public function test_guest_can_not_register_with_existing_email()
    {
        $user = User::factory()->create();

        $request = $this
            ->followingRedirects()
            ->from('register')
            ->post('register', [
                'username' => 'bruce',
                'email' => $user->email,
                'password' => 'password'
            ]);

        $request->assertSeeText("The email has already been taken.");
    }

    public function test_guest_can_see_front_page_posts()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this->get('/');

        $request->assertOk();
        $request->assertSeeText($post->title);
    }

    public function test_guest_can_see_users_profile()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();

        $request = $this
            ->get("/u/{$user->username}");

        $request->assertOk();
        $request->assertSeeText($user->username);
    }

    public function test_guest_can_see_users_posts()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();

        UserFollowsCommunity::factory()->create();

        $post = Post::factory()->text_type()->create();

        $request = $this
            ->get("/u/{$user->username}/posts");

        $request->assertOk();
        $request->assertSeeText($post->content);
    }

    public function test_guest_can_see_users_comments()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();

        UserFollowsCommunity::factory()->create();

        $post = Post::factory()->text_type()->create();
        $comment = Comment::factory()->create();

        $request = $this
            ->get("/u/{$user->username}/comments");

        $request->assertOk();
        $request->assertSeeText($comment->content);
    }

    public function test_guest_can_see_users_followed_communities()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();

        UserFollowsCommunity::factory()->create();

        $request = $this
            ->get("/u/{$user->username}/followed-communities");

        $request->assertOk();
        $request->assertSeeText("/c/{$community->title}");
    }

    public function test_guest_can_see_users_owned_communities()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();

        $request = $this
            ->get("/u/{$user->username}/owned-communities");

        $request->assertOk();
        $request->assertSeeText("/c/{$community->title}");
    }

    public function test_guest_can_not_create_community()
    {
        $request = $this
            ->followingRedirects()
            ->post('/c/create', [
                'title' => 'Test community'
            ]);

        $request->assertOk();
        $this->assertDatabaseMissing('communities', [
            'title' => 'Test community'
        ]);
    }

    public function test_guest_can_not_create_post()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();

        $request = $this
            ->followingRedirects()
            ->post('/submit', [
                'type' => 'text',
                'title' => 'Test post',
                'content' => 'Some content',
                'community' => $community->title
            ]);

        $request->assertOk();
        $this->assertDatabaseMissing('posts', [
            'type' => 'text',
            'title' => 'Test post',
            'content' => 'Some content',
            'community' => $community->title
        ]);
    }

    public function test_guest_can_not_create_comment()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->followingRedirects()
            ->post("/c/{$community->title}/p/{$post->getHashId()}/comment/create", [
                'content' => 'Test comment'
            ]);

        $request->assertOk();
        $this->assertDatabaseMissing('comments', [
            'content' => 'Test comment'
        ]);
    }

    public function test_guest_can_not_upvote_post()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->followingRedirects()
            ->get("/c/{$community->title}/p/{$post->title}/upvote");

        $request->assertOk();
        $this->assertDatabaseCount('votes', 0);
    }

    public function test_guest_can_not_downvote_post()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->followingRedirects()
            ->get("/c/{$community->title}/p/{$post->title}/downvote");

        $request->assertOk();
        $this->assertDatabaseCount('votes', 0);
    }

    public function test_guest_can_not_delete_post()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->followingRedirects()
            ->delete("/c/{$community->title}/p/{$post->title}/delete");

        $request->assertOk();
        $this->assertModelExists($post);
        // $this->assertDatabaseHas('posts', ['id' => $post->id]);
    }

    public function test_guest_can_not_delete_comment()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();
        $comment = Comment::factory()->on_post()->create();

        $request = $this
            ->followingRedirects()
            ->delete("/c/{$community->title}/p/{$post->title}/comment/{$comment->getHashId()}/delete");

        $request->assertOk();
        $this->assertModelExists($comment);
    }

    public function test_guest_can_not_delete_community()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();

        $request = $this
            ->followingRedirects()
            ->delete("/c/{$community->title}");

        $request->assertOk();
        $this->assertModelExists($community);
    }

    public function test_guest_can_not_delete_user()
    {
        $user = User::factory()->create();

        $request = $this
            ->followingRedirects()
            ->post("/u/{$user->username}/delete");

        $this->assertDatabaseHas('users', [
            'id' => $user->id
        ]);
    }

    public function test_guest_can_not_follow_community()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();

        $request = $this
            ->followingRedirects()
            ->post("/c/create/{$community->title}/follow");

        $this->assertDatabaseCount('user_follows_communities', 0);
    }

    public function test_guest_can_see_search_form()
    {
        $response = $this->get('/search');
        $response->assertOk();
        $response->assertSeeText('Query:');
    }

    public function test_guest_can_search()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->get("/search?q=$post->title");

        $request->assertOk();
        $request->assertSeeText($post->title);
    }
}
