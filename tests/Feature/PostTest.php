<?php

namespace Tests\Feature;

use App\Models\Community;
use App\Models\Post;
use App\Models\User;
use App\Models\UserFollowsCommunity;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_see_single_post()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->get("/c/{$community->title}/p/{$post->getHashId()}");

        $request->assertOk();
        $request->assertSeeText($post->title);
    }

    public function test_user_can_create_post()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();

        UserFollowsCommunity::factory()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->post('/submit', [
                'type' => 'text',
                'title' => 'Test post',
                'content' => 'Test post content',
                'community' => $community->title
            ]);

        $request->assertOk();
        $this->assertDatabaseHas('posts', [
            'type' => 'text',
            'title' => 'Test post',
            'content' => 'Test post content',
            'community_id' => $community->id,
            'user_id' => $user->id
        ]);
    }

    public function test_user_can_delete_post()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->delete("/c/{$community->title}/p/{$post->getHashId()}/delete");

        $request->assertOk();
        $this->assertModelMissing($post);
    }

    public function test_user_can_upvote_post()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->post("/c/{$community->title}/p/{$post->getHashId()}/upvote");

        $request->assertOk();
        $this->assertDatabaseHas('votes', [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'comment_id' => null,
            'value' => 1
        ]);
    }

    public function test_user_can_not_double_upvote_post()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        Vote::factory()->upvote()->on_post()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->post("/c/{$community->title}/p/{$post->getHashId()}/upvote");

        $request->assertOk();
        $this->assertDatabaseCount('votes', 1);
    }

    public function test_user_can_downvote_post()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->post("/c/{$community->title}/p/{$post->getHashId()}/downvote");

        $request->assertOk();
        $this->assertDatabaseHas('votes', [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'comment_id' => null,
            'value' => -1
        ]);
    }

    public function test_user_can_not_double_downvote_post()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        Vote::factory()->downvote()->on_post()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->post("/c/{$community->title}/p/{$post->getHashId()}/downvote");

        $request->assertOk();
        $this->assertDatabaseCount('votes', 1);
    }
}
