<?php

namespace App\Http\Controllers;

use App\Services\RolesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class RolesController extends Controller
{
    protected $rolesService;
    protected $companyId;
    protected $companyPrefix;

    public function __construct(RolesService $rolesService)
    {
        $this->middleware(function ($request, $next) use ($rolesService) {
            // Retrieve the authenticated user's details
            $user = Auth::guard('company_login')->user(); // Custom guard for company_login

            if ($user) {
                // Set the companyId and companyPrefix from the authenticated user
                $this->companyId = $user->company_id;
                $this->companyPrefix = $user->company->company_prefix;

                // Set company details in the service
                $rolesService->setCompanyDetails($this->companyId, $this->companyPrefix);

                // Assign service to controller property
                $this->rolesService = $rolesService;
            } else {
                // Handle unauthenticated user case
                throw new \Exception("User not authenticated.");
            }

            return $next($request);
        });
    }

    // Index method: Show roles by department
    public function index($department_id)
    {
        $departmentId = Crypt::decrypt($department_id); // Decrypt the department_id
        $roles = $this->rolesService->getRolesByDepartment($departmentId);

        // Pass companyId, companyPrefix, and department_id to the view
        return view('company_users.admin.roles.index', compact('roles', 'department_id'))
            ->with('companyId', $this->companyId)
            ->with('companyPrefix', $this->companyPrefix);
    }

    // Create method: Show form for creating a role in a specific department
    public function create($department_id)
    {
        $department_id = Crypt::decrypt($department_id);

        // Pass companyId, companyPrefix, and department_id to the view
        return view('company_users.admin.roles.create', compact('department_id'))
            ->with('companyId', $this->companyId)
            ->with('companyPrefix', $this->companyPrefix);
    }

    public function store(Request $request)
    {
        $data = $request->all();


        // Proceed with creating the role if decryption was successful
        $this->rolesService->createRole($data);

        // Redirect to roles.index with encrypted department_id
        return redirect()->route('roles.index', ['department_id' => Crypt::encrypt($request->department_id)]);
    }

    // Edit method: Show form to edit a specific role
    public function edit($role_id)
    {
        $roleId = Crypt::decrypt($role_id); // Decrypt the role_id
        $role = $this->rolesService->getRoleById($roleId);

        // Pass companyId, companyPrefix, and role_id to the view
        return view('company_users.admin.roles.edit', compact('role', 'role_id'))
            ->with('companyId', $this->companyId)
            ->with('companyPrefix', $this->companyPrefix);
    }

    // Update method: Update the role in the database
    public function update(Request $request, $role_id)
    {
        $roleId = Crypt::decrypt($role_id); // Decrypt the role_id
        $data = $request->all();
        $this->rolesService->updateRole($data, $roleId);

        // Redirect to roles.index with encrypted department_id
        return redirect()->route('roles.index', ['department_id' => Crypt::encrypt($request->department_id)]);
    }

    // Destroy method: Delete the role from the database
    public function destroy($role_id)
    {
        $roleId = Crypt::decrypt($role_id); // Decrypt the role_id
        $this->rolesService->deleteRole($roleId);

        return redirect()->back();
    }
}
