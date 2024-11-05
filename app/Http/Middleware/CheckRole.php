<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // if (!Auth::check()) {
        //     return redirect()->route('loadLogin'); // Redirect to login if not authenticated
        // }

        // // Check if the authenticated user's role matches the required role
        // if (Auth::user()->name != $role) {
        //     return redirect()->route('loadLogin')->with('error', 'Unauthorized user. Access Denied.');
        // }
        // return $next($request);


        // if (!Auth::check()) {
        //     return redirect()->route('loadLogin')->with('error', 'Please log in.'); // Redirect to login if not authenticated
        // }
        // $userRole = Auth::user()->role->name;

        // if (in_array($userRole, $roles)) {
        //     return $next($request);
        // }
        // return redirect()->route('loadLogin')->with('error', 'Unauthorized user. Access Denied.');

        // if (!Auth::check()) {
        //     return redirect()->route('loadLogin'); // Redirect to login if not authenticated
        // }

        // // Check if the authenticated user's role matches the required role
        // if (Auth::user()->role->name == $role) {
        //     // if (Auth::check() && Auth::user()->role->name == $role) {
        //     return $next($request);
        // }
        // return redirect('/')->with('error', "You don't have access to this page,");
        // Check if the user is authenticated and their role matches the required role


        // this is the change of userLogin
        // if (Auth::check() && Auth::user()->role->name == $role) {


        if (Auth::check() && Auth::user()->roleName == $role) {
            return $next($request);
        }

        // If the role doesn't match, redirect them to their respective dashboard
        // switch (Auth::user()->role->name) {
        //     case 'Super Admin':
        //         return redirect()->route('dashboard')->with('error', 'Unauthorized Access');
        //     case 'Admin':
        //         return redirect()->route('adminDashboard')->with('error', 'Unauthorized Access');
        //     case 'Staff':
        //         return redirect()->route('staffDashboard')->with('error', 'Unauthorized Access');
        //     default:
        //         return redirect()->route('loadLogin')->with('error', 'Unauthorized Access');
        // }
        switch (Auth::user()->roleName) {
            case 'Super Admin':
                return redirect()->route('dashboard')->with('error', 'Unauthorized Access');
            case 'Admin':
                return redirect()->route('adminDashboard')->with('error', 'Unauthorized Access');
            case 'Staff':
                return redirect()->route('staffDashboard')->with('error', 'Unauthorized Access');
            default:
                return redirect()->route('loadLogin')->with('error', 'Unauthorized Access');
        }
    }
}
