<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class EmployeeService
{
    protected $companyId;
    protected $companyPrefix;

    public function setCompanyDetails($companyId, $companyPrefix)
    {
        $this->companyId = $companyId;
        $this->companyPrefix = $companyPrefix;
    }

    public function createEmployee($data, $empUid, $accountCreatorUid)
    {
        $tableName = $this->companyId . '_' . $this->companyPrefix . '_employees';
        $rolesTable = $this->companyId . '_' . $this->companyPrefix . '_roles';

        // Fetch the role name from the roles table based on emp_role
        $role = DB::table($rolesTable)
            ->where('id', $data['emp_role'])
            ->value('roles'); // Assuming 'roles' is the column for the role name

        // Insert the employee data into the employee table
        return DB::table($tableName)->insertGetId([
            'emp_id' => $data['emp_id'],
            'emp_name' => $data['emp_name'],
            'emp_email' => $data['emp_email'],
            'emp_username' => $data['emp_username'],
            'emp_gender' => $data['emp_gender'],
            'emp_profile_id' => null,
            'emp_role' => $role,
            'emp_role_id' => $data['emp_role'],
            'emp_uid' => $empUid, // Use the passed CompanyUser ID as emp_uid
            'account_creator_uid' => $accountCreatorUid, // Use the current user's ID as account_creator_uid
            'active_status' => '1',
            'company_id' => $this->companyId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
