<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyUser;
use App\Services\CompanyDynamicTableService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// Assuming you have a Company model

class CompanyController extends Controller
{
    protected $companyDynamicTableService;
    public function __construct(CompanyDynamicTableService $companyDynamicTableService)
    {
        $this->companyDynamicTableService = $companyDynamicTableService;
    }
    public function index()
    {
        // Fetch all companies with pagination or without, depending on your needs
        $companies = Company::all(); // Or you can use ->paginate(10) for pagination

        // Return the view with the companies data
        return view('company.company_list', compact('companies'));
    }

    // Display the form
    public function create(Request $request)
    {
        $n_sid = $request->input('sid');
        if (!empty($n_sid)) {
            $sid = $n_sid;
        } else {
            $sid = null;
            return redirect()->route('login');
        }
// dd(auth()->user()->id);
        return view('company.company_create', compact('sid'));
    }

    // Store the form data
    public function store(Request $request)
    {
        // Store the company data in the database
        $sid = $request->input('sid');

        $company = Company::create([
            'company_name' => $request->input('company_name'),
            'company_prefix' => $request->input('company_prefix'),
            'company_type' => $request->input('company_type'),
            'company_email' => $request->input('company_email'),
            'company_phone_number' => $request->input('company_phone_number'),
            'company_address' => $this->formatAddress($request),
            'uid' => auth()->id(), // Assuming you're storing the currently authenticated user's ID
            'subscription_id' => $sid, // Set this value as needed
            'roles_id' => 1, // Default role_id if needed
            'email_status' => 0, // Default to 0
            'company_status' => 1, // Active by default
        ]);

        $this->companyDynamicTableService->createCompanyTables($request->company_prefix, $company->id);

        // Generate a strong random password
        $generatedPassword = Str::random(12); // You can make this more complex if required

        // Add a user to the company_users table with the generated password
        $companyUser = CompanyUser::create([
            'name' => $request->input('company_name'), // Name for the company user (you can adjust this)
            'email' => $request->input('company_email'),
            'password' => Hash::make($generatedPassword),
            'company_id' => $company->id,
            'force_password_change' => true, // This flag will force the user to change password on first login
        ]);

        // Insert into the roles table
        $rolesTableName = "{$company->id}_{$request->company_prefix}_roles"; // Dynamically created table name
        // Insert and get the role ID
        $roleId = \DB::table($rolesTableName)->insertGetId([
            'roles' => 'Administrator',
            'weight' => -1,
            'department_id' => null, // Assuming you have a departments table or you can set a value if needed
            'company_id' => $company->id,
            'uid' => $companyUser->id, // The user who created this role
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert into the employees table
        $employeesTableName = "{$company->id}_{$request->company_prefix}_employees"; // Dynamically created table name
        \DB::table($employeesTableName)->insert([
            'emp_id' => "Administrator", // Unique employee ID, you can use UUID or some other logic
            'emp_name' => $company->company_name,
            'emp_email' => $company->company_email,
            'emp_username' => $company->company_name, // Using company name as the username, adjust as needed
            'emp_gender' => 2, // Assuming 2 means 'Other', adjust as per your requirements
            'emp_profile_id' => null, // Assuming there's no profile picture initially
            'emp_role' => 'Administrator', // Role of the employee
            'emp_role_id' => $roleId, // Assuming 1 is the role ID for 'Administrator'
            'emp_uid' => $companyUser->id, // The user ID of the company admin
            'account_creator_uid' => $companyUser->id, // The user who created the company
            'active_status' => 1, // Active status
            'company_id' => $company->id, // The company ID
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Define the dynamically generated layout table name
        $layoutTableName = "{$company->id}_{$request->company_prefix}_layout";

        // Insert the layout information (Administrator, blue, white)
        \DB::table($layoutTableName)->insert([
            'emp_id' => "Administrator", // The user ID of the company admin
            'sidebar' => 'white', // Assuming 'white' is the sidebar color
            'topbar' => 'blue', // Assuming 'blue' is the topbar color
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect to the thank you page with the relevant data
        return redirect()->route('company.thankyou', [
            'email' => $companyUser->email,
            'password' => $generatedPassword,
        ]);

    }

    public function edit($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId); // Decrypt the ID

        // Find the company by its ID
        $company = Company::findOrFail($id);

        // Split the combined address string into its parts
        $addressParts = explode(', ', $company->company_address);

        // Assuming your address format is exactly like the one in your example:
        $company_address_line_1 = $addressParts[0] ?? '';
        $company_address_line_2 = $addressParts[1] ?? '';
        $city = $addressParts[2] ?? '';

        // Extract the country and country_name
        $countryParts = explode('-', $addressParts[3] ?? '');
        $country = $countryParts[0] ?? '';
        $country_name = $countryParts[1] ?? '';

        // Extract the state and state_name
        $stateParts = explode('-', $addressParts[4] ?? '');
        $state = $stateParts[0] ?? '';
        $state_name = $stateParts[1] ?? '';

        // The pincode should be the last part
        $company_pincode = $addressParts[5] ?? '';

        // Return the view with the company data and the individual address parts
        return view('company.company_edit', compact(
            'company',
            'company_address_line_1',
            'company_address_line_2',
            'city',
            'country',
            'country_name',
            'state',
            'state_name',
            'company_pincode'
        ));
    }

    public function update(Request $request, $id)
    {
        // Find the company by its ID
        $company = Company::findOrFail($id);

        // Update the company details
        $company->update([
            'company_name' => $request->input('company_name'),
            'company_type' => $request->input('company_type'),
            'company_email' => $request->input('company_email'),
            'company_phone_number' => $request->input('company_phone_number'),
            'company_address' => $this->formatAddress($request), // Format address as you defined
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'company_pincode' => $request->input('company_pincode'),
        ]);

        // Redirect with a success message
        return redirect()->route('company.company_edit', $company->id)->with('success', 'Company updated successfully!');
    }

    public function destroy($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId); // Decrypt the ID

        $company = Company::findOrFail($id); // Fetch the company by ID

        // Delete the company
        $company->delete();

        // Redirect to the company list with a success message
        return redirect()->route('company.company_index')->with('success', 'Company deleted successfully!');
    }

// Format address helper method
    private function formatAddress($request)
    {
        return $request->input('company_address_line_1') . ', ' .
        $request->input('company_address_line_2') . ', ' .
        $request->input('city') . ', ' .
        $request->input('country') . '-' . $request->input('country_name') . ', ' .
        $request->input('state') . '-' . $request->input('state_name') . ', ' .
        $request->input('company_pincode');
    }

    public function checkCompanyPrefix(Request $request)
    {
        $exists = Company::where('company_prefix', $request->company_prefix)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function checkCompanyEmail(Request $request)
    {
        $exists = Company::where('company_email', $request->company_email)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function thankyou(Request $request)
    {
        // Retrieve the email and password from the URL query parameters
        $email = $request->input('email');
        $password = $request->input('password');

        // Return the view with the email, password, and login URL
        return view('company.company_thankyou', compact('email', 'password'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Find the company by ID
        $company = Company::find($id);

        if ($company) {
            // Update the company_status field
            $company->company_status = $request->company_status;
            $company->save();

            // Return a success response
            return response()->json(['success' => true, 'message' => 'Company status updated successfully.']);
        }

        // If the company is not found, return an error response
        return response()->json(['success' => false, 'message' => 'Company not found.'], 404);
    }

}
