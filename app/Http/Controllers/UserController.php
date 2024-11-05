<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function users()
    {
        $departments = Department::all();
        $designation = Designation::all();
        $users = User::with('role')->where('role_id', '!=', 1)->get();
        //note the below step
        // $roles = Role::where('name', '!=', 'Super Admin')->get();
        $roles = Role::all();
        // return view('users', compact('roles', 'users', 'designation', 'departments'));
        if (Auth::user()->roleName === 'Super Admin') {
            return view('admin.usersMn.superUser', compact('roles', 'users', 'designation', 'departments'));
        } elseif (Auth::user()->roleName === 'Admin') {
            return view('admin.usersMn.adminUser', compact('roles', 'users', 'designation', 'departments'));
        } elseif (Auth::user()->roleName === 'Staff') {
            return view('admin.usersMn.staffUser', compact('roles', 'users', 'designation', 'departments'));
        }
    }


    public function addNewUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'nullable',
            'username' => 'nullable|string',
            'mobile' => 'required|string',

            'joinDate' => 'nullable|date',
            'roleName' => 'required|string',
            'company' => 'required|string',
            'department' => 'nullable|string',
            'designation' => 'nullable|string',
            'status' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = $request->input('role_id');


        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('images/users', 'public');
        }

        $employeeId = 'EMP-' . strtoupper(Str::random(6));
        $user->photo = $photoPath;
        $user->employeeId = $employeeId;


        $user->username = $request->input('username');
        $user->mobile = $request->input('mobile');
        $user->department = $request->input('department');
        $user->designation = $request->input('designation');
        $user->company = $request->input('company');
        $user->joinDate = $request->input('joinDate');
        $user->roleName = $request->input('roleName');
        $user->status = $request->input('status');
        // dd($user);

        $user->save();

        return redirect()->route('users')->with('success', 'User Added Successfully.');
    }

    // public function UpdateUser(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'nullable|string',
    //         'email' => 'required|email',
    //         'password' => 'nullable',
    //         'role_id' => 'nullable',
    //         'username' => 'required|string',
    //         'mobile' => 'required|string',

    //         'joinDate' => 'nullable|date',
    //         'roleName' => 'required|string',
    //         'company' => 'required|string',
    //         'department' => 'nullable|string',
    //         'designation' => 'nullable|string',
    //         'status' => 'required|string',
    //         'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);
    //     $user = User::find($request->input('id'));

    //     if (!$user) {
    //         return redirect()->route('users')->with('error', 'User not found');
    //     }

    //     // Handle File Upload for image
    //     if ($request->hasFile('photo')) {
    //         $photoPath = $request->file('photo')->store('images/users', 'public');
    //         $user->photo = $photoPath;
    //     }

    //     $user->name = $request->input('name');
    //     $user->email = $request->input('email');
    //     $user->password = Hash::make($request->input('password'));
    //     $user->role_id = $request->input('role_id');
    //     $user->username = $request->input('username');
    //     $user->mobile = $request->input('mobile');
    //     $user->department = $request->input('department');
    //     $user->designation = $request->input('designation');
    //     $user->company = $request->input('company');
    //     $user->joinDate = $request->input('joinDate');
    //     $user->roleName = $request->input('roleName');
    //     $user->status = $request->input('status');
    //     $user->save();

    //     return redirect()->route('users')->with('success', 'User Updated Successfully.');
    // }
    public function UpdateUser(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'required|email',
            'password' => 'nullable',
            'role_id' => 'nullable',
            'username' => 'required|string',
            'mobile' => 'required|string',
            'joinDate' => 'nullable|date',
            'roleName' => 'required|string',
            'company' => 'required|string',
            'department' => 'nullable|string',
            'designation' => 'nullable|string',
            'status' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::find($request->input('id'));

        if (!$user) {
            return redirect()->route('users')->with('error', 'User not found');
        }

        // Handle File Upload for image
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('images/users', 'public');
            $user->photo = $photoPath;
        }

        // Update the other fields
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Only update password if it's provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->role_id = $request->input('role_id');
        $user->username = $request->input('username');
        $user->mobile = $request->input('mobile');
        $user->department = $request->input('department');
        $user->designation = $request->input('designation');
        $user->company = $request->input('company');
        $user->joinDate = $request->input('joinDate');
        $user->roleName = $request->input('roleName');
        $user->status = $request->input('status');
        $user->save();

        return redirect()->route('users')->with('success', 'User Updated Successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users')->with('error', 'User Deleted Successfully.');
    }
}
