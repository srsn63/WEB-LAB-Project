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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            // Basic identity fields for teacher records
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();

            // Contact and location details surfaced on the dashboard
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('office_room')->nullable();
            $table->string('website_url')->nullable();

            // Media & narrative content powering the rich profile view
            $table->string('profile_image')->nullable();
            $table->text('short_bio')->nullable();
            $table->text('research_interests')->nullable();

            // JSON blobs let us store structured lists (education, honors, courses) per teacher
            $table->json('education')->nullable();
            $table->json('honors')->nullable();
            $table->json('courses')->nullable();

            // Long form content for publications or additional narrative sections
            $table->longText('publications')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
