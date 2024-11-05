<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\PermissionRoute;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{

    public function managePermission()
    {
        $permissions = Permission::all();
        return view('manage-permission', compact('permissions'));
    }
    public function addNewPermission(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name|max:255',

        ]);
        $role = new Permission();
        $role->name = $request->input('name');
        $role->save();

        return redirect()->route('managePermission')->with('success', 'Permission has been Added');
    }
    public function UpdatePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name|max:225',
        ]);
        $role = Permission::findOrFail($request->input('id'));
        $role->name = $request->input('name');
        $role->save();

        return redirect()->route('managePermission')->with('success', 'Permission Updated Successfully.');
    }

    public function destroy($id)
    {
        $role = Permission::find($id);
        $role->delete();

        return redirect()->route('managePermission')->with('error', 'Permission Deleted Successfully.');
    }

    public function assignPermissionRole()
    {
        $roles = Role::whereNotIn('name', ['Super Admin'])->get();
        $permissions = Permission::all();
        $permissionWithRoles = Permission::with('roles')->whereHas('roles')->get();
        // dd($permissionWithRoles);

        return view('assign-permission-role', compact('roles', 'permissions', 'permissionWithRoles'));
    }


    public function createPermissionRole(Request $request)
    {
        $isExistPermissionRole = PermissionRole::where([
            'permission_id' => $request->permission_id,
            'role_id' => $request->role_id,
        ])->first();

        if ($isExistPermissionRole) {
            return redirect()->route('managePermissionRole')->with('error', 'Permission is already assigned to selected role! ');
        }
        $permissions = new PermissionRole();
        $permissions->permission_id = $request->input('permission_id');
        $permissions->role_id = $request->input('role_id');
        $permissions->save();

        return redirect()->route('managePermissionRole')->with('success', 'Permission is assigned to selected role!');
    }


    public function updatePermissionRole(Request $request)
    {
        $isExistPermissionRole = PermissionRole::where([
            'permission_id' => $request->permission_id,
            'role_id' => $request->role_id,
        ])->first();

        if ($isExistPermissionRole) {
            return redirect()->route('managePermissionRole')->with('error', 'Permission is already assigned to selected role! ');
        }
        $permissions = new PermissionRoute();
        $permissions->permission_id = $request->input('permission_id');
        $permissions->role_id = $request->input('role_id');
        $permissions->save();

        return redirect()->route('managePermissionRole')->with('success', 'Permission is assigned to selected role!');
    }
    public function destroy2($id)
    {
        // $role = PermissionRole::find($id);
        $role = Permission::find($id);
        $role->delete();

        return redirect()->route('managePermissionRole')->with('error', 'Permission Deleted Successfully.');
    }





    public function assignPermissionRoute()
    {
        $routes = Route::getRoutes();
        // dd($routes);
        // $middlewareGroup = 'guest';
        //as for AdminAuthenticate auth is named as shortname;
        $middlewareGroup = 'auth';
        $routeDetails = [];
        foreach ($routes as $route) {

            $middleware = $route->gatherMiddleware();
            if (in_array($middlewareGroup, $middleware)) {

                // $routeDetails[] = [
                //     'name' => $route->getName(),
                //     'url' => $route->uri(),
                //     //note there is uri()

                // ];
                //above shows all the routes inside the 'auth' middleware


                $routeName = $route->getName();
                if ($routeName !== 'dashboard' && $routeName !== 'logout') {

                    $routeDetails[] = [
                        'name' => $route->getName(),
                        'url' => $route->uri(),
                        //note there is uri()

                    ];
                }
                //above shows all the routes EXCEPT THE DASHBOARD & LOGOUT inside the 'auth' middleware
            }
        }
        // dd($routeDetails); SHOWS all the details as debugger details

        $permissions = Permission::all();
        $routerPermission = PermissionRoute::with('permission')->get();
        return view('assign-permission-route', compact('permissions',  'routeDetails', 'routerPermission'));
    }


    public function createPermissionRoute(Request $request)
    {

        $isExist = PermissionRoute::where([
            'permission_id' => $request->permission_id,
            'router' => $request->route, //route is named in view
        ])->first();

        if ($isExist) {
            return redirect()->route('assignPermissionRoute')->with('error', 'Permission is already assigned! ');
        }
        $permissions = new PermissionRoute();
        $permissions->permission_id = $request->input('permission_id');
        $permissions->router = $request->input('route');
        $permissions->save();
        return redirect()->route('assignPermissionRoute')->with('success', 'Permission is assigned to selected route!');
    }
    public function deletePermissionRoute($id)
    {
        $data = PermissionRoute::find($id);
        $data->delete();

        return redirect()->route('assignPermissionRoute')->with('error', 'PermissionRoute Deleted Successfully.');
    }
    public function UpdatePermissionRoute(Request $request)
    {
        $data = PermissionRoute::findOrFail($request->input('id'));
        $data->router = $request->input('route');
        $data->permission_id = $request->input('permission_id');
        $data->save();

        return redirect()->route('assignPermissionRoute')->with('success', 'PermissionRoute Updated Successfully.');
    }
}
