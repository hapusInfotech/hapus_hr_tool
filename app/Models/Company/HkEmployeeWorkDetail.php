<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HkEmployeeWorkDetail extends Model
{
    use HasFactory;

    protected $table = '1_hk_employee_work_details';

    protected $fillable = ['emp_id', 'department_id', 'shift_id', 'location', 'designation', 'date_of_joining', 'uid'];

    public function employee() {
        return $this->belongsTo(\App\Models\Company\HkEmployee::class, 'emp_id', 'emp_id');
    }

    public function department() {
        return $this->belongsTo(\App\Models\Company\HkDepartment::class, 'department_id');
    }

    public function shift() {
        return $this->belongsTo(\App\Models\Company\HkShift::class, 'shift_id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'uid');
    }
}
