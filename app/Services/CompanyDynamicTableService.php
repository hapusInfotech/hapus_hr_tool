<?php
namespace App\Services;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class CompanyDynamicTableService
{
    public function createEmployeeTable($request)
    {
        $tableName = $request->company_name . '_employees'; // Custom table name
        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->string('name'); // Customizable columns
                $table->string('description')->nullable();
                $table->timestamps();
            });
        }

        // Generate a model using Artisan command
        $modelName = ucfirst($request->company_name) . 'Employee';
        Artisan::call('make:model', ['name' => $modelName]);

        // Define the fillable fields
        $fillableFields = "['name', 'description']";

        // Path to the generated model
        $modelPath = app_path("Models/{$modelName}.php");

        // Add the table and fillable properties to the generated model
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Inject the table name and fillable fields
            $modelContent = str_replace(
                'use HasFactory;',
                "use HasFactory;\n\n    protected \$table = '{$tableName}';\n\n    protected \$fillable = {$fillableFields};",
                $modelContent
            );

            // Save the updated model content
            File::put($modelPath, $modelContent);
        }

        return true;
    }
}
