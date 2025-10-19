<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 7)->unique(); // Format: 2107063 (batch+dept+serial)
            $table->string('name');
            $table->string('email')->unique(); // format: studentid@student.kuet.ac.bd
            $table->string('password');
            $table->string('batch', 4); // 2k20, 2k21, 2k22, 2k23, 2k24
            $table->string('phone')->nullable();
            $table->string('profile_picture')->nullable();
            $table->decimal('cgpa', 3, 2)->nullable()->default(0.00);
            $table->string('current_semester')->nullable();
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
