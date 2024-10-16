<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestMedia extends Model
{
    use HasFactory;

    protected $table = '2_test_media';

    protected $fillable = ['media_name', 'media_type', 'media_path', 'uploaded_by'];

    public function user() {
        return $this->belongsTo(\App\Models\CompanyUser::class, 'uid');
    }
}
