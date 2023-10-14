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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
			$table->string('name_uz', 255);
			$table->string('name_ru', 255);
			$table->string('name_en', 255);
			$table->string('excerpt_uz', 255);
			$table->string('excerpt_ru', 255);
			$table->string('excerpt_en', 255);
			$table->string('keywords', 255);
			$table->string('url', 255);
			$table->string('image', 255);
			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
};
