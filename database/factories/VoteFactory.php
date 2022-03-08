<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()
        ];
    }

    public function downvote(){
        return $this->state(function ($attributes){
            return [
                'is_up' => false
            ];
        });
    }

    public function upvote(){
        return $this->state(function ($attributes){
            return [
                'is_up' => true
            ];
        });
    }

    public function on_post(){
        return $this->state(function ($attributes){
            return [
                'post_id' => Post::all()->random(),
                'comment_id' => null
            ];
        });
    }

    public function on_comment(){
        return $this->state(function ($attributes){
            return [
                'comment_id' => Comment::all()->random(),
                'post_id' => null
            ];
        });
    }
}