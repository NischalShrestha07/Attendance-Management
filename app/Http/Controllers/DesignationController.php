<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    public function manageDesignation()
    {

        $departments = Department::all();
        $designations = Designation::all();

        if (Auth::user()->roleName === 'Super Admin') {
            return view('admin.designations.superDe', compact('departments', 'designations'));
        } elseif (Auth::user()->roleName === 'Admin') {
            return view('admin.designations.adminDe', compact('departments', 'designations'));
        }
    }

    public function addNewDesignation(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'department' => 'required|string',
        ]);
        $designation = new Designation();
        $designation->name = $request->input('name');
        $designation->department = $request->input('department');
        $designation->save();

        return redirect()->route('manageDesignation')->with('success', 'Designation has been Added');
    }
    public function UpdateDesignation(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'department' => 'required|string',

        ]);
        $designation = Designation::findOrFail($request->input('id'));
        $designation->name = $request->input('name');
        $designation->department = $request->input('department');
        $designation->save();

        return redirect()->route('manageDesignation')->with('success', 'Designation Updated Successfully.');
    }

    public function destroy($id)
    {
        $designation = Designation::find($id);
        $designation->delete();

        return redirect()->route('manageDesignation')->with('error', 'Designation Deleted Successfully.');
    }
}
