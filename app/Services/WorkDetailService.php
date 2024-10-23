<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class WorkDetailService
{
    protected $companyId;
    protected $companyPrefix;

    public function setCompanyDetails($companyId, $companyPrefix)
    {
        $this->companyId = $companyId;
        $this->companyPrefix = $companyPrefix;
    }

    public function createWorkDetail($data, $uid)
    {
        $tableName = $this->companyId . '_' . $this->companyPrefix . '_employee_work_details';
        return DB::table($tableName)->insert([
            'emp_id' => $data['emp_id'],
            'department_id' => $data['department_id'],
            'shift_id' => $data['shift_id'],
            'location' => $data['location'],
            'designation' => $data['designation'],
            'date_of_joining' => $data['date_of_joining'],
            'uid' => $uid,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
