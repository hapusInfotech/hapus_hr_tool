<?php

namespace App\Http\Controllers;

use App\Services\DepartmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    protected $companyId;
    protected $companyPrefix;
    protected $departmentService;

    // Inject the service in the constructor using dependency injection
    public function __construct(DepartmentService $departmentService)
    {
        // Middleware to ensure the user is authenticated
        $this->middleware(function ($request, $next) use ($departmentService) {
            $user = Auth::guard('company_login')->user(); // Use the custom guard

            if ($user) {
                $this->companyId = $user->company_id;
                $this->companyPrefix = $user->company->company_prefix;

                // Set company details in the service
                $departmentService->setCompanyDetails($this->companyId, $this->companyPrefix);

                // Assign the service to the class property
                $this->departmentService = $departmentService;
            } else {
                // Handle the case where the user is not authenticated
                throw new \Exception("User not authenticated.");
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all departments using the department service
        $departments = $this->departmentService->getAllDepartments();
        return view('company_users.admin.departments.index', compact('departments'))
            ->with('companyId', $this->companyId)
            ->with('companyPrefix', $this->companyPrefix);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company_users.admin.departments.create')
            ->with('companyId', $this->companyId)
            ->with('companyPrefix', $this->companyPrefix);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Use the service to create a new department
        $this->departmentService->createDepartment($request->all());
        return redirect()->route('departments.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptedId)
    {
        // Use the service to get the department for editing
        $department = $this->departmentService->getDepartmentById($encryptedId);
        return view('company_users.admin.departments.edit', compact('department'))
            ->with('companyId', $this->companyId)
            ->with('companyPrefix', $this->companyPrefix);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $encryptedId)
    {
        // Use the service to update the department
        $this->departmentService->updateDepartment($request->all(), $encryptedId);
        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($encryptedId)
    {
        // Use the service to delete the department
        $this->departmentService->deleteDepartment($encryptedId);
        return redirect()->route('departments.index');
    }

}
