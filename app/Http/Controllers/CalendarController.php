<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        // if (Auth::user()->role->name === 'Super Admin') {
        //     return view('calendar.superCalendar');
        // } elseif (Auth::user()->role->name === 'Admin') {
        //     return view('calendar.adminCalendar');
        // } elseif (Auth::user()->role->name === 'Staff') {
        //     return view('calendar.staffCalendar');
        // }
        if (Auth::user()->roleName === 'Super Admin') {
            return view('calendar.superCalendar');
        } elseif (Auth::user()->roleName === 'Admin') {
            return view('calendar.adminCalendar');
        } elseif (Auth::user()->roleName === 'Staff') {
            return view('calendar.staffCalendar');
        }
    }
}
