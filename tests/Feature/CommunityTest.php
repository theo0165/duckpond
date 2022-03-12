<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommunityTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_single_community(){}

    public function test_user_can_follow_community(){}

    public function test_user_can_not_follow_if_already_following(){}

    public function test_user_can_unfollow_community(){}

    public function test_user_can_not_unfollow_if_not_following(){}

    public function test_user_can_create_community(){}

    public function test_user_can_delete_owned_community(){}

    public function test_user_can_not_delete_other_users_community(){}

    public function test_user_can_see_page_with_all_communities(){}
}
