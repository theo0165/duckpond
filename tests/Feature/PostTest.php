<?php

namespace Tests\Feature;

use App\Models\Community;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_see_single_post(){
        $user = User::factory()->create();
        $community = Community::factory()->create();
        $post = Post::factory()->text_type()->create();

        $request = $this
                    ->get("/c/{$community->title}/p/{$post->getHashId()}");

        $request->assertOk();
        $request->assertSeeText($post->title);
    }

    public function test_user_can_create_post(){}

    public function test_user_can_delete_post(){}

    public function test_user_can_upvote_post(){}

    public function test_user_can_downvote_post(){}
}
