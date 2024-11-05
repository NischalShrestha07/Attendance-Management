<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('company.index', compact('companies'));
    }

    public function showCompanyDetails($companyId)
    {
        // Get the company based on the ID
        $company = Company::findOrFail($companyId);

        // Get users belonging to that company
        $users = User::where('company_id', $companyId)->get();

        // Pass the company and users to the view
        return view('company.details', compact('company', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addNewCompany(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string'
        ]);
        $user = new Company();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->save();
        return redirect()->route('company.index')->with('success', 'Company Added Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
