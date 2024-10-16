<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Extend Authenticatable for auth
use Illuminate\Notifications\Notifiable;

class CompanyUser extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'company_id', 'email', 'password', 'force_password_change', // Add this field
    ];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Relationship: CompanyUser belongs to a Company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
