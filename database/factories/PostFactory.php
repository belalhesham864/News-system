<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title=fake()->sentence(3);
        $date=fake()->date('Y-m-d h:m:s');
        return [
            'title'=>$title,
            'desc'=>fake()->paragraph(6),
            'slug' => Str::slug($title),
            'status'=>rand(0,1),
            'comment_able'=>rand(0,1),
            'numer_of_view'=>rand(0,100),
            'user_id'=>User::inRandomOrder()->first()->id,
            'category_id'=>Category::inRandomOrder()->first()->id,
            'created_at'=>$date,
            'updated_at'=>$date,
        ];
    }
}
