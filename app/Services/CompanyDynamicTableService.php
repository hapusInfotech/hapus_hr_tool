<?php

namespace App\Services;

use Illuminate\Database\Schema\Blueprint;
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
        $this->createLayoutTable($companyPrefix, $companyId);
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

    }

    private function createRolesTable($companyPrefix, $id)
    {
        $tableName = $id . '_' . $companyPrefix . '_roles'; // Custom table name for roles
        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($companyPrefix, $id) {
                $table->id();
                $table->string('roles');
                $table->integer('weight')->default(0);
                $table->unsignedBigInteger('department_id')->nullable(); // Foreign key for the department
                $table->unsignedBigInteger('company_id'); // Foreign key for the company
                $table->unsignedBigInteger('uid'); // Foreign key for the company user
                $table->timestamps();

                // Define foreign keys
                $table->foreign('department_id')->references('id')->on("{$id}_{$companyPrefix}_departments")->onDelete('cascade');
                $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
                $table->foreign('uid')->references('id')->on('company_users')->onDelete('cascade');
            });
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
                // Liberal hours (allowed flexible time), changed to decimal to support fractional hours
                $table->decimal('shift_liberal_hrs', 10, 2)->default(0.00)->nullable(); // Updated to decimal type
                $table->unsignedBigInteger('company_id'); // Foreign key for the company
                $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');

                // Foreign key referencing company_users table's id
                $table->unsignedBigInteger('uid');
                $table->foreign('uid')
                    ->references('id')
                    ->on('company_users')
                    ->onDelete('cascade');

                $table->timestamps(); // Automatically adds created_at and updated_at fields
            });
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
    }

    private function createLayoutTable($companyPrefix, $companyId)
    {
        // Table name dynamically based on the company prefix and ID
        $tableName = $companyId . '_' . $companyPrefix . '_layout';

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($companyPrefix, $companyId) {
                $table->id(); // Auto-incrementing ID field

                // Foreign key referencing the employees table's emp_id
                $table->string('emp_id');
                $table->foreign('emp_id')
                    ->references('emp_id')
                    ->on("{$companyId}_{$companyPrefix}_employees")
                    ->onDelete('cascade');

                // Sidebar and Topbar layout fields
                $table->string('sidebar')->nullable(); // Sidebar layout details (could be a string or JSON based on your needs)
                $table->string('topbar')->nullable(); // Topbar layout details (could be a string or JSON based on your needs)

                $table->timestamps(); // Automatically adds created_at and updated_at fields
            });
        }
    }

}
