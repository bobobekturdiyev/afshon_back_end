<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
			$table->string('first_name', 255);
			$table->string('last_name', 255)->nullable();
			$table->string('email', 255)->unique();
			$table->string('password', 255);
			$table->enum('role', ['admin','teacher'])->default('admin');
            $table->timestamps();
        });
        DB::table('users')->insert([
            'first_name' => 'Salohiddin',
            'last_name' => 'Nuridinov',
            'email' => 'programmer@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
