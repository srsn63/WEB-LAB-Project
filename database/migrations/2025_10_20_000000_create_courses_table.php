<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('semester'); // 1-1, 1-2, 2-1, 2-2, 3-1, 3-2, 4-1, 4-2
            $table->string('course_code')->unique();
            $table->string('course_name');
            $table->decimal('credits', 3, 1)->default(3.0);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
