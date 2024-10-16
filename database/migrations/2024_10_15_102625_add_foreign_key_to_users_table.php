<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add role_id and role_name only if they don't already exist
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->unsignedBigInteger('role_id')->nullable(); // Add role_id column
            }
            if (!Schema::hasColumn('users', 'role_name')) {
                $table->string('role_name')->nullable(); // Add role_name column
            }
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null'); // Add foreign key constraint
        });

        // Create roles first
        $superAdminRole = Role::create(['name' => 'super admin', 'guard_name' => 'web']);
        $supportAdminRole = Role::create(['name' => 'support admin', 'guard_name' => 'web']);
        $companySuperAdminRole = Role::create(['name' => 'company super admin', 'guard_name' => 'web']);
        $companyAdminRole =  Role::create(['name' => 'company admin', 'guard_name' => 'web']);
        Role::create(['name' => 'authenticated user', 'guard_name' => 'web']);

        // Create permissions
        $permissions = [
            'manage users',
            'view reports',
            'edit profile',
            'manage companies',
            'view and support',
            'manage company employees',
            'access company all'
        ];

        // Create permissions dynamically and assign them as needed
        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        // Assign specific permissions to roles
        $supportAdminRole->givePermissionTo('view and support');
        $companySuperAdminRole->givePermissionTo('access company all');
        $companyAdminRole->givePermissionTo('manage company employees');

        // Assign all permissions to Super Admin
        $superAdminRole->syncPermissions(Permission::all());
        // Insert users and assign role_name and role_id dynamically
        $superAdmin = User::create([
            'name' => 'lakshanaapriya',
            'email' => 'lakshanaapriyavijay@gmail.com',
            'role_name' => $superAdminRole->name, // Add role_name
            'role_id' => $superAdminRole->id, // Add role_id from the created role
            'password' => Hash::make('lakshanaapriya'),
            'email_verified_at' => now(),
        ]);

        $supportAdmin = User::create([
            'name' => 'harishkumar',
            'email' => 'harishkumar2002@gmail.com',
            'role_name' => $supportAdminRole->name, // Add role_name
            'role_id' => $supportAdminRole->id, // Add role_id from the created role
            'password' => Hash::make('harishkumar'),
            'email_verified_at' => now(),
        ]);

        $companyAdmin = User::create([
            'name' => 'harish',
            'email' => 'harish@mail.com',
            'role_name' => $companySuperAdminRole->name, // Add role_name
            'role_id' => $companySuperAdminRole->id,

            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Assign roles to the users
        $superAdmin->assignRole($superAdminRole); // Assign 'super admin' role to superAdmin user
        $supportAdmin->assignRole($supportAdminRole); // Assign 'support admin' role to supportAdmin user
        $companyAdmin->assignRole($companySuperAdminRole); // Assign 'company admin' role to companyAdmin user
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']); // Drop the foreign key constraint
            $table->dropColumn('role_id'); // Drop role_id column
            $table->dropColumn('role_name'); // Drop role_name column
        });

        // Optionally, remove the users and roles if needed
        User::where('email', 'lakshanaapriyavijay@gmail.com')->delete();
        User::where('email', 'harishkumar2002@gmail.com')->delete();
        User::where('email', 'companyadmin@example.com')->delete();

        Role::where('name', 'super admin')->delete();
        Role::where('name', 'support admin')->delete();
        Role::where('name', 'company super admin')->delete();
        Role::where('name', 'company admin')->delete();
        Role::where('name', 'authenticated user')->delete();

        Permission::where('name', 'manage all')->delete();
        Permission::where('name', 'view and support')->delete();
        Permission::where('name', 'access company all')->delete();
        Permission::where('name', 'manage company employees')->delete();
    }
};
