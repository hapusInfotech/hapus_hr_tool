<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HkFile extends Model
{
    use HasFactory;

    protected $table = '1_hk_files';

    protected $fillable = ['file_name', 'file_type', 'file_path', 'uploaded_by'];

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'uid');
    }
}
