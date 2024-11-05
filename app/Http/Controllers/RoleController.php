<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class RoleController extends Controller
{
    public function manageRole()
    {
        //here whereNotIn help to hide the data of Super Admin
        // $roles = Role::whereNotIn('name', ['Super Admin'])->get();
        $roles = Role::all();

        return view('manage-role', compact('roles'));
    }

    public function addNewRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name|max:255',
        ]);
        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        return redirect()->route('manageRole')->with('success', 'Role has been Added');
    }
    public function UpdateRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $role = Role::findOrFail($request->input('id'));
        $role->name = $request->input('name');
        $role->save();

        return redirect()->route('manageRole')->with('success', 'Role Updated Successfully.');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect()->route('manageRole')->with('error', 'Role Deleted Successfully.');
    }
}
