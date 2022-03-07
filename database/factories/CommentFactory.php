<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => $this->faker->paragraph(),
            'user_id' => User::all()->random()
        ];
    }

    public function on_post(){
        return $this->state(function ($attributes){
            return [
                'post_id' => Post::all()->random(),
                'parent_id' => null
            ];
        });
    }

    public function on_comment(){
        return $this->state(function ($attributes){
            return [
                'parent_id' => Comment::all()->random(),
                'post_id' => null
            ];
        });
    }
}
