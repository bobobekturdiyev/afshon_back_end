<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FileJoinSubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'file_id' => File::all()->random()->id,
            'subject_id' => Subject::all()->random()->id,
        ];
    }
}
