<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function super_admin_index()
    {
        // Fetch data from subscriptions and subscription_details using join
        $subscriptions = DB::table('subscriptions')
            ->join('subscription_details', 'subscriptions.id', '=', 'subscription_details.subscription_id')
            ->leftJoin('subscription_payments', 'subscriptions.id', '=', 'subscription_payments.subscription_id')
            ->select(
                'subscriptions.id',
                'subscriptions.type',
                'subscriptions.uid',
                'subscriptions.status',
                'subscriptions.plan',
                'subscriptions.created_at',
                'subscriptions.updated_at',
                'subscription_details.name',
                'subscription_details.phone',
                'subscription_details.email',
                'subscription_details.address',
                'subscription_details.country',
                'subscription_details.payment_status',
                'subscription_payments.payment_type',
                'subscription_payments.transaction_id',
                'subscription_payments.status as payment_status',
                'subscription_payments.amount_id',
                'subscription_payments.payment_gateway'
            )
            ->get();
        $users = DB::table('users')->select('id', 'name', 'email', 'role_name', 'created_at', 'updated_at')->get();
        // Fetch companies with related user, subscription, and role data using eager loading
        $companies = Company::with(['user', 'subscription', 'role'])->get();

        // Pass the data to the view
        return view('admin.home', ['subscriptions' => $subscriptions, 'users' => $users, 'companies' => $companies]);
    }

    public function support_admin_index()
    {
        // You can pass any data to the view if needed
        return view('home');
    }
    public function company_super_admin_index()
    {
        // You can pass any data to the view if needed
        return view('home');

    }
    public function company_admin_index()
    {
        // You can pass any data to the view if needed
        return view('home');

    }

    public function showCompanyTables($id)
    {
        // Find the company by ID
        $company = Company::findOrFail($id);

        // You can fetch other data related to the company as needed here
        // The table prefix format
        $prefix = "{$company->id}_{$company->company_prefix}_"; // e.g., 123_companyprefix_

        // Query the information schema to get tables with the given prefix
        $tables = \DB::select("SELECT table_name
                           FROM information_schema.tables
                           WHERE table_schema = ?
                           AND table_name LIKE ?", [env('DB_DATABASE'), $prefix . '%']);

        // Return a view and pass the company data to it
        return view('admin.company.tables', compact('company', 'tables'));
    }

    public function deleteCompanyTable($table)
    {
        try {
            // Sanitize table name to avoid potential SQL injection
            $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table);

            // Drop foreign key constraints if any
            $this->dropForeignKeys($table);

            // Drop the table
            \DB::statement("DROP TABLE $table");


            // Redirect back with success message
            return redirect()->back()->with('success', "Table '$table' has been deleted successfully.");
        } catch (\Exception $e) {
            // Handle error (if table doesn't exist or some other error)
            return redirect()->back()->with('error', "Error deleting table '$table': " . $e->getMessage());
        }
    }

    private function dropForeignKeys($table)
    {
        // Drop foreign keys within the table
        $foreignKeys = \DB::select("
        SELECT CONSTRAINT_NAME
        FROM information_schema.KEY_COLUMN_USAGE
        WHERE TABLE_NAME = ? AND CONSTRAINT_NAME != 'PRIMARY'
        AND REFERENCED_TABLE_NAME IS NOT NULL", [$table]);

        // Loop through and drop each foreign key constraint
        foreach ($foreignKeys as $foreignKey) {
            \DB::statement("ALTER TABLE $table DROP FOREIGN KEY {$foreignKey->CONSTRAINT_NAME}");
        }

        // Drop foreign keys in other tables that reference this table
        $referencingForeignKeys = \DB::select("
        SELECT TABLE_NAME, CONSTRAINT_NAME
        FROM information_schema.KEY_COLUMN_USAGE
        WHERE REFERENCED_TABLE_NAME = ?
        AND CONSTRAINT_NAME != 'PRIMARY'", [$table]);

        // Loop through and drop foreign keys in referencing tables
        foreach ($referencingForeignKeys as $foreignKey) {
            \DB::statement("ALTER TABLE {$foreignKey->TABLE_NAME} DROP FOREIGN KEY {$foreignKey->CONSTRAINT_NAME}");
        }
    }

}
