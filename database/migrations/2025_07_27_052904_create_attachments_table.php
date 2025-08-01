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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('title');
            $table->string('file_url');
            $table->enum('type', ['task', 'material', 'guide']);
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamps();
                    
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            // course id as foreign key to courses table 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // reversible migration (ㆆ_ㆆ)
    {
        Schema::dropIfExists('attachments');
    }
};
