<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_comment(){}

    public function test_user_can_reply_to_comment(){}

    public function test_user_can_see_post_with_comments_and_replys(){}

    public function test_user_can_upvote_comment(){}

    public function test_user_can_downvote_comment(){}

    public function test_user_can_delete_own_comment(){}

    public function test_user_can_not_delete_other_users_comment(){}
}
