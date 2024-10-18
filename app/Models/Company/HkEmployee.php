<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HkEmployee extends Model
{
    use HasFactory;

    protected $table = '1_hk_employees';

    protected $fillable = ['emp_id', 'emp_name', 'emp_email', 'emp_username', 'emp_gender', 'emp_profile_id', 'emp_role', 'emp_role_id', 'emp_uid', 'account_creator_uid', 'active_status', 'company_id'];

    public function company() {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'emp_uid');
    }

    public function accountCreator() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'account_creator_uid');
    }
}
