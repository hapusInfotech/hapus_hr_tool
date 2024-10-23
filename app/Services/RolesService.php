<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class RolesService
{
    protected $companyId;
    protected $companyPrefix;

    public function setCompanyDetails($companyId, $companyPrefix)
    {
        $this->companyId = $companyId;
        $this->companyPrefix = $companyPrefix;
    }

    // Get roles by department
    public function getRolesByDepartment($departmentId)
    {
        return DB::table($this->getTableName())
            ->where('company_id', $this->companyId)
            ->where('department_id', $departmentId)
            ->orderBy('weight', 'asc')
            ->get();
    }

    // Create a new role
    public function createRole($data)
    {

        return DB::table($this->getTableName())->insert([
            'roles' => $data['roles'],
            'weight' => $data['weight'],
            'department_id' => $data['department_id'], // Use decrypted department_id
            'company_id' => $this->companyId,
            'uid' => auth()->id(),
        ]);
    }

    // Get role by id
    public function getRoleById($roleId)
    {
        return DB::table($this->getTableName())
            ->where('id', $roleId)
            ->first();
    }

    // Update a role
    public function updateRole($data, $roleId)
    {
        $decryptedRoleId = Crypt::decrypt($roleId);

        return DB::table($this->getTableName())
            ->where('id', $decryptedRoleId)
            ->update([
                'roles' => $data['roles'],
                'weight' => $data['weight'],
                'department_id' => $data['department_id'],
                'uid' => auth()->id(),
            ]);
    }

    // Delete a role
    public function deleteRole($roleId)
    {
        return DB::table($this->getTableName())
            ->where('id', $roleId)
            ->delete();
    }

    private function getTableName()
    {
        return $this->companyId . '_' . $this->companyPrefix . '_roles';
    }
}
