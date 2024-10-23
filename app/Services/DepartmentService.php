<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class DepartmentService
{
    protected $companyId;
    protected $companyPrefix;

    // This method will be used to set company details dynamically
    public function setCompanyDetails($companyId, $companyPrefix)
    {
        $this->companyId = $companyId;
        $this->companyPrefix = $companyPrefix;
    }

    public function getAllDepartments()
    {
        // Use query builder to fetch all departments for the company
        return DB::table($this->getTableName())
            ->where('company_id', $this->companyId)
            ->orderBy('weight', 'asc') // Sort by 'weight' in ascending order
            ->get();
    }

    public function createDepartment($data)
    {
        // Use query builder to insert a new department
        return DB::table($this->getTableName())->insert([
            'department' => $data['department'],
            'weight' => $data['weight'],
            'company_id' => $this->companyId,
            'uid' => auth()->id(), // Assuming the user is still authenticated
        ]);
    }

    public function getDepartmentById($encryptedId)
    {
        // Decrypt ID and fetch the department using the query builder
        $id = Crypt::decrypt($encryptedId);
        return DB::table($this->getTableName())
            ->where('id', $id)
            ->first();
    }

    public function updateDepartment($data, $encryptedId)
    {
        // Decrypt ID and use the query builder to update the department
        $id = Crypt::decrypt($encryptedId);
        return DB::table($this->getTableName())
            ->where('id', $id)
            ->update([
                'department' => $data['department'],
                'weight' => $data['weight'],
                'uid' => auth()->id(),
            ]);
    }

    public function deleteDepartment($encryptedId)
    {
        // Decrypt ID and use the query builder to delete the department
        $id = Crypt::decrypt($encryptedId);
        return DB::table($this->getTableName())
            ->where('id', $id)
            ->delete();
    }

    private function getTableName()
    {
        // Generate the dynamic table name
        return $this->companyId . '_' . $this->companyPrefix . '_departments';
    }
}
