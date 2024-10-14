<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'name',
        'guard_name',
    ];

    // Optionally define timestamps if you need them
    public $timestamps = true;
}
