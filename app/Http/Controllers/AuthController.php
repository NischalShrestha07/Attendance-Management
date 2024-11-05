<?php

namespace App\Http\Controllers;

use App\Models\ManageAttendance;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loadLogin()
    {
        return view('login');
    }
    public function form()
    {
        return view('form');
    }
    public function table()
    {
        return view('table');
    }
    public function layouts()
    {
        return view('layouts.layout');
    }
    public function logout()
    {
        Auth::logout();
        return  redirect()->route('loadLogin')->with('success', 'Logged Out Successfully.');
    }

    // public function redirectToDashboard()
    // {
    //     if (Auth::user()->role->name === 'Admin') {
    //         return redirect()->route('adminDashboard');
    //     } elseif (Auth::user()->role->name === 'Staff') {
    //         return redirect()->route('staffDashboard');
    //     } elseif (Auth::user()->role->name === 'Super Admin') {
    //         return redirect()->route('dashboard');
    //     }

    //     return redirect()->route('dashboard'); // Fallback for other roles or superadmin
    // }

    // public function userLogin(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         $user = Auth::user();

    //         if ($user->role->name == 'Super Admin') {
    //             return redirect()->route('dashboard');
    //         } elseif ($user->role->name == 'Admin') {
    //             return redirect()->route('adminDashboard');
    //         } elseif ($user->role->name == 'Staff') {
    //             return redirect()->route('staffDashboard');
    //         } else {
    //             Auth::logout();
    //             return redirect()->route('loadLogin')->with('error', 'Unauthorized user. Access Denied.');
    //         }
    //     }
    //     return redirect()->route('loadLogin')->with('error', 'Email & Password are incorrect.');
    // }




    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         // Get user details
    //         $user = Auth::user();

    //         // Get current time and date
    //         $currentDateTime = now();
    //         $month = $currentDateTime->format('F'); // Full month name
    //         $loginTime = $currentDateTime->toTimeString(); // Time in HH:MM:SS format

    //         // Get geolocation (example using a third-party service or by IP)
    //         $geolocation = $this->getGeolocation(); // Implement this method

    //         // Store attendance with additional details
    //         ManageAttendance::create([
    //             'employee_id' => $user->id,
    //             'date' => $currentDateTime->toDateString(),
    //             'status' => 'logged_in', // or any other status you define
    //             'month' => $month,
    //             'login_time' => $loginTime,
    //             'geolocation' => $geolocation,
    //         ]);

    //         return redirect()->intended('dashboard');
    //     }

    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }
    // private function getGeolocation()
    // {
    //     $ip = request()->ip(); // Get the user's IP address
    //     // Use a geolocation API service to get details (this is an example URL)
    //     $response = file_get_contents("http://ip-api.com/json/{$ip}");
    //     $data = json_decode($response, true);
    //     return isset($data['city']) ? "{$data['city']}, {$data['regionName']}, {$data['country']}" : 'Unknown';
    // }


    public function redirectToDashboard()
    {
        if (Auth::user()->roleName === 'Admin') {
            return redirect()->route('adminDashboard');
        } elseif (Auth::user()->roleName === 'Staff') {
            return redirect()->route('staffDashboard');
        } elseif (Auth::user()->roleName === 'Super Admin') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('dashboard'); // Fallback for other roles or superadmin
    }
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->roleName == 'Super Admin') {
                return redirect()->route('dashboard');
            } elseif ($user->roleName == 'Admin') {
                return redirect()->route('adminDashboard');
            } elseif ($user->roleName == 'Staff') {
                return redirect()->route('staffDashboard');
            } else {
                Auth::logout();
                return redirect()->route('loadLogin')->with('error', 'Unauthorized user. Access Denied.');
            }
        }
        return redirect()->route('loadLogin')->with('error', 'Email & Password are incorrect.');
    }



    //above naya tala ra mathi same ho


    // Note::Remainder need to change the CheckRole Middleware as well

    // public function userLogin(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         return $this->redirectToDashboard();
    //     }

    //     return redirect()->route('loadLogin')->with('error', 'Email & Password are incorrect.');
    // }



    public function loadRegister()
    {
        $role = Role::where('name', 'Staff')->first();
        return view('register', compact('role'));
    }


    public function userRegister(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $role = Role::where('name', 'Staff')->first();
        $user->role_id = $role ? $role->id : 0;
        // $user->role_id = $user->id;
        $user->save();


        return redirect()->route('loadLogin')->with('success', 'User Registered Successfully.'); // Redirect back with error
    }
}
