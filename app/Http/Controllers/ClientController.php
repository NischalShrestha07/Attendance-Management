<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $clients = Client::all();
        // if (Auth::user()->role->name === 'Super Admin') {
        //     return view('admin.clients.superClient', compact('clients', 'departments'));
        // } elseif (Auth::user()->role->name === 'Admin') {
        //     return view('admin.clients.adminClient', compact('clients', 'departments'));
        // } elseif (Auth::user()->role->name === 'Staff') {
        //     return view('admin.clients.staffClient', compact('clients', 'departments'));
        // }
        if (Auth::user()->roleName === 'Super Admin') {
            return view('admin.clients.superClient', compact('clients', 'departments'));
        } elseif (Auth::user()->roleName === 'Admin') {
            return view('admin.clients.adminClient', compact('clients', 'departments'));
        } elseif (Auth::user()->roleName === 'Staff') {
            return view('admin.clients.staffClient', compact('clients', 'departments'));
        }
    }



    public function addNewClient(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'department' => 'nullable',
            'address' => 'nullable',
            'status' => 'nullable',
            'notes' => 'nullable',
            'companyName' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',


        ]);
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('images/clients', 'public');
        }
        $client = new Client();

        $client->photo = $photoPath;
        $client->fullname = $request->input('fullname');
        $client->phone = $request->input('phone');
        $client->email = $request->input('email');
        $client->companyName = $request->input('companyName');
        $client->department = $request->input('department');
        $client->address = $request->input('address');
        $client->status = $request->input('status');
        $client->notes = $request->input('notes');
        $client->save();

        return redirect()->route('client.create')->with('success', 'Client Added Successfully.');
    }



    /**
     * Update the specified resource in storage.
     */
    public function UpdateClient(Request $request, client $client)
    {
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'department' => 'nullable',
            'address' => 'nullable',
            'status' => 'nullable',
            'notes' => 'nullable',
            'companyName' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
        $client = Client::findOrFail($request->input('id'));

        if (!$client) {
            return redirect()->route('client.create')->with('error', 'Client not found');
        }

        // Handle File Upload for image
        if ($request->hasFile('photo')) {
            // Store new image
            $photoPath = $request->file('photo')->store('images/clients', 'public');
            $client->photo = $photoPath;
        }


        $client->fullname = $request->input('fullname');
        $client->email = $request->input('email');
        $client->phone = $request->input('phone');
        $client->department = $request->input('department');
        $client->companyName = $request->input('companyName');
        $client->address = $request->input('address');
        $client->notes = $request->input('notes');
        $client->status = $request->input('status');
        $client->save();
        return redirect()->route('client.create')->with('success', 'Client Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(client $client, $id)

    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('client.create')->with('error', 'Client Deleted Successfully.');
    }
}
