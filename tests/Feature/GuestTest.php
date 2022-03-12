<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GuestTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_see_front_page_posts(){}

    public function test_guest_can_see_users_profile(){}

    public function test_guest_can_see_users_posts(){}

    public function test_guest_can_see_users_comments(){}

    public function test_guest_can_see_users_followed_communities(){}

    public function test_guest_can_see_users_owned_communities(){}

    public function test_guest_can_not_create_post(){}

    public function test_guest_can_not_create_comment(){}

    public function test_guest_can_not_upvote_post(){}

    public function test_guest_can_not_downvote_post(){}

    public function test_guest_can_not_delete_post(){}

    public function test_guest_can_not_delete_comment(){}

    public function test_guest_can_not_delete_community(){}

    public function test_guest_can_not_delete_user(){}

    public function test_guest_can_not_follow_community(){}
}
