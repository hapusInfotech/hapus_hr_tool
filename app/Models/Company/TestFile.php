<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestFile extends Model
{
    use HasFactory;

    protected $table = '2_test_files';

    protected $fillable = ['file_name', 'file_type', 'file_path', 'uploaded_by'];

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'uid');
    }
}
