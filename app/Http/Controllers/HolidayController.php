<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HolidayController extends Controller
{
    public function index()
    {

        $holidays = Holiday::all();
        // Check user role
        // if (Auth::user()->role->name === 'Super Admin') {
        //     return view('admin.holidays.superIndex', compact('holidays'));
        // } elseif (Auth::user()->role->name === 'Admin') {
        //     return view('admin.holidays.adminIndex', compact('holidays'));
        // } elseif (Auth::user()->role->name === 'Staff') {
        //     return view('admin.holidays.staffIndex', compact('holidays'));
        // } else {
        //     return redirect()->route('loadLogin')->with('error', 'Unauthorized access.');
        // }
        if (Auth::user()->roleName === 'Super Admin') {
            return view('admin.holidays.superIndex', compact('holidays'));
        } elseif (Auth::user()->roleName === 'Admin') {
            return view('admin.holidays.adminIndex', compact('holidays'));
        } elseif (Auth::user()->roleName === 'Staff') {
            return view('admin.holidays.staffIndex', compact('holidays'));
        } else {
            return redirect()->route('loadLogin')->with('error', 'Unauthorized access.');
        }
    }
    public function AddNewHoliday(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'type' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'details' => 'nullable|string',


        ]);

        $holiday = new Holiday();
        $holiday->title = $request->input('title');
        $holiday->type = $request->input('type');
        $holiday->startDate = $request->input('startDate');
        $holiday->endDate = $request->input('endDate');
        $holiday->details = $request->input('details');
        $holiday->save();

        return redirect()->route('holiday.create')->with('success', 'holiday Added Successfully.');
    }
    public function UpdateHoliday(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'type' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'details' => 'nullable|string',

        ]);
        $holiday = Holiday::find($request->input('id'));


        if (!$holiday) {
            return redirect()->route('holiday.create')->with('error', 'holiday not found');
        }
        $holiday->title = $request->input('title');
        $holiday->type = $request->input('type');
        $holiday->startDate = $request->input('startDate');
        $holiday->endDate = $request->input('endDate');
        $holiday->details = $request->input('details');
        $holiday->save();

        return redirect()->route('holiday.create')->with('success', 'holiday Updated Successfully.');
    }
    public function destroy($id)
    {
        $holiday = Holiday::find($id);
        $holiday->delete();

        return redirect()->route('holiday.create')->with('error', 'holiday Deleted Successfully.');
    }
}
