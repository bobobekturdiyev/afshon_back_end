<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Salohiddin',
            'last_name' => 'Nuridinov',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
//        User::factory(10)->create();
    }
}
