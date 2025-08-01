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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->date('enrollment_date');
            $table->enum('status', ['enrolled', 'in_progress', 'approved', 'failed'])->default('enrolled');
            $table->unsignedTinyInteger('final_grade')->nullable(); // 1-10
            $table->unsignedTinyInteger('attendance')->nullable(); // 0-100
            $table->text('notes')->nullable();
            $table->boolean('graded_by_teacher')->default(false);
            $table->timestamps();
                    // Foreign keys
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->unique(['student_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
