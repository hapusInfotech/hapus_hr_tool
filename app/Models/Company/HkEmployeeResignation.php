<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HkEmployeeResignation extends Model
{
    use HasFactory;

    protected $table = '1_hk_employee_resignation';

    protected $fillable = ['notice_id', 'emp_id', 'start_date', 'end_date', 'reason_for_releiving', 'uid'];

    public function notice() {
        return $this->belongsTo(\App\Models\Company\HkNotice::class, 'notice_id');
    }

    public function employee() {
        return $this->belongsTo(\App\Models\Company\HkEmployee::class, 'emp_id', 'emp_id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'uid');
    }
}
