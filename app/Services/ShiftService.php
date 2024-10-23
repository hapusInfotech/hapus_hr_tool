<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ShiftService
{
    protected $tableName;
    protected $companyId;
    protected $companyPrefix;

    // Set the table name dynamically based on the company ID and prefix
    public function setCompanyDetails($companyId, $companyPrefix)
    {
        $this->companyId = $companyId;
        $this->companyPrefix = $companyPrefix;
        $this->tableName = $companyId . '_' . $companyPrefix . '_shifts';
    }

    // Fetch all shifts
    public function getAllShifts()
    {
        return DB::table($this->tableName)->where('company_id', $this->companyId)->get();
    }

    // Fetch a single shift by ID
    public function getShiftById($id)
    {
        return DB::table($this->tableName)->where('id', $id)->first();
    }

    // Create a new shift
    public function createShift($data)
    {
        $shiftData = [
            'shift_type' => $data['shift_type'],
            'shift_name' => $data['shift_name'],
            'shift_start_time' => $data['shift_start_time'],
            'shift_end_time' => $data['shift_end_time'],
            'company_id' => $this->companyId,
            'uid' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if ($data['shift_type'] === 'Liberal') {
            $shiftData['shift_liberal_hrs'] = $data['shift_liberal_hrs'];
        }

        return DB::table($this->tableName)->insert($shiftData);
    }

    // Update an existing shift
    public function updateShift($id, $data)
    {
        $shiftData = [
            'shift_type' => $data['shift_type'],
            'shift_name' => $data['shift_name'],
            'shift_start_time' => $data['shift_start_time'],
            'shift_end_time' => $data['shift_end_time'],
            'updated_at' => now(),
        ];

        // Only set liberal hours if the shift type is "Liberal"
        if ($data['shift_type'] === 'Liberal') {
            $shiftData['shift_liberal_hrs'] = $data['shift_liberal_hrs'];
        } else {
            // Optionally set liberal hours to null if not "Liberal"
            $shiftData['shift_liberal_hrs'] = 0;
        }

        return DB::table($this->tableName)->where('id', $id)->update($shiftData);
    }

    // Delete a shift by ID
    public function deleteShift($id)
    {
        return DB::table($this->tableName)->where('id', $id)->delete();
    }
}
