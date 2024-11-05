<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function manageDepartment()
    {
        //here whereNotIn help to hide the data of Super Admin
        // $departments = Department::whereNotIn('name', ['Super Admin'])->get();
        $departments = Department::all();

        // if (Auth::user()->role->name === 'Super Admin') {
        //     return view('admin.department.superDepartments', compact('departments'));
        // } elseif (Auth::user()->role->name === 'Admin') {
        //     return view('admin.department.adminDepartment', compact('departments'));
        // } elseif (Auth::user()->role->name === 'Staff') {
        //     return view('admin.department.staffDepartment', compact('departments'));
        // }
        if (Auth::user()->roleName === 'Super Admin') {
            return view('admin.department.superDepartments', compact('departments'));
        } elseif (Auth::user()->roleName === 'Admin') {
            return view('admin.department.adminDepartment', compact('departments'));
        } elseif (Auth::user()->roleName === 'Staff') {
            return view('admin.department.staffDepartment', compact('departments'));
        }
    }

    public function addNewDepartment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:departments,name|max:255',
        ]);
        $department = new Department();
        $department->name = $request->input('name');
        $department->save();

        return redirect()->route('department.create')->with('success', 'Department has been Added');
    }
    public function UpdateDepartment(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $department = Department::findOrFail($request->input('id'));
        $department->name = $request->input('name');
        $department->save();

        return redirect()->route('department.create')->with('success', 'Department Updated Successfully.');
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect()->route('department.create')->with('error', 'Department Deleted Successfully.');
    }
}
