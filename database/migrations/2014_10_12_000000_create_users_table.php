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
            $table->string('role_name')->nullable(); // Role name as a string (optional)
            $table->unsignedBigInteger('role_id')->nullable(); // Role ID column (nullable initially)
            $table->string('email')->unique(); // User email (unique)
            $table->timestamp('email_verified_at')->nullable(); // Email verified timestamp
            $table->string('password'); // Hashed password
            $table->rememberToken(); // For "Remember Me" sessions
            $table->timestamps();
    
            // NOTE: Foreign key constraint removed for now
        });
    
        // Insert users with roles set to null for now
        DB::table('users')->insert([
            [
                'name' => 'lakshanaapriya',
                'role_id' => null,
                'role_name'=>'super admin',
                'email' => 'lakshanaapriyavijay@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('lakshanaapriya'), // Hashed password
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'harishkumar',
                'role_id' => null, 
                'role_name'=>'support admin',
                'email' => 'harishkumar2002@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('harishkumar'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'James Doe',
                'role_id' => null, 
                'role_name'=>'company admin',
                'email' => 'companyadmin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('CompanyAdmin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
