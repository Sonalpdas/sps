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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->string('first_name', 32);
            $table->string('last_name', 32);
            $table->string('email', 64);
            $table->string('phone', 11);
            $table->string('child_name', 32);
            $table->string('program', 16);
            $table->string('school', 16);
            $table->string('tour_day', 16);  // e.g., 'Monday'
            $table->string('tour_time', 16); // e.g., '10:00 AM'
            $table->timestamps();  // Created at, Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
