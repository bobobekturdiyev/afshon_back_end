<?php

namespace Database\Seeders;

use App\Models\FileJoinSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileJoinSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // FileJoinSubject::factory(20)->create();

        for ($i = 1; $i <=30; $i++) {
            $a=1;
            if ($a == 10){
                $a = 1;
            }
            ++$a;
            DB::table('file_join_subjects')->insert([
                'file_id' => $i,
                'subject_id' => $a,
            ]);
        }
    }
}
