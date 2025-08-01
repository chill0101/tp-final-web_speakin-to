
// Migration for creating the users, password reset tokens, and sessions tables.
// The users table stores all system users (admin, coordinator, professor) with role-based access.
// The password_reset_tokens table is used for password recovery functionality.
// The sessions table is used for user session management (default Laravel feature).
// All columns and constraints are defined according to the project requirements in consigna.md.
// Comments are provided for clarity and documentation.

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Run the migrations.
     * This method creates the users, password_reset_tokens, and sessions tables.
     */
    public function up(): void
    {
        // Create the users table for all system users (admin, coordinator, professor)
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); 
            $table->string('email')->unique(); // Unique email for login
            $table->timestamp('email_verified_at')->nullable(); // Default Laravel column, not used in this app
            $table->string('password'); // Hashed password
            $table->enum('role', ['admin', 'coordinator', 'professor'])->default('professor'); // User role for access control
            $table->rememberToken(); 
            $table->timestamps(); // Created at / updated at and those things
        });

        // Create the password_reset_tokens table for password recovery
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Email as primary key
            $table->string('token'); 
            $table->timestamp('created_at')->nullable(); 
        });

        // Create the sessions table for user session management
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Session ID
            $table->foreignId('user_id')->nullable()->index(); // Reference to user (nullable for guests)
            $table->string('ip_address', 45)->nullable(); // User's IP address
            $table->text('user_agent')->nullable(); 
            $table->longText('payload'); 
            $table->integer('last_activity')->index(); 
                });
    }

    /**
     * Reverse the migrations.
     * This method drops the users, password_reset_tokens, and sessions tables.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Drop users table
        Schema::dropIfExists('password_reset_tokens'); // Drop password reset tokens table
        Schema::dropIfExists('sessions'); // Drop sessions table
    }
};
