<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // These are the fields that can be mass-assigned
    protected $fillable = ['department', 'weight', 'company_id', 'uid'];

    // Set the table dynamically
    public function setTableName($companyId, $companyPrefix)
    {
        $this->setTable($companyId . '_' . $companyPrefix . '_departments');
        return $this;
    }

    // Define the relationship with the company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Define the relationship with the user (uid)
    public function user()
    {
        return $this->belongsTo(CompanyUser::class, 'uid');
    }
}
