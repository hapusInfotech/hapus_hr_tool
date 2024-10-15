<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add foreign key constraint to users table
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });

        // Assign role IDs based on role name
        $superAdminRoleId = Role::where('name', 'super admin')->first()->id;
        $supportAdminRoleId = Role::where('name', 'support admin')->first()->id;
        $companyAdminRoleId = Role::where('name', 'company admin')->first()->id;

// Update users with the correct role ID for Super Admin
        DB::table('users')
            ->where('email', 'lakshanaapriyavijay@gmail.com')
            ->where('role_name', 'super admin')
            ->update([
                'role_id' => $superAdminRoleId,
            ]);

// Update users with the correct role ID for Support Admin
        DB::table('users')
            ->where('email', 'harishkumar2002@gmail.com')
            ->where('role_name', 'support admin')
            ->update([
                'role_id' => $supportAdminRoleId,
            ]);

// Update users with the correct role ID for Company Admin
        DB::table('users')
            ->where('email', 'companyadmin@example.com')
            ->where('role_name', 'company admin')
            ->update([
                'role_id' => $companyAdminRoleId,
            ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']); // Drop the foreign key constraint
        });
    }
};
