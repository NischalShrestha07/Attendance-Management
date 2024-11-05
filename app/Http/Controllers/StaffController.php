<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Staff::all();
        return view('staff.index', compact('staffs'));
    }



    public function addNewStaff(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'department' => 'nullable',
            'date_of_join' => 'nullable',
            'status' => 'nullable',


        ]);
        $staff = new Staff();
        $staff->fullname = $request->input('fullname');
        $staff->email = $request->input('email');
        $staff->phone = $request->input('phone');
        $staff->department = $request->input('department');
        $staff->date_of_join = $request->input('date_of_join');
        $staff->status = $request->input('status');
        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff Added Successfully.');
    }



    /**
     * Update the specified resource in storage.
     */
    public function UpdateStaff(Request $request, Staff $staff)
    {
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'department' => 'nullable',
            'date_of_join' => 'nullable',
            'status' => 'nullable',
        ]);
        $staff = Staff::findOrFail($request->input('id'));
        $staff->fullname = $request->input('fullname');
        $staff->email = $request->input('email');
        $staff->phone = $request->input('phone');
        $staff->department = $request->input('department');
        $staff->date_of_join = $request->input('date_of_join');
        $staff->status = $request->input('status');
        $staff->save();
        return redirect()->route('staff.index')->with('success', 'Staff Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff, $id)

    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return redirect()->route('staff.index')->with('error', 'Staff Deleted Successfully.');
    }
}
