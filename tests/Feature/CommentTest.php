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

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_comment(){
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();
        UserFollowsCommunity::factory()->create();

        $request = $this
                    ->followingRedirects()
                    ->actingAs($user)
                    ->post("/c/{$community->title}/p/{$post->getHashId()}/comment/create", [
                        'content' => 'Test comment'
                    ]);

        $request->assertOk();
        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'parent_id' => null,
            'post_id' => $post->id,
            'content' => 'Test comment'
        ]);
    }

    public function test_user_can_reply_to_comment(){
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();
        $comment = Comment::factory()->create();
        UserFollowsCommunity::factory()->create();

        $request = $this
                    ->followingRedirects()
                    ->actingAs($user)
                    ->post("/c/{$community->title}/p/{$post->getHashId()}/comment/{$comment->getHashId()}/create", [
                        'content' => 'Test comment'
                    ]);

        $request->assertOk();
        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'parent_id' => $comment->id,
            'post_id' => null,
            'content' => 'Test comment'
        ]);
    }

    public function test_user_can_see_post_with_comments_and_replys(){}

    public function test_user_can_upvote_comment(){
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();
        $comment = Comment::factory()->create();
        UserFollowsCommunity::factory()->create();

        $request = $this
                    ->followingRedirects()
                    ->actingAs($user)
                    ->get("/c/{$community->title}/c/{$comment->getHashId()}/upvote");

        $request->assertOk();
        $this->assertDatabaseHas('votes', [
            'post_id' => null,
            'comment_id' => $comment->id,
            'user_id' => $user->id,
            'value' => 1
        ]);
    }

    public function test_user_can_downvote_comment(){}

    public function test_user_can_delete_own_comment(){}

    public function test_user_can_not_delete_other_users_comment(){}
}
