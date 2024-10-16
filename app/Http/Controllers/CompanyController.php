<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;

// Assuming you have a Company model

class CompanyController extends Controller
{
    public function index()
    {
        // Fetch all companies with pagination or without, depending on your needs
        $companies = Company::all(); // Or you can use ->paginate(10) for pagination

        // Return the view with the companies data
        return view('company.company_list', compact('companies'));
    }

    // Display the form
    public function create()
    {
        return view('company.company_create');
    }

    // Store the form data
    public function store(Request $request)
    {
        // Store the company data in the database
        Company::create([
            'company_name' => $request->input('company_name'),
            'company_prefix' => $request->input('company_prefix'),
            'company_type' => $request->input('company_type'),
            'company_email' => $request->input('company_email'),
            'company_phone_number' => $request->input('company_phone_number'),
            'company_address' => $this->formatAddress($request), // Store the full address as a single field in the specified format
            'uid' => auth()->id(), // Assuming you're storing the currently authenticated user's ID
            'subscription_id' => 1, // Set this value as needed
            'roles_id' => 1, // Default role_id if needed
            'email_status' => 0, // Default to 0
            'company_status' => 1, // Active by default
        ]);

        // // Dynamically create a table based on the company's prefix or name
        // $tableName = $request->company_prefix . '_employees'; // Example table name
        // if (!Schema::hasTable($tableName)) {
        //     Schema::create($tableName, function (Blueprint $table) {
        //         $table->id();
        //         $table->string('name'); // You can customize the columns as needed
        //         $table->string('description')->nullable();
        //         $table->timestamps();
        //     });
        // }

        // // Optionally, generate a model for the newly created table
        // Artisan::call('make:model', ['name' => ucfirst($request->company_prefix)]);

        // Redirect to the form with a success message
        return redirect()->route('company.company_create')->with('success', 'Company created successfully!');
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

}
