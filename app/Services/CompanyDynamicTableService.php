<?php

namespace App\Services;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class CompanyDynamicTableService
{
    public function createCompanyTables($companyPrefix, $companyId)
    {
        $this->createDepartmentTable($companyPrefix, $companyId);
        $this->createRolesTable($companyPrefix, $companyId);
        $this->createMediaTable($companyPrefix, $companyId);
        $this->createFileTable($companyPrefix, $companyId);
        $this->createShiftsTable($companyPrefix, $companyId);
        $this->createEmployeesTable($companyPrefix, $companyId);
        $this->createEmployeeEducationalDetailsTable($companyPrefix, $companyId);
        $this->createEmployeeExperienceDetailsTable($companyPrefix, $companyId);
        $this->createEmployeePersonalDetailsTable($companyPrefix, $companyId);
        $this->createEmployeeWorkDetailsTable($companyPrefix, $companyId);
        $this->createEmployeeReportingToTable($companyPrefix, $companyId);
        $this->createNoticeTable($companyPrefix, $companyId);
        $this->createEmployeeResignationTable($companyPrefix, $companyId);
    }

    private function createDepartmentTable($companyPrefix, $id)
    {
        $tableName = $id . '_' . $companyPrefix . '_departments'; // Custom table name for departments
        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->string('department');
                $table->integer('weight')->default(0);
                $table->unsignedBigInteger('company_id'); // Foreign key for the company
                $table->unsignedBigInteger('uid'); // Foreign key for the company user
                $table->timestamps();

                // Define foreign keys
                $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
                $table->foreign('uid')->references('id')->on('company_users')->onDelete('cascade');
            });
        }

        // Generate the model for the department table with foreign keys and relationships
        $this->generateDepartmentModel($companyPrefix, $id);
    }

    private function generateDepartmentModel($companyPrefix, $id)
    {
        // Create the department model name based on company prefix
        $modelName = ucfirst($companyPrefix) . 'Department';

        // Path to place the model inside the "Company" directory
        $modelNamespacePath = "Company/{$modelName}";

        // Generate the department model using the Artisan command and place it inside the "Company" directory
        Artisan::call('make:model', ['name' => $modelNamespacePath]);

        // Path to the generated department model
        $modelPath = app_path("Models/Company/{$modelName}.php");

        // Define the fillable fields for the department model
        $fillableFieldsString = "['department', 'weight', 'company_id', 'uid']";

        // Add the table, fillable properties, and relationships to the generated department model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name, fillable fields, and relationships (belongsTo)
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$id}_{$companyPrefix}_departments';\n\n    protected \$fillable = {$fillableFieldsString};\n\n" .
                "    public function company() {\n        return \$this->belongsTo(\\App\\Models\\Company::class);\n    }\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'uid');\n    }",
                $modelContent
            );

            // Save the updated department model content
            File::put($modelPath, $modelContent);
        }
    }

    private function createRolesTable($companyPrefix, $id)
    {
        $tableName = $id . '_' . $companyPrefix . '_roles'; // Custom table name for roles
        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($companyPrefix, $id) {
                $table->id();
                $table->string('roles');
                $table->integer('weight')->default(0);
                $table->unsignedBigInteger('department_id'); // Foreign key for the department
                $table->unsignedBigInteger('company_id'); // Foreign key for the company
                $table->unsignedBigInteger('uid'); // Foreign key for the company user
                $table->timestamps();

                // Define foreign keys
                $table->foreign('department_id')->references('id')->on("{$id}_{$companyPrefix}_departments")->onDelete('cascade');
                $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
                $table->foreign('uid')->references('id')->on('company_users')->onDelete('cascade');
            });
        }

        // Generate the model for the roles table with relationships
        $this->generateRolesModel($companyPrefix, $id);
    }

    private function generateRolesModel($companyPrefix, $id)
    {
        $table_prefix = ucfirst($companyPrefix);
        // Create the roles model name based on company prefix
        $modelName = $table_prefix . 'Role';
        // Path to place the model inside the "Company" directory
        $modelNamespacePath = "Company/{$modelName}";

        // Generate the roles model using the Artisan command
        Artisan::call('make:model', ['name' => $modelNamespacePath]);

        // Path to the generated roles model
        $modelPath = app_path("Models/Company/{$modelName}.php");

        // Define the fillable fields for the roles model
        $fillableFieldsString = "['roles', 'weight', 'department_id', 'company_id', 'uid']";

        // Add the table, fillable properties, and relationships to the generated roles model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name, fillable fields, and relationships (belongsTo)
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$id}_{$companyPrefix}_roles';\n\n    protected \$fillable = {$fillableFieldsString};\n\n" .
                "    public function department() {\n        return \$this->belongsTo(\\App\\Models\\Company\\{$table_prefix}Department::class);\n    }\n\n" .
                "    public function company() {\n        return \$this->belongsTo(\\App\\Models\\Company::class);\n    }\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'uid');\n    }",
                $modelContent
            );

            // Save the updated roles model content
            File::put($modelPath, $modelContent);
        }
    }

    // Method to create the media table with foreign key for company_users
    private function createMediaTable($companyPrefix, $id)
    {
        $tableName = $id . '_' . $companyPrefix . '_media'; // Custom table name for media
        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->string('media_name'); // File path
                $table->string('media_type'); // File path
                $table->string('media_path'); // File path
                $table->unsignedBigInteger('uploaded_by'); // Foreign key for the company user
                $table->timestamps();

                // Define foreign keys
                $table->foreign('uploaded_by')->references('id')->on('company_users')->onDelete('cascade');
            });
        }

        // Generate the model for the media table with relationships
        $this->generateMediaModel($companyPrefix, $id);
    }

    // Helper method to generate model for media
    private function generateMediaModel($companyPrefix, $id)
    {
        // Create the media model name based on company prefix
        $modelName = ucfirst($companyPrefix) . 'Media';

        // Path to place the model inside the "Company" directory
        $modelNamespacePath = "Company/{$modelName}";

        // Generate the roles model using the Artisan command
        Artisan::call('make:model', ['name' => $modelNamespacePath]);

        // Path to the generated roles model
        $modelPath = app_path("Models/Company/{$modelName}.php");

        // Define the fillable fields for the media model
        $fillableFieldsString = "['media_name', 'media_type', 'media_path', 'uploaded_by']";

        // Add the table, fillable properties, and relationships to the generated media model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name, fillable fields, and relationships (belongsTo for uid)
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$id}_{$companyPrefix}_media';\n\n    protected \$fillable = {$fillableFieldsString};\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'uid');\n    }",
                $modelContent
            );

            // Save the updated media model content
            File::put($modelPath, $modelContent);
        }
    }

    // Method to create the file table with foreign key for company_users
    private function createFileTable($companyPrefix, $id)
    {
        $tableName = $id . '_' . $companyPrefix . '_files'; // Custom table name for files
        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->string('file_name'); // File path
                $table->string('file_type'); // File path
                $table->string('file_path'); // File path
                $table->unsignedBigInteger('uploaded_by'); // Foreign key for the company user
                $table->timestamps();

                // Define foreign keys
                $table->foreign('uploaded_by')->references('id')->on('company_users')->onDelete('cascade');
            });
        }

        // Generate the model for the file table with relationships
        $this->generateFileModel($companyPrefix, $id);
    }

    // Helper method to generate model for file
    private function generateFileModel($companyPrefix, $id)
    {
        // Create the file model name based on company prefix
        $modelName = ucfirst($companyPrefix) . 'File';

        // Path to place the model inside the "Company" directory
        $modelNamespacePath = "Company/{$modelName}";

        // Generate the roles model using the Artisan command
        Artisan::call('make:model', ['name' => $modelNamespacePath]);

        // Path to the generated roles model
        $modelPath = app_path("Models/Company/{$modelName}.php");

        // Define the fillable fields for the file model
        $fillableFieldsString = "['file_name', 'file_type', 'file_path', 'uploaded_by']";

        // Add the table, fillable properties, and relationships to the generated file model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name, fillable fields, and relationships (belongsTo for uid)
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$id}_{$companyPrefix}_files';\n\n    protected \$fillable = {$fillableFieldsString};\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'uid');\n    }",
                $modelContent
            );

            // Save the updated file model content
            File::put($modelPath, $modelContent);
        }
    }

    private function createShiftsTable($companyPrefix, $companyId)
    {
        // Table name dynamically based on the company prefix and ID
        $tableName = $companyId . '_' . $companyPrefix . '_shifts';

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($companyPrefix, $companyId) {
                $table->id(); // Auto-incrementing ID field

                // Shift details
                $table->string('shift_type'); // Type of shift
                $table->string('shift_name'); // Name of the shift
                $table->time('shift_start_time'); // Start time of the shift
                $table->time('shift_end_time'); // End time of the shift
                $table->integer('shift_liberal_hrs')->default(0); // Liberal hours (allowed flexible time)

                // Foreign key referencing company_users table's id
                $table->unsignedBigInteger('uid');
                $table->foreign('uid')
                    ->references('id')
                    ->on('company_users')
                    ->onDelete('cascade');

                $table->timestamps(); // Automatically adds created_at and updated_at fields
            });
        }
        $this->generateShiftsModel($companyPrefix, $companyId);
    }

    private function generateShiftsModel($companyPrefix, $companyId)
    {
        // Create the model name based on company prefix
        $modelName = ucfirst($companyPrefix) . 'Shift';

        // Path to place the model inside the "Company" directory
        $modelNamespacePath = "Company/{$modelName}";

        // Generate the shifts model using the Artisan command
        Artisan::call('make:model', ['name' => $modelNamespacePath]);

        // Path to the generated shifts model
        $modelPath = app_path("Models/Company/{$modelName}.php");

        // Define the fillable fields for the shifts model
        $fillableFieldsString = "['shift_type', 'shift_name', 'shift_start_time', 'shift_end_time', 'shift_liberal_hrs', 'uid']";

        // Add the table, fillable properties, and relationships to the generated model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name, fillable fields, and relationships (belongsTo)
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$companyId}_{$companyPrefix}_shifts';\n\n    protected \$fillable = {$fillableFieldsString};\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'uid');\n    }",
                $modelContent
            );

            // Save the updated shifts model content
            File::put($modelPath, $modelContent);
        }
    }

    private function createEmployeesTable($companyPrefix, $companyId)
    {
        // Table name dynamically based on the company prefix and ID
        $tableName = $companyId . '_' . $companyPrefix . '_employees';

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($companyPrefix, $companyId) {
                $table->id(); // Auto-incrementing ID field
                $table->string('emp_id')->unique(); // Unique employee ID
                $table->string('emp_name'); // Employee name
                $table->string('emp_email')->unique(); // Employee email (unique)
                $table->string('emp_username')->unique()->nullable(); // Username (unique)
                $table->tinyInteger('emp_gender')->comment('0=male, 1=female, 2=other')->nullable(); // Gender with predefined values

                // Foreign key referencing company-specific media table
                $table->unsignedBigInteger('emp_profile_id')->nullable();
                $table->foreign('emp_profile_id')
                    ->references('id')
                    ->on("{$companyId}_{$companyPrefix}_media")
                    ->onDelete('cascade');

                $table->string('emp_role'); // Employee role
                $table->unsignedBigInteger('emp_role_id'); // Role ID

                // Foreign key referencing company_users table
                $table->unsignedBigInteger('emp_uid');
                $table->foreign('emp_uid')
                    ->references('id')
                    ->on('company_users')
                    ->onDelete('cascade');

                // Foreign key for account creator user
                $table->unsignedBigInteger('account_creator_uid');
                $table->foreign('account_creator_uid')
                    ->references('id')
                    ->on('company_users')
                    ->onDelete('cascade');

                $table->tinyInteger('active_status')->default(1); // Status (0 = inactive, 1 = active)

                // Foreign key referencing company table
                $table->unsignedBigInteger('company_id');
                $table->foreign('company_id')
                    ->references('id')
                    ->on('company')
                    ->onDelete('cascade');

                $table->timestamps(); // Automatically adds created_at and updated_at fields
            });
        }

        $this->generateEmployeeModel($companyPrefix, $companyId);
    }

    private function generateEmployeeModel($companyPrefix, $companyId)
    {
        // Create the employee model name based on company prefix
        $modelName = ucfirst($companyPrefix) . 'Employee';

        // Path to place the model inside the "Company" directory
        $modelNamespacePath = "Company/{$modelName}";

        // Generate the employee model using the Artisan command
        Artisan::call('make:model', ['name' => $modelNamespacePath]);

        // Path to the generated employee model
        $modelPath = app_path("Models/Company/{$modelName}.php");

        // Define the fillable fields for the employee model
        $fillableFieldsString = "['emp_id', 'emp_name', 'emp_email', 'emp_username', 'emp_gender', 'emp_profile_id', 'emp_role', 'emp_role_id', 'emp_uid', 'account_creator_uid', 'active_status', 'company_id']";

        // Add the table, fillable properties, and relationships to the generated employee model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name, fillable fields, and relationships (belongsTo)
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$companyId}_{$companyPrefix}_employees';\n\n    protected \$fillable = {$fillableFieldsString};\n\n" .
                "    public function company() {\n        return \$this->belongsTo(\\App\\Models\\Company::class);\n    }\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'emp_uid');\n    }\n\n" .
                "    public function accountCreator() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'account_creator_uid');\n    }",
                $modelContent
            );

            // Save the updated employee model content
            File::put($modelPath, $modelContent);
        }
    }

    private function createEmployeeEducationalDetailsTable($companyPrefix, $companyId)
    {
        // Table name dynamically based on the company prefix and ID
        $tableName = $companyId . '_' . $companyPrefix . '_employee_educational_details';

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($companyPrefix, $companyId) {
                $table->id(); // Auto-incrementing ID field

                // Foreign key referencing the employees table's emp_id
                $table->string('emp_id');
                $table->foreign('emp_id')
                    ->references('emp_id')
                    ->on("{$companyId}_{$companyPrefix}_employees")
                    ->onDelete('cascade');

                $table->string('institute_name'); // Institute name
                $table->string('degree_diploma'); // Degree or diploma
                $table->string('specialization'); // Specialization
                $table->date('date_of_completion'); // Date of completion

                // Foreign key referencing company_users table's id
                $table->unsignedBigInteger('uid');
                $table->foreign('uid')
                    ->references('id')
                    ->on('company_users')
                    ->onDelete('cascade');

                $table->timestamps(); // Automatically adds created_at and updated_at fields
            });
        }
        $this->generateEmployeeEducationalDetailsModel($companyPrefix, $companyId);
    }

    private function generateEmployeeEducationalDetailsModel($companyPrefix, $companyId)
    {
        $table_prefix = ucfirst($companyPrefix);

        // Create the model name based on company prefix
        $modelName = $table_prefix . 'EmployeeEducationalDetail';

        // Path to place the model inside the "Company" directory
        $modelNamespacePath = "Company/{$modelName}";

        // Generate the employee educational details model using the Artisan command
        Artisan::call('make:model', ['name' => $modelNamespacePath]);

        // Path to the generated employee educational details model
        $modelPath = app_path("Models/Company/{$modelName}.php");

        // Define the fillable fields for the employee educational details model
        $fillableFieldsString = "['emp_id', 'institute_name', 'degree_diploma', 'specialization', 'date_of_completion', 'uid']";

        // Add the table, fillable properties, and relationships to the generated model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name, fillable fields, and relationships (belongsTo)
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$companyId}_{$companyPrefix}_employee_educational_details';\n\n    protected \$fillable = {$fillableFieldsString};\n\n" .
                "    public function employee() {\n        return \$this->belongsTo(\\App\\Models\\Company\\{$table_prefix}Employee::class, 'emp_id', 'emp_id');\n    }\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'uid');\n    }",
                $modelContent
            );

            // Save the updated employee educational details model content
            File::put($modelPath, $modelContent);
        }
    }

    private function createEmployeeExperienceDetailsTable($companyPrefix, $companyId)
    {
        // Table name dynamically based on the company prefix and ID
        $tableName = $companyId . '_' . $companyPrefix . '_employee_experience_details';

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($companyPrefix, $companyId) {
                $table->id(); // Auto-incrementing ID field

                // Foreign key referencing the employees table's emp_id
                $table->string('emp_id');
                $table->foreign('emp_id')
                    ->references('emp_id')
                    ->on("{$companyId}_{$companyPrefix}_employees")
                    ->onDelete('cascade');

                $table->string('organization_name'); // Organization name
                $table->string('designation'); // Designation
                $table->date('date_of_joining'); // Date of joining
                $table->date('date_of_releaving')->nullable(); // Date of leaving (nullable if still employed)

                // Foreign key referencing company_users table's id
                $table->unsignedBigInteger('uid');
                $table->foreign('uid')
                    ->references('id')
                    ->on('company_users')
                    ->onDelete('cascade');

                $table->timestamps(); // Automatically adds created_at and updated_at fields
            });
        }
        $this->generateEmployeeExperienceDetailsModel($companyPrefix, $companyId);
    }

    private function generateEmployeeExperienceDetailsModel($companyPrefix, $companyId)
    {
        $table_prefix = ucfirst($companyPrefix);

        // Create the model name based on company prefix
        $modelName = $table_prefix . 'EmployeeExperienceDetail';

        // Path to place the model inside the "Company" directory
        $modelNamespacePath = "Company/{$modelName}";

        // Generate the employee experience details model using the Artisan command
        Artisan::call('make:model', ['name' => $modelNamespacePath]);

        // Path to the generated employee experience details model
        $modelPath = app_path("Models/Company/{$modelName}.php");

        // Define the fillable fields for the employee experience details model
        $fillableFieldsString = "['emp_id', 'organization_name', 'designation', 'date_of_joining', 'date_of_releaving', 'uid']";

        // Add the table, fillable properties, and relationships to the generated model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name, fillable fields, and relationships (belongsTo)
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$companyId}_{$companyPrefix}_employee_experience_details';\n\n    protected \$fillable = {$fillableFieldsString};\n\n" .
                "    public function employee() {\n        return \$this->belongsTo(\\App\\Models\\Company\\{$table_prefix}Employee::class, 'emp_id', 'emp_id');\n    }\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'uid');\n    }",
                $modelContent
            );

            // Save the updated employee experience details model content
            File::put($modelPath, $modelContent);
        }
    }

    private function createEmployeePersonalDetailsTable($companyPrefix, $companyId)
    {
        // Table name dynamically based on the company prefix and ID
        $tableName = $companyId . '_' . $companyPrefix . '_employee_personal_details';

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($companyPrefix, $companyId) {
                $table->id(); // Auto-incrementing ID field

                // Foreign key referencing the employees table's emp_id
                $table->string('emp_id');
                $table->foreign('emp_id')
                    ->references('emp_id')
                    ->on("{$companyId}_{$companyPrefix}_employees")
                    ->onDelete('cascade');

                $table->date('date_of_birth')->nullable(); // Date of birth
                $table->string('marital_status')->nullable(); // Marital status
                $table->string('blood_group')->nullable(); // Blood group
                $table->text('present_address')->nullable(); // Present address
                $table->text('permanent_address')->nullable(); // Permanent address
                $table->string('personal_mobile_no')->nullable(); // Personal mobile number
                $table->string('work_mobile_no')->nullable(); // Personal mobile number

                // Foreign key referencing company_users table's id
                $table->unsignedBigInteger('uid');
                $table->foreign('uid')
                    ->references('id')
                    ->on('company_users')
                    ->onDelete('cascade');

                $table->timestamps(); // Automatically adds created_at and updated_at fields
            });
        }
        $this->generateEmployeePersonalDetailsModel($companyPrefix, $companyId);
    }

    private function generateEmployeePersonalDetailsModel($companyPrefix, $companyId)
    {
        $table_prefix = ucfirst($companyPrefix);

        // Create the model name based on company prefix
        $modelName = $table_prefix . 'EmployeePersonalDetail';

        // Path to place the model inside the "Company" directory
        $modelNamespacePath = "Company/{$modelName}";

        // Generate the employee personal details model using the Artisan command
        Artisan::call('make:model', ['name' => $modelNamespacePath]);

        // Path to the generated employee personal details model
        $modelPath = app_path("Models/Company/{$modelName}.php");

        // Define the fillable fields for the employee personal details model
        $fillableFieldsString = "['emp_id', 'date_of_birth', 'marital_status', 'blood_group', 'present_address', 'permanent_address', 'personal_mobile_no', 'work_mobile_no', 'uid']";

        // Add the table, fillable properties, and relationships to the generated model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name, fillable fields, and relationships (belongsTo)
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$companyId}_{$companyPrefix}_employee_personal_details';\n\n    protected \$fillable = {$fillableFieldsString};\n\n" .
                "    public function employee() {\n        return \$this->belongsTo(\\App\\Models\\Company\\{$table_prefix}Employee::class, 'emp_id', 'emp_id');\n    }\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'uid');\n    }",
                $modelContent
            );

            // Save the updated employee personal details model content
            File::put($modelPath, $modelContent);
        }
    }

    private function createEmployeeWorkDetailsTable($companyPrefix, $companyId)
    {
        // Table name dynamically based on the company prefix and ID
        $tableName = $companyId . '_' . $companyPrefix . '_employee_work_details';

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($companyPrefix, $companyId) {
                $table->id(); // Auto-incrementing ID field

                // Foreign key referencing the employees table's emp_id
                $table->string('emp_id');
                $table->foreign('emp_id')
                    ->references('emp_id')
                    ->on("{$companyId}_{$companyPrefix}_employees")
                    ->onDelete('cascade');

                // Foreign key referencing the departments table
                $table->unsignedBigInteger('department_id');
                $table->foreign('department_id')
                    ->references('id')
                    ->on("{$companyId}_{$companyPrefix}_departments")
                    ->onDelete('cascade');
                // Foreign key referencing the shifts table
                $table->unsignedBigInteger('shift_id');
                $table->foreign('shift_id')
                    ->references('id')
                    ->on("{$companyId}_{$companyPrefix}_shifts")
                    ->onDelete('cascade');

                $table->string('location'); // Work location
                $table->string('designation'); // Designation
                $table->date('date_of_joining'); // Date of joining

                // Foreign key referencing company_users table's id
                $table->unsignedBigInteger('uid');
                $table->foreign('uid')
                    ->references('id')
                    ->on('company_users')
                    ->onDelete('cascade');

                $table->timestamps(); // Automatically adds created_at and updated_at fields
            });
        }

        $this->generateEmployeeWorkDetailsModel($companyPrefix, $companyId);
    }

    private function generateEmployeeWorkDetailsModel($companyPrefix, $companyId)
    {
        $table_prefix = ucfirst($companyPrefix);

        // Create the model name based on company prefix
        $modelName = $table_prefix . 'EmployeeWorkDetail';

        // Path to place the model inside the "Company" directory
        $modelNamespacePath = "Company/{$modelName}";

        // Generate the employee work details model using the Artisan command
        Artisan::call('make:model', ['name' => $modelNamespacePath]);

        // Path to the generated employee work details model
        $modelPath = app_path("Models/Company/{$modelName}.php");

        // Define the fillable fields for the employee work details model
        $fillableFieldsString = "['emp_id', 'department_id', 'shift_id', 'location', 'designation', 'date_of_joining', 'uid']";

        // Add the table, fillable properties, and relationships to the generated model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name, fillable fields, and relationships (belongsTo)
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$companyId}_{$companyPrefix}_employee_work_details';\n\n    protected \$fillable = {$fillableFieldsString};\n\n" .
                "    public function employee() {\n        return \$this->belongsTo(\\App\\Models\\Company\\{$table_prefix}Employee::class, 'emp_id', 'emp_id');\n    }\n\n" .
                "    public function department() {\n        return \$this->belongsTo(\\App\\Models\\Company\\{$table_prefix}Department::class, 'department_id');\n    }\n\n" .
                "    public function shift() {\n        return \$this->belongsTo(\\App\\Models\\Company\\{$table_prefix}Shift::class, 'shift_id');\n    }\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'uid');\n    }",
                $modelContent
            );

            // Save the updated employee work details model content
            File::put($modelPath, $modelContent);
        }
    }

    private function createEmployeeReportingToTable($companyPrefix, $companyId)
    {
        // Table name dynamically based on the company prefix and ID
        $tableName = $companyId . '_' . $companyPrefix . '_employee_reporting_to';

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($companyPrefix, $companyId) {
                $table->id(); // Auto-incrementing ID field

                // Foreign key referencing the employees table's emp_id (employee)
                $table->string('emp_id');
                $table->foreign('emp_id')
                    ->references('emp_id')
                    ->on("{$companyId}_{$companyPrefix}_employees")
                    ->onDelete('cascade');

                // Foreign key referencing the employees table's emp_id (reporting to employee)
                $table->string('reporting_to_id')->nullable();
                $table->foreign('reporting_to_id')
                    ->references('emp_id')
                    ->on("{$companyId}_{$companyPrefix}_employees")
                    ->onDelete('cascade');

                // Foreign key referencing company_users table's id
                $table->unsignedBigInteger('uid');
                $table->foreign('uid')
                    ->references('id')
                    ->on('company_users')
                    ->onDelete('cascade');

                $table->timestamps(); // Automatically adds created_at and updated_at fields
            });
        }
        $this->generateEmployeeReportingToModel($companyPrefix, $companyId);
    }

    private function generateEmployeeReportingToModel($companyPrefix, $companyId)
    {

        $table_prefix = ucfirst($companyPrefix);

        // Create the model name based on company prefix
        $modelName = $table_prefix . 'EmployeeReportingTo';

        // Path to place the model inside the "Company" directory
        $modelNamespacePath = "Company/{$modelName}";

        // Generate the employee reporting to model using the Artisan command
        Artisan::call('make:model', ['name' => $modelNamespacePath]);

        // Path to the generated employee reporting to model
        $modelPath = app_path("Models/Company/{$modelName}.php");

        // Define the fillable fields for the employee reporting to model
        $fillableFieldsString = "['emp_id', 'reporting_to_id', 'uid']";

        // Add the table, fillable properties, and relationships to the generated model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name, fillable fields, and relationships (belongsTo)
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$companyId}_{$companyPrefix}_employee_reporting_to';\n\n    protected \$fillable = {$fillableFieldsString};\n\n" .
                "    public function employee() {\n        return \$this->belongsTo(\\App\\Models\\Company\\{$table_prefix}Employee::class, 'emp_id', 'emp_id');\n    }\n\n" .
                "    public function reportingTo() {\n        return \$this->belongsTo(\\App\\Models\\Company\\{$table_prefix}Employee::class, 'reporting_to_id', 'emp_id');\n    }\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'uid');\n    }",
                $modelContent
            );

            // Save the updated employee reporting to model content
            File::put($modelPath, $modelContent);
        }
    }

    private function createNoticeTable($companyPrefix, $companyId)
    {
        // Table name dynamically based on the company prefix and ID
        $tableName = $companyId . '_' . $companyPrefix . '_notice';

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($companyPrefix, $companyId) {
                $table->id(); // Auto-incrementing ID field

                // Notice details
                $table->string('notice_type'); // Type of notice
                $table->integer('notice_days'); // Number of notice days

                // Foreign key referencing company_users table's id
                $table->unsignedBigInteger('uid');
                $table->foreign('uid')
                    ->references('id')
                    ->on('company_users')
                    ->onDelete('cascade');

                $table->timestamps(); // Automatically adds created_at and updated_at fields
            });
        }
        $this->generateNoticeModel($companyPrefix, $companyId);
    }

    private function generateNoticeModel($companyPrefix, $companyId)
    {
        // Create the model name based on company prefix
        $modelName = ucfirst($companyPrefix) . 'Notice';

        // Path to place the model inside the "Company" directory
        $modelNamespacePath = "Company/{$modelName}";

        // Generate the notice model using the Artisan command
        Artisan::call('make:model', ['name' => $modelNamespacePath]);

        // Path to the generated notice model
        $modelPath = app_path("Models/Company/{$modelName}.php");

        // Define the fillable fields for the notice model
        $fillableFieldsString = "['notice_type', 'notice_days', 'uid']";

        // Add the table, fillable properties, and relationships to the generated model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name, fillable fields, and relationships (belongsTo)
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$companyId}_{$companyPrefix}_notice';\n\n    protected \$fillable = {$fillableFieldsString};\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'uid');\n    }",
                $modelContent
            );

            // Save the updated notice model content
            File::put($modelPath, $modelContent);
        }
    }

    private function createEmployeeResignationTable($companyPrefix, $companyId)
    {
        // Table name dynamically based on the company prefix and ID
        $tableName = $companyId . '_' . $companyPrefix . '_employee_resignation';

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($companyPrefix, $companyId) {
                $table->id(); // Auto-incrementing ID field

                // Foreign key referencing the notice table's id
                $table->unsignedBigInteger('notice_id');
                $table->foreign('notice_id')
                    ->references('id')
                    ->on("{$companyId}_{$companyPrefix}_notice")
                    ->onDelete('cascade');

                // Foreign key referencing the employees table's emp_id
                $table->string('emp_id');
                $table->foreign('emp_id')
                    ->references('emp_id')
                    ->on("{$companyId}_{$companyPrefix}_employees")
                    ->onDelete('cascade');

                // Resignation details
                $table->date('start_date'); // Start date of notice period
                $table->date('end_date'); // End date of notice period
                $table->text('reason_for_releiving'); // Reason for resignation

                // Foreign key referencing company_users table's id
                $table->unsignedBigInteger('uid');
                $table->foreign('uid')
                    ->references('id')
                    ->on('company_users')
                    ->onDelete('cascade');

                $table->timestamps(); // Automatically adds created_at and updated_at fields
            });
        }
        $this->generateEmployeeResignationModel($companyPrefix, $companyId);
    }

    private function generateEmployeeResignationModel($companyPrefix, $companyId)
    {
        $table_prefix = ucfirst($companyPrefix);

        // Create the model name based on company prefix
        $modelName = $table_prefix . 'EmployeeResignation';

        // Path to place the model inside the "Company" directory
        $modelNamespacePath = "Company/{$modelName}";

        // Generate the employee resignation model using the Artisan command
        Artisan::call('make:model', ['name' => $modelNamespacePath]);

        // Path to the generated employee resignation model
        $modelPath = app_path("Models/Company/{$modelName}.php");

        // Define the fillable fields for the employee resignation model
        $fillableFieldsString = "['notice_id', 'emp_id', 'start_date', 'end_date', 'reason_for_releiving', 'uid']";

        // Add the table, fillable properties, and relationships to the generated model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name, fillable fields, and relationships (belongsTo)
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$companyId}_{$companyPrefix}_employee_resignation';\n\n    protected \$fillable = {$fillableFieldsString};\n\n" .
                "    public function notice() {\n        return \$this->belongsTo(\\App\\Models\\Company\\{$table_prefix}Notice::class, 'notice_id');\n    }\n\n" .
                "    public function employee() {\n        return \$this->belongsTo(\\App\\Models\\Company\\{$table_prefix}Employee::class, 'emp_id', 'emp_id');\n    }\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'uid');\n    }",
                $modelContent
            );

            // Save the updated employee resignation model content
            File::put($modelPath, $modelContent);
        }
    }

}
