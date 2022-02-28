<?php

namespace Database\Factories;

use App\Models\Community;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'user_id' => User::all()->random()->id,
            'community_id' => Community::all()->random()->id
        ];
    }

    public function link_type(){
        return $this->state(function ($attributes){
            return [
                'type' => 'link',
                'content' => $this->faker->url()
            ];
        });
    }

    public function text_type(){
        return $this->state(function($attributes){
            return [
                'type' => 'text',
                'content' => $this->faker->sentence()
            ];
        });
    }
}
