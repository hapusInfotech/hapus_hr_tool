<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class PersonalDetailService
{
    protected $companyId;
    protected $companyPrefix;

    public function setCompanyDetails($companyId, $companyPrefix)
    {
        $this->companyId = $companyId;
        $this->companyPrefix = $companyPrefix;
    }

    public function createPersonalDetail($data, $uid)
    {
        $tableName = $this->companyId . '_' . $this->companyPrefix . '_employee_personal_details';
        // Insert into the personal details table
        return DB::table($tableName)->insert([
            'emp_id' => $data['emp_id'],
            'date_of_birth' => $data['date_of_birth'] ?? null, // Insert the value or null
            'marital_status' => $data['marital_status'] ?? null,
            'blood_group' => $data['blood_group'] ?? null,
            'present_address' => $data['present_address'] ?? null,
            'permanent_address' => $data['permanent_address'] ?? null,
            'personal_mobile_no' => $data['personal_mobile_no'] ?? null,
            'work_mobile_no' => $data['work_mobile_no'] ?? null,
            'uid' => $uid, // Use the provided uid
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
