<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
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
    public function definition(): array
{
    $title = fake()->sentence();

    return [
        'title' => $title,
        'author_id' => User::factory(),
        'category_id' => Category::factory(),
        'slug' => Str::slug($title),
        'body' => fake()->paragraph(5),
    ];
}

}
