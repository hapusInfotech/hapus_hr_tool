<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HkEmployeeEducationalDetail extends Model
{
    use HasFactory;

    protected $table = '1_hk_employee_educational_details';

    protected $fillable = ['emp_id', 'institute_name', 'degree_diploma', 'specialization', 'date_of_completion', 'uid'];

    public function employee() {
        return $this->belongsTo(\App\Models\Company\HkEmployee::class, 'emp_id', 'emp_id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'uid');
    }
}
