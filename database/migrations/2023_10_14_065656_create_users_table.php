<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
