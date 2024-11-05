<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function index()
    {
        if (Auth::user()->roleName === 'Super Admin') {
            return view('calendar.superCalendar');
        } elseif (Auth::user()->roleName === 'Admin') {
            return view('calendar.adminCalendar');
        } elseif (Auth::user()->roleName === 'Staff') {
            return view('calendar.staffCalendar');
        }
        //
    }

    public function fetchEvents()
    {
        return Event::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date|after_or_equal:start',
        ]);

        $event = Event::create($request->all());

        return response()->json(['id' => $event->id]);
    }

    // public function update(Request $request, $id)
    // {
    //     $event = Event::findOrFail($id);
    //     $event->update($request->all());
    //     return response()->json(['success' => true]);
    // }
    // Fetch a specific event for editing
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }

    // Update an existing event
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->update($request->only(['title', 'start', 'end']));
        return response()->json(['success' => true]);
    }

    // Delete an event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return response()->json(['success' => true]);
    }
}
