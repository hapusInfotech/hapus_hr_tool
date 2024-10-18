<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HkNotice extends Model
{
    use HasFactory;

    protected $table = '1_hk_notice';

    protected $fillable = ['notice_type', 'notice_days', 'uid'];

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'uid');
    }
}
