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
        Schema::create('company', function (Blueprint $table) {
            $table->id(); // Primary Key: Unique company ID
            $table->string('company_name', 255); // The name of the company
            $table->string('company_type', 255); // The type of the company
            $table->string('company_email', 255); // The email of the company
            $table->string('company_phone_number', 20); // The phone number of the company
            $table->text('company_address'); // The address of the company
            // Foreign Keys using foreignId with constrained
            $table->foreignId('uid')->constrained('users')->onDelete('cascade'); // User ID (Foreign Key)
            $table->unsignedInteger('subscription_id');
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
            $table->unsignedBigInteger('roles_id'); // Create 'roles_id' column first
            $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade'); // Foreign key for 'roles'

            $table->unsignedInteger('email_status')->default(0); // Subscriptions emails to sent by default as 0
            $table->unsignedInteger('company_status'); // Active / Inactive status
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
