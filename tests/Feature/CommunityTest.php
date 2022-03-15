<?php

namespace Tests\Feature;

use App\Models\Community;
use App\Models\Post;
use App\Models\User;
use App\Models\UserFollowsCommunity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommunityTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_single_community()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->actingAs($user)
            ->followingRedirects()
            ->get("/c/{$community->title}");

        $request->assertOk();
        $request->assertSeeText([
            "/c/{$community->title}",
            $post->title,
        ]);
    }

    public function test_user_can_follow_community()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->actingAs($user)
            ->followingRedirects()
            ->post("/c/{$community->title}/follow");

        $request->assertOk();
        $this->assertDatabaseHas('user_follows_communities', [
            'user_id' => $user->id,
            'community_id' => $community->id
        ]);
    }

    public function test_user_can_not_follow_if_already_following()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        UserFollowsCommunity::factory()->create();

        $request = $this
            ->actingAs($user)
            ->followingRedirects()
            ->post("/c/{$community->title}/follow");

        $request->assertOk();
        $this->assertDatabaseCount('user_follows_communities', 1);
    }

    public function test_user_can_unfollow_community()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        UserFollowsCommunity::factory()->create();

        $request = $this
            ->actingAs($user)
            ->followingRedirects()
            ->post("/c/{$community->title}/unfollow");

        $request->assertOk();
        $this->assertDatabaseCount('user_follows_communities', 0);
    }

    public function test_user_can_not_unfollow_if_not_following()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->actingAs($user)
            ->followingRedirects()
            ->post("/c/{$community->title}/unfollow");

        $request->assertOk();
    }

    public function test_user_can_create_community()
    {
        $user = User::factory()->create();

        $request = $this
            ->actingAs($user)
            ->followingRedirects()
            ->post('/c/create', [
                'title' => 'TestCommunity'
            ]);

        $request->assertOk();
        $this->assertDatabaseHas('communities', [
            'title' => 'TestCommunity',
            'user_id' => $user->id
        ]);
        $this->assertDatabaseCount('communities', 1);
    }

    public function test_user_can_delete_owned_community()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->delete("/c/{$community->title}");

        $request->assertOk();
        $this->assertModelMissing($community);
    }

    public function test_user_can_not_delete_other_users_community()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $secondUser = User::factory()->create();


        $request = $this
            ->followingRedirects()
            ->actingAs($secondUser)
            ->delete("/c/{$community->title}");

        $request->assertForbidden();
        $this->assertModelExists($community);
    }

    public function test_user_can_see_page_with_all_communities()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
            ->actingAs($user)
            ->followingRedirects()
            ->get("/c/all");

        $request->assertOk();
        $request->assertSeeText($community->title);
    }
}
