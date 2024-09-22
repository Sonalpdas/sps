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
        Schema::create('events', function (Blueprint $table) {
            $table->id();  // Creates 'id' as an auto-incrementing integer
            $table->date('date');  // Stores the event date
            $table->string('title', 32);  // Event title with a maximum length of 32
            $table->text('description');  // Event description
            $table->timestamps();  // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
