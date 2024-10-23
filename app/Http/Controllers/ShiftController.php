<?php

namespace App\Http\Controllers;

use App\Services\ShiftService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    protected $shiftService;
    protected $companyId;
    protected $companyPrefix;

    public function __construct(ShiftService $shiftService)
    {
        $this->middleware(function ($request, $next) use ($shiftService) {
            $user = Auth::guard('company_login')->user();
            if ($user) {
                $this->companyId = $user->company_id;
                $this->companyPrefix = $user->company->company_prefix;

                // Set company details in the service
                $shiftService->setCompanyDetails($this->companyId, $this->companyPrefix);
                $this->shiftService = $shiftService;
            } else {
                throw new \Exception("User not authenticated.");
            }
            return $next($request);
        });
    }

    // Index method: Show all shifts
    public function index()
    {
        $shifts = $this->shiftService->getAllShifts();
        return view('company_users.admin.shifts.index', compact('shifts'))
            ->with('companyId', $this->companyId)
            ->with('companyPrefix', $this->companyPrefix);
    }

    // Create method: Show form for creating a new shift
    public function create()
    {
        return view('company_users.admin.shifts.create')
            ->with('companyId', $this->companyId)
            ->with('companyPrefix', $this->companyPrefix);
    }

    // Store method: Store a new shift
    public function store(Request $request)
    {

        $this->shiftService->createShift($request->all());
        return redirect()->route('shifts.index');
    }

    // Edit method: Show form for editing an existing shift
    public function edit($encryptedId)
    {
        // Decrypt the ID
        $id = decrypt($encryptedId);
        $shift = $this->shiftService->getShiftById($id);
        return view('company_users.admin.shifts.edit', compact('shift'))
            ->with('companyId', $this->companyId)
            ->with('companyPrefix', $this->companyPrefix);
    }

    // Update method: Update the shift in the database
    public function update(Request $request, $encryptedId)
    {
        // Decrypt the ID
        $id = decrypt($encryptedId);

        $this->shiftService->updateShift($id, $request->all());
        return redirect()->route('shifts.index');
    }

    // Destroy method: Delete the shift from the database
    public function destroy($encryptedId)
    {
        // Decrypt the ID
        $id = decrypt($encryptedId);
        $this->shiftService->deleteShift($id);
        return redirect()->route('shifts.index');
    }
}
