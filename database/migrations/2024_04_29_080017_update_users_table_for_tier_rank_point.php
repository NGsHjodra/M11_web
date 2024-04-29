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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rating'); // Drop this if it's no longer needed.
            $table->string('tier')->nullable();
            $table->string('rank')->nullable();
            $table->unsignedTinyInteger('point')->nullable(); // Points range from 0 to 100.
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['tier', 'rank', 'point']);
            $table->string('rating')->nullable(); // Add this if you want to revert back to the original design.
        });
    }

};
