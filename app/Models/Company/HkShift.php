<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HkShift extends Model
{
    use HasFactory;

    protected $table = '1_hk_shifts';

    protected $fillable = ['shift_type', 'shift_name', 'shift_start_time', 'shift_end_time', 'shift_liberal_hrs', 'uid'];

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'uid');
    }
}
