<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('painting_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('image');
            
            //foreign key
            $table->foreignUuid('painting_id');              $table->foreign('painting_id')->references('id')->on('paintings');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('painting_images');
    }
};
