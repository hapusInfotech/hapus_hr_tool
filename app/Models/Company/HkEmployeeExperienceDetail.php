<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HkEmployeeExperienceDetail extends Model
{
    use HasFactory;

    protected $table = '1_hk_employee_experience_details';

    protected $fillable = ['emp_id', 'organization_name', 'designation', 'date_of_joining', 'date_of_releaving', 'uid'];

    public function employee() {
        return $this->belongsTo(\App\Models\Company\HkEmployee::class, 'emp_id', 'emp_id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'uid');
    }
}
