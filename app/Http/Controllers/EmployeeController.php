<?php

namespace App\Http\Controllers;

use App\Models\CompanyUser;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use App\Services\PersonalDetailService;
use App\Services\ReportingToService;
use App\Services\RolesService;
use App\Services\ShiftService;
use App\Services\WorkDetailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    protected $employeeService;
    protected $workDetailService;
    protected $reportingToService;
    protected $personalDetailService;
    protected $departmentService;
    protected $shiftService;
    protected $roleService;
    protected $companyId;
    protected $companyPrefix;

    public function __construct(
        EmployeeService $employeeService,
        WorkDetailService $workDetailService,
        ReportingToService $reportingToService,
        PersonalDetailService $personalDetailService,
        DepartmentService $departmentService,
        RolesService $roleService,
        ShiftService $shiftService
    ) {
        $this->middleware(function ($request, $next) use (
            $employeeService,
            $workDetailService,
            $reportingToService,
            $personalDetailService,
            $departmentService,
            $roleService,
            $shiftService
        ) {
            // Retrieve the authenticated user's details
            $user = Auth::guard('company_login')->user();

            if ($user) {
                // Set the companyId and companyPrefix from the authenticated user
                $this->companyId = $user->company_id;
                $this->companyPrefix = $user->company->company_prefix;

                // Set company details in each service
                $employeeService->setCompanyDetails($this->companyId, $this->companyPrefix);
                $workDetailService->setCompanyDetails($this->companyId, $this->companyPrefix);
                $reportingToService->setCompanyDetails($this->companyId, $this->companyPrefix);
                $personalDetailService->setCompanyDetails($this->companyId, $this->companyPrefix);
                $departmentService->setCompanyDetails($this->companyId, $this->companyPrefix);
                $roleService->setCompanyDetails($this->companyId, $this->companyPrefix);
                $shiftService->setCompanyDetails($this->companyId, $this->companyPrefix);

                // Assign services to controller properties
                $this->employeeService = $employeeService;
                $this->workDetailService = $workDetailService;
                $this->reportingToService = $reportingToService;
                $this->personalDetailService = $personalDetailService;
                $this->departmentService = $departmentService;
                $this->roleService = $roleService;
                $this->shiftService = $shiftService;
            } else {
                // Handle unauthenticated user case
                throw new \Exception("User not authenticated.");
            }

            return $next($request);
        });
    }
    public function index()
    {

        $companyId = $this->companyId;
        $companyPrefix = $this->companyPrefix;

        // Define table names dynamically based on the company_id and company_prefix
        $employeeTable = $companyId . '_' . $companyPrefix . '_employees';
        $departmentTable = $companyId . '_' . $companyPrefix . '_departments';
        $roleTable = $companyId . '_' . $companyPrefix . '_roles';

        // Fetch employees with department and role relationships
        $employees = \DB::table($employeeTable)
            ->join($roleTable, $employeeTable . '.emp_role_id', '=', $roleTable . '.id') // Join roles using emp_role_id
            ->join($departmentTable, $roleTable . '.department_id', '=', $departmentTable . '.id') // Join departments using role's department_id
            ->select(
                $employeeTable . '.emp_id',
                $employeeTable . '.emp_name',
                $departmentTable . '.department', // Get department from department table
                $roleTable . '.roles', // Get role from roles table
                $employeeTable . '.active_status' // Get active status from employees table
            )
            ->get();

        return view('company_users.admin.employees.index', compact('employees'));
    }

    // Show the multi-step form
    public function showForm()
    {

        // Fetch all shifts from the ShiftService
        $shifts = $this->shiftService->getAllShifts();

        // Pass companyId and companyPrefix to the view
        return view('company_users.admin.employees.multi_step_form')
            ->with('companyId', $this->companyId)
            ->with('companyPrefix', $this->companyPrefix)
            ->with('shifts', $shifts); // Pass shifts to the view
    }

    // Store data for each step
    public function storeStep(Request $request)
    {
        // Generate a random password
        $generatedPassword = Str::random(10);

        // Create the CompanyUser first
        $companyUser = CompanyUser::create([
            'name' => $request->input('emp_name'),
            'company_id' => $this->companyId,
            'email' => $request->input('emp_email'),
            'password' => Hash::make($generatedPassword),
            'force_password_change' => true, // Optionally force password change
        ]);

        // Get the current authenticated user's ID (for account creator)
        $currentUserId = Auth::guard('company_login')->id();

        // Call the EmployeeService to create the employee
        $this->employeeService->createEmployee(
            $request->all(),
            $companyUser->id, // Pass the CompanyUser ID as emp_uid
            $currentUserId // Pass the current authenticated user's ID as account_creator_uid
        );

        // Call the EmployeeService to create the employee
        $this->workDetailService->createWorkDetail(
            $request->all(),
            $currentUserId // Pass the current authenticated user's ID as account_creator_uid
        );

        // Call the EmployeeService to create the employee
        $this->reportingToService->createReportingTo(
            $request->all(),
            $currentUserId // Pass the current authenticated user's ID as account_creator_uid
        );

        // Call the EmployeeService to create the employee
        $this->personalDetailService->createPersonalDetail(
            $request->all(),
            $currentUserId // Pass the current authenticated user's ID as account_creator_uid
        );

        // Redirect or return a response
        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully!')
            ->with('emp_email', $companyUser->email)
            ->with('generated_password', $generatedPassword);
    }

    // Fetch departments for the company using the DepartmentService
    public function getDepartments()
    {
        $departments = $this->departmentService->getAllDepartments();
        return response()->json($departments);
    }

    // Fetch roles for the selected department using the RoleService
    public function getRoles($departmentId)
    {
        $roles = $this->roleService->getRolesByDepartment($departmentId);
        return response()->json($roles);
    }

    public function searchEmployees(Request $request)
    {
        $query = $request->get('query');
        $all = $request->get('all', ''); // Check if 'all' is passed to load all employees

        // Fetch all employees if 'all' is true, otherwise search by query
        if (empty($all)) {

            $employees = \DB::table("{$this->companyId}_{$this->companyPrefix}_employees")->get(['emp_id', 'emp_name']);
        } else {
            if (empty($query)) {
                $employees = [];
            } else {

                $employees = \DB::table("{$this->companyId}_{$this->companyPrefix}_employees")
                    ->where('emp_name', 'LIKE', "%{$query}%")
                    ->orWhere('emp_id', 'LIKE', "%{$query}%")
                    ->get(['emp_id', 'emp_name']);
            }
        }

        return response()->json($employees);
    }

    public function checkAvailability(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');

        switch ($field) {
            case 'emp_id':
                $isAvailable = !\DB::table("{$this->companyId}_{$this->companyPrefix}_employees")
                    ->where('emp_id', $value)
                    ->exists();
                break;

            case 'emp_username':
                $isAvailable = !\DB::table("{$this->companyId}_{$this->companyPrefix}_employees")
                    ->where('emp_username', $value)
                    ->exists();
                break;

            case 'emp_email':
                $isAvailable = !\DB::table("{$this->companyId}_{$this->companyPrefix}_employees")
                    ->where('emp_email', $value)
                    ->exists();
                break;

            default:
                return response()->json(['isAvailable' => false], 400); // Invalid field
        }

        return response()->json(['isAvailable' => $isAvailable]);
    }

    public function updateStatus(Request $request)
    {
        // Get the company_id and company_prefix from the authenticated user
        $companyId = $this->companyId;
        $companyPrefix = $this->companyPrefix;

        // Define the employee table dynamically
        $employeeTable = $companyId . '_' . $companyPrefix . '_employees';

        // Update the status in the employees table
        \DB::table($employeeTable)
            ->where('emp_id', $request->emp_id)
            ->update(['active_status' => $request->status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function show($emp_id)
    {
        $companyId = $this->companyId;
        $companyPrefix = $this->companyPrefix;

        // Define table names
        $employeeTable = $companyId . '_' . $companyPrefix . '_employees';
        $workDetailTable = $companyId . '_' . $companyPrefix . '_employee_work_details';
        $reportingToTable = $companyId . '_' . $companyPrefix . '_employee_reporting_to';
        $educationTable = $companyId . '_' . $companyPrefix . '_employee_educational_details';
        $experienceTable = $companyId . '_' . $companyPrefix . '_employee_experience_details';
        $personalDetailTable = $companyId . '_' . $companyPrefix . '_employee_personal_details';

        // Fetch the main employee details
        $employee = \DB::table($employeeTable)
            ->where('emp_id', $emp_id)
            ->first();

        // Fetch the related details (work, reporting, education, experience, personal)
        $workDetails = \DB::table($workDetailTable)
            ->where('emp_id', $emp_id)
            ->first();

        $reportingTo = \DB::table($reportingToTable)
            ->where('emp_id', $emp_id)
            ->first();

        $educationalDetails = \DB::table($educationTable)
            ->where('emp_id', $emp_id)
            ->get();

        $experienceDetails = \DB::table($experienceTable)
            ->where('emp_id', $emp_id)
            ->get();

        $personalDetails = \DB::table($personalDetailTable)
            ->where('emp_id', $emp_id)
            ->first();


        // Pass the data to the view
        return view('company_users.admin.employees.show', compact('employee', 'workDetails', 'reportingTo', 'educationalDetails', 'experienceDetails', 'personalDetails'));
    }

}
