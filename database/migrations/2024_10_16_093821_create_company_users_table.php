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
        Schema::create('company_users', function (Blueprint $table) {
            $table->id(); // 'uid' primary key
            $table->string('name'); // User name
            $table->unsignedBigInteger('company_id')->nullable(); // Foreign key for company
            $table->string('email')->unique(); // User email (unique)
            $table->string('password'); // Hashed password
            $table->boolean('force_password_change')->default(true); // Force user to change password on first login
            $table->rememberToken(); // For "Remember Me" sessions
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('company_id')->references('id')->on('company')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_users');
    }
};
