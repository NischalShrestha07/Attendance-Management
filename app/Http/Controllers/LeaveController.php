<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::all();

        // Check user role
        // if (Auth::user()->name === 'Super Admin') {
        //     return view('admin.leaves.superAdmin', compact('leaves'));
        // } elseif (Auth::user()->name === 'Admin') {
        //     return view('admin.leaves.admin', compact('leaves'));
        // } elseif (Auth::user()->name === 'Staff') {
        //     return view('admin.leaves.staff', compact('leaves'));
        // } else {
        //     return redirect()->route('loadLogin')->with('error', 'Unauthorized access.');
        // }
        if (Auth::user()->roleName === 'Super Admin') {
            return view('admin.leaves.superAdmin', compact('leaves'));
        } elseif (Auth::user()->roleName === 'Admin') {
            return view('admin.leaves.admin', compact('leaves'));
        } elseif (Auth::user()->roleName === 'Staff') {
            return view('admin.leaves.staff', compact('leaves'));
        } else {
            return redirect()->route('loadLogin')->with('error', 'Unauthorized access.');
        }

        // return view('admin.leaves.superAdmin', compact('leaves'));
    }
    public function AddNewLeave(Request $request)
    {

        $request->validate([
            'employeeName' => 'required|string',
            'leaveType' => 'required|string',
            'from' => 'required|date',
            'to' => 'required|date',
            'days' => 'nullable|string',
            'reason' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|string',

        ]);

        $leave = new Leave();
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('images/leaves', 'public');
        }
        $leave->photo = $photoPath;

        $leave->employeeName = $request->input('employeeName');
        $leave->leaveType = $request->input('leaveType');
        $leave->from = $request->input('from');
        $leave->to = $request->input('to');
        $leave->days = $request->input('days');
        $leave->reason = $request->input('reason');
        $leave->status = $request->input('status');
        $leave->save();

        return redirect()->route('leave.create')->with('success', 'Leave Request Added Successfully.');
    }
    public function UpdateLeave(Request $request)
    {

        $request->validate([
            'employeeName' => 'required|string',
            'leaveType' => 'required|string',
            'from' => 'required|date',
            'to' => 'required|date',
            'days' => 'nullable|string',
            'reason' => 'nullable|string',
            'status' => 'nullable|string',

        ]);
        $leave = Leave::find($request->input('id'));


        if (!$leave) {
            return redirect()->route('leave.create')->with('error', 'Leave Request not found');
        }
        // Handle File Upload for image
        if ($request->hasFile('photo')) {
            // Store new image
            $photoPath = $request->file('photo')->store('images/leaves', 'public');
            $leave->photo = $photoPath;
        }
        $leave->employeeName = $request->input('employeeName');
        $leave->leaveType = $request->input('leaveType');
        $leave->from = $request->input('from');
        $leave->to = $request->input('to');
        $leave->days = $request->input('days');
        $leave->reason = $request->input('reason');
        $leave->status = $request->input('status');
        $leave->save();

        return redirect()->route('leave.create')->with('success', 'Leave Request Updated Successfully.');
    }
    public function destroy($id)
    {
        $leave = Leave::find($id);
        $leave->delete();

        return redirect()->route('leave.create')->with('error', 'Leave Request Deleted Successfully.');
    }
}
