<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HkEmployeePersonalDetail extends Model
{
    use HasFactory;

    protected $table = '1_hk_employee_personal_details';

    protected $fillable = ['emp_id', 'date_of_birth', 'marital_status', 'blood_group', 'present_address', 'permanent_address', 'personal_mobile_no', 'work_mobile_no', 'uid'];

    public function employee() {
        return $this->belongsTo(\App\Models\Company\HkEmployee::class, 'emp_id', 'emp_id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'uid');
    }
}
