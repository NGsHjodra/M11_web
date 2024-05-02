<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('puuid')->nullable()->unique();
            $table->string('summoner_id')->nullable()->unique();
            $table->string('name');
            $table->string('tagline');
            
            $table->string('tier')->nullable();
            $table->string('rank')->nullable();
            $table->unsignedTinyInteger('point')->nullable();
            $table->date('last_match_history_updated')->nullable();

            $table->timestamps();

            // Adding the unique constraint on name and tagline combination
            $table->unique(['name', 'tagline'], 'unique_name_tagline');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
