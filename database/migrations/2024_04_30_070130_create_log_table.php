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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('puuid');  // This is correct for storing the UUID.
            $table->string('match_id');
            $table->integer('placement');
            $table->json('participants')->nullable();

            $table->timestamps();

            // Correcting foreign key definition
            $table->foreign('puuid')->references('puuid')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
