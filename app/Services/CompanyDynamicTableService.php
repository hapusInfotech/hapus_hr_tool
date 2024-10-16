<?php

namespace App\Services;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class CompanyDynamicTableService
{

    public function createDepartmentTable($companyPrefix, $id)
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

    public function createRolesTable($companyPrefix, $id)
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

    // Method to create the media table with foreign key for company_users
    public function createMediaTable($companyPrefix, $id)
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

    // Method to create the file table with foreign key for company_users
    public function createFileTable($companyPrefix, $id)
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

    private function generateRolesModel($companyPrefix, $id)
    {
        // Create the roles model name based on company prefix
        $modelName = ucfirst($companyPrefix) . 'Role';
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
                "    public function department() {\n        return \$this->belongsTo(\\App\\Models\\{$companyPrefix}Department::class);\n    }\n\n" .
                "    public function company() {\n        return \$this->belongsTo(\\App\\Models\\Company::class);\n    }\n\n" .
                "    public function user() {\n        return \$this->belongsTo(\\App\\Models\\CompanyUser::class, 'uid');\n    }",
                $modelContent
            );

            // Save the updated roles model content
            File::put($modelPath, $modelContent);
        }
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

}
