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
            $table->id();
            $table->foreignId('lu_event_type_id')
                  ->constrained('lu_event_types');
            $table->foreignId('lu_event_status_id')
                  ->constrained('lu_event_statuses');
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->foreignId('city_id')
                  ->constrained('cities');
            $table->string('title', 250);
            $table->string('slug', 255)
                  ->unique();
            $table->text('description');
            $table->text('address');
            $table->text('map_url')
                  ->nullable();
            $table->text('meet_url')
                  ->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();
            $table->softDeletes();
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
