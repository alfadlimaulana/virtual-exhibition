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
        Schema::create('liked_paintings', function (Blueprint $table) {
            $table->uuid('id')->primary();

            //foreign key
            $table->foreignUuid('user_id');              $table->foreign('user_id')->references('id')->on('users');
            $table->foreignUuid('painting_id');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liked_paintings');
    }
};
