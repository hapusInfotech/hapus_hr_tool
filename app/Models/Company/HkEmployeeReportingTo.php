<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HkEmployeeReportingTo extends Model
{
    use HasFactory;

    protected $table = '1_hk_employee_reporting_to';

    protected $fillable = ['emp_id', 'reporting_to_id', 'uid'];

    public function employee() {
        return $this->belongsTo(\App\Models\Company\HkEmployee::class, 'emp_id', 'emp_id');
    }

    public function reportingTo() {
        return $this->belongsTo(\App\Models\Company\HkEmployee::class, 'reporting_to_id', 'emp_id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'uid');
    }
}
