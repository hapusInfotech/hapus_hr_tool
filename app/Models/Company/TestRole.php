<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestRole extends Model
{
    use HasFactory;

    protected $table = '2_test_roles';

    protected $fillable = ['roles', 'weight', 'department_id', 'company_id', 'uid'];

    public function department() {
        return $this->belongsTo(\App\Models\testDepartment::class);
    }

    public function company() {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'uid');
    }
}
