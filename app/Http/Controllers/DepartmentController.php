<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DepartmentController extends Controller
{
    protected $companyId;
    protected $companyPrefix;

    public function __construct()
    {
        // Ensure the user is authenticated
        $this->middleware(function ($request, $next) {
            $user = Auth::guard('company_login')->user(); // Use the custom guard

            $this->companyId = $user->company_id;
            $this->companyPrefix = $user->company->company_prefix; // Assuming `prefix` exists in the company model

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyId = $this->companyId;
        $companyPrefix = $this->companyPrefix;
        // Retrieve all departments for the current company
        $departments = (new Department)->setTableName($this->companyId, $this->companyPrefix)->get();
        return view('company_users.admin.departments.index', compact('departments', 'companyId', 'companyPrefix'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $companyId = $this->companyId;
        $companyPrefix = $this->companyPrefix;
        return view('company_users.admin.departments.create', compact('companyId', 'companyPrefix'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Get the authenticated user's ID
        $userId = Auth::guard('company_login')->id(); // Retrieve the authenticated user's ID

        // Directly insert the department without validation
        (new Department)
            ->setTableName($this->companyId, $this->companyPrefix)
            ->create([
                'department' => $request->department, // Assuming this is being sent from the form
                'weight' => $request->weight, // Assuming this is being sent from the form
                'company_id' => $this->companyId, // Using the company ID from the authenticated user
                'uid' => $userId, // Set the authenticated user's ID as uid
            ]);

        return redirect()->route('departments.index', [
            'company_id' => $this->companyId,
            'company_prefix' => $this->companyPrefix,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $encryptedId)
    {
        // Decrypt the ID
        $id = Crypt::decrypt($encryptedId);

        $companyId = $this->companyId;
        $companyPrefix = $this->companyPrefix;

        // Retrieve a specific department
        $department = (new Department)->setTableName($this->companyId, $this->companyPrefix)->findOrFail($id);
        return view('company_users.admin.departments.show', compact('department', 'companyId', 'companyPrefix'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encryptedId)
    {
        $companyId = $this->companyId;
        $companyPrefix = $this->companyPrefix;

        // Decrypt the ID
        $id = Crypt::decrypt($encryptedId);

        // Find the department to edit
        $department = (new Department)->setTableName($this->companyId, $this->companyPrefix)->findOrFail($id);
        return view('company_users.admin.departments.edit', compact('department', 'companyId', 'companyPrefix'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $encryptedId)
    {
        // Decrypt the ID
        $id = Crypt::decrypt($encryptedId);

        // Get the authenticated user's ID
        $userId = Auth::guard('company_login')->id(); // Retrieve the authenticated user's ID

        // Find and update the department
        (new Department)
            ->setTableName($this->companyId, $this->companyPrefix)
            ->where('id', $id)
            ->update([
                'department' => $request->department, // Assuming this is being sent from the form
                'weight' => $request->weight, // Assuming this is being sent from the form
                'uid' => $userId, // Set the authenticated user's ID as uid
            ]);

        return redirect()->route('departments.index', ['company_id' => $this->companyId, 'company_prefix' => $this->companyPrefix]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $encryptedId)
    {
        // Decrypt the ID
        $id = Crypt::decrypt($encryptedId);

        // Find and delete the department
        (new Department)
            ->setTableName($this->companyId, $this->companyPrefix)
            ->where('id', $id)
            ->delete();

        return redirect()->route('departments.index', ['company_id' => $this->companyId, 'company_prefix' => $this->companyPrefix]);
    }
}
