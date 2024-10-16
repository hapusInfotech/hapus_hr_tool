<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // Define the table name (if different from default 'companies')
    protected $table = 'company';

    // Fillable fields for mass assignment
    protected $fillable = [
        'company_name',
        'company_prefix',
        'company_type',
        'company_email',
        'company_phone_number',
        'company_address',
        'uid', // Foreign Key for users table
        'subscription_id', // Foreign Key for subscriptions table
        'roles_id', // Foreign Key for roles table
        'email_status',
        'company_status',
    ];

    // Relationships with foreign key references
    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'Sid');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
