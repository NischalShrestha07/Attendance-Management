<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $designation = Designation::all();
        $users = User::with('role')->where('role_id', '!=', 1)->get();
        $roles = Role::all();
        $employees = Employee::all();
        return view('admin.employee.index', compact('employees', 'roles', 'users', 'departments', 'designation'));
    }
    public function AddNewEmployee(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'mobile' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'joinDate' => 'nullable|string',
            'role' => 'nullable|string',
            'company' => 'required|string',
            'department' => 'nullable|string',
            'designation' => 'nullable|string',
            'status' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',



        ]);
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('images/employees', 'public');
        }
        $employee = new Employee();
        $employeeId = 'EMP-' . strtoupper(Str::random(6));
        $employee->photo = $photoPath;
        $employee->employeeId = $employeeId;


        $employee->name = $request->input('name');
        $employee->password = Hash::make($request->input('password'));
        $employee->mobile = $request->input('mobile');
        $employee->department = $request->input('department');
        $employee->designation = $request->input('designation');
        $employee->company = $request->input('company');
        $employee->email = $request->input('email');
        $employee->joinDate = $request->input('joinDate');
        $employee->role = $request->input('role');
        $employee->status = $request->input('status');
        $employee->save();

        return redirect()->route('employee.create')->with('success', 'employee Added Successfully.');
    }
    public function UpdateEmployee(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'mobile' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'joinDate' => 'nullable|string',
            'role' => 'nullable|string',
            'company' => 'required|string',
            'department' => 'nullable|string',
            'designation' => 'nullable|string',
            'status' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',


        ]);
        $employee = Employee::find($request->input('id'));


        if (!$employee) {
            return redirect()->route('employee.create')->with('error', 'Employee not found');
        }

        // Handle File Upload for image
        if ($request->hasFile('photo')) {
            // Store new image
            $photoPath = $request->file('photo')->store('images/employees', 'public');
            $employee->photo = $photoPath;
        }

        // $employee = Employee::find('id');
        $employee->name = $request->input('name');
        $employee->password = Hash::make($request->input('password'));
        $employee->mobile = $request->input('mobile');
        $employee->department = $request->input('department');
        $employee->designation = $request->input('designation');
        $employee->email = $request->input('email');
        $employee->company = $request->input('company');
        $employee->joinDate = $request->input('joinDate');
        $employee->role = $request->input('role');
        $employee->status = $request->input('status');
        $employee->save();

        return redirect()->route('employee.create')->with('success', 'Employee Updated Successfully.');
    }
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return redirect()->route('employee.create')->with('error', 'Employee Deleted Successfully.');
    }
}
