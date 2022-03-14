<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Community;
use App\Models\Post;
use App\Models\User;
use App\Models\UserFollowsCommunity;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_comment()
    {
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

    public function test_user_can_reply_to_comment()
    {
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

    public function test_user_can_see_post_with_comments_and_replies()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();
        $comment = Comment::factory()->on_post()->create();
        $reply = Comment::factory()->on_comment()->create();

        $request = $this->get("/c/{$community->title}/p/{$post->getHashId()}");

        $request->assertOk();
        $request->assertSeeTextInOrder([
            $post->title,
            $comment->content,
            $reply->content
        ]);
    }

    public function test_user_can_upvote_comment()
    {
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

    public function test_user_can_not_double_upvote_comment()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();
        $comment = Comment::factory()->create();

        Vote::factory()->upvote()->on_comment()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->get("/c/{$community->title}/c/{$comment->getHashId()}/upvote");

        $request->assertOk();
        $this->assertDatabaseCount('votes', 1);
    }

    public function test_user_can_downvote_comment()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();
        $comment = Comment::factory()->create();

        $request = $this
            ->actingAs($user)
            ->followingRedirects()
            ->get("/c/{$community->title}/c/{$comment->getHashId()}/downvote");

        $request->assertOk();
        $this->assertDatabaseHas('votes', [
            'post_id' => null,
            'comment_id' => $comment->id,
            'user_id' => $user->id,
            'value' => -1
        ]);
    }

    public function test_user_can_not_double_downvote_comment()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();
        $comment = Comment::factory()->create();

        Vote::factory()->downvote()->on_comment()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->get("/c/{$community->title}/c/{$comment->getHashId()}/downvote");

        $request->assertOk();
        $this->assertDatabaseCount('votes', 1);
    }

    public function test_user_can_delete_own_comment()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();
        $comment = Comment::factory()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($user)
            ->delete("/c/{$community->title}/p/{$post->getHashId()}/comment/{$comment->getHashId()}/delete");

        $request->assertOk();
        $this->assertModelMissing($comment);
    }

    public function test_user_can_not_delete_other_users_comment()
    {
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();
        $comment = Comment::factory()->create();
        $secondUser = User::factory()->create();

        $request = $this
            ->followingRedirects()
            ->actingAs($secondUser)
            ->delete("/c/{$community->title}/p/{$post->getHashId()}/comment/{$comment->getHashId()}/delete");

        $request->assertForbidden();
        $this->assertModelExists($comment);
    }
}
