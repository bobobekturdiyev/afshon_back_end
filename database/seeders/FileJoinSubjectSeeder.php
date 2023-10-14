<?php

namespace Database\Seeders;

use App\Models\FileJoinSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileJoinSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FileJoinSubject::factory(20)->create();
    }
}
