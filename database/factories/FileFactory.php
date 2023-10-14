<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name_uz' => fake()->name,
            'name_ru' => fake()->name,
            'name_en' => fake()->name,
            'excerpt_uz' => fake()->text,
            'excerpt_ru' => fake()->text,
            'excerpt_en' => fake()->text,
            'keywords' => fake()->unique()->word,
            'url' => fake()->url,
            'image' => 'https://images.ctfassets.net/23aumh6u8s0i/7gu8qd0qzmuxWWjYLhZpqo/2bb8a206fe4a86af9414545b5c25c368/laravel',
            'user_id' => User::all()->random()->id,
        ];
    }
}
