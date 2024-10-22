<?php

namespace App\Imports;

use App\Models\CompanyUser;
use Maatwebsite\Excel\Concerns\ToModel;

class CompanyUsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CompanyUser([
            //
        ]);
    }
}
