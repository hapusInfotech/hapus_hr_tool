<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // 'uid' primary key
            $table->string('name'); // User name
            $table->string('role_name')->nullable(); 
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('email')->unique(); // User email (unique)
            $table->timestamp('email_verified_at')->nullable(); 
            $table->string('password'); // Hashed password
            $table->rememberToken(); // For "Remember Me" sessions
            $table->timestamps();
    
            // NOTE: Foreign key constraint removed for now
        });
 
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
