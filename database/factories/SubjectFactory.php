<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title_uz' => fake()->word,
            'title_ru' => fake()->word,
            'title_en' => fake()->word,
            'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fflamingtext.com%2FWord-Logos%2Fsubject%2F&psig=AOvVaw2t2pV-0X2i7gaJD4BSKmZy&ust=1697366783769000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCPjkt5Ou9YEDFQAAAAAdAAAAABAE'
        ];
    }
}
