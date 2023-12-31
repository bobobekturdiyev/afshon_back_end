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
        Schema::create('file_join_subjects', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('file_id');
			$table->unsignedBigInteger('subject_id');
			$table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
			$table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->unique(['file_id', 'subject_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('file_join_subjects');
    }
};
