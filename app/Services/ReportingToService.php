<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ReportingToService
{
    protected $companyId;
    protected $companyPrefix;

    public function setCompanyDetails($companyId, $companyPrefix)
    {
        $this->companyId = $companyId;
        $this->companyPrefix = $companyPrefix;
    }

    public function createReportingTo($data, $uid)
    {
        $tableName = $this->companyId . '_' . $this->companyPrefix . '_employee_reporting_to';
        return DB::table($tableName)->insert([
            'emp_id' => $data['emp_id'],
            'reporting_to_id' => $data['reporting_to_id'],
            'uid' => $uid,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
