<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestDepartment extends Model
{
    use HasFactory;

    protected $table = '2_test_departments';

    protected $fillable = ['department', 'weight', 'company_id', 'uid'];

    public function company() {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'uid');
    }
}
