<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceDetailsController;
use App\Http\Controllers\AttendCoordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GeoAttendanceController;
use App\Http\Controllers\GeoController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\ManageAttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Models\Attendance;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [AuthController::class, 'loadLogin'])->name('loadLogin');
    Route::post('/', [AuthController::class, 'userLogin'])->name('userLogin');
    Route::get('/register', [AuthController::class, 'loadRegister'])->name('loadRegister');
    Route::post('/userRegister', [AuthController::class, 'userRegister'])->name('userRegister');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/attendance/login', [ManageAttendanceController::class, 'loginAttendance'])->name('attendance.login');
    Route::post('/attendance/logout', [ManageAttendanceController::class, 'logoutAttendance'])->name('attendance.logout');

    //Redirect based on Role
    Route::get('superadmin/dashboard', [AuthController::class, 'redirectToDashboard'])->name('dashboard');



    Route::get('/layouts', [AuthController::class, 'layouts'])->name('layouts');
    Route::get('form', [AuthController::class, 'form'])->name('form');
    Route::get('table', [AuthController::class, 'table'])->name('table');

    //manage Roles Route
    Route::get('/manageRoles', [RoleController::class, 'manageRole'])->name('manageRole');
    Route::post('/addNewRole', [RoleController::class, 'addNewRole'])->name('addRole');
    Route::put('/UpdateRole', [RoleController::class, 'UpdateRole'])->name('updateRole');
    Route::delete('/deleteRole/{id}', [RoleController::class, 'destroy'])->name('destroy.role');

    //manage Permission Route
    Route::get('/managePermission', [PermissionController::class, 'managePermission'])->name('managePermission');
    Route::post('/addNewPermission', [PermissionController::class, 'addNewPermission'])->name('addPermission');
    Route::put('/UpdatePermission', [PermissionController::class, 'UpdatePermission'])->name('updatePermission');
    Route::delete('/deletePermission/{id}', [PermissionController::class, 'destroy'])->name('deletePermission');

    //assign permission to role routes
    Route::get('/assignPermissionRole', [PermissionController::class, 'assignPermissionRole'])->name('managePermissionRole');
    Route::post('/createPermissionRole', [PermissionController::class, 'createPermissionRole'])->name('createPermissionRole');
    Route::post('/updatePermissionRole', [PermissionController::class, 'updatePermissionRole'])->name('updatePermissionRole');
    Route::delete('/deletePermissionRole/{id}', [PermissionController::class, 'destroy2'])->name('destroy.assign');



    //assign Permission to route
    Route::get('assign-permission-route', [PermissionController::class, 'assignPermissionRoute'])->name('assignPermissionRoute');
    Route::post('create-permission-route', [PermissionController::class, 'createPermissionRoute'])->name('createPermissionRoute');
    Route::put('UpdatePermissionRoute', [PermissionController::class, 'UpdatePermissionRoute'])->name('UpdatePermissionRoute');
    Route::delete('deletePermissionRoute/{id}', [PermissionController::class, 'deletePermissionRoute'])->name('deletePermissionRoute');
    // URL le /create-permission-route xai lido raxa controller xai haina hai


    //manage User route
    Route::get('users', [UserController::class, 'users'])->name('users');
    Route::post('addNewUser', [UserController::class, 'addNewUser'])->name('postUser');
    Route::put('UpdateUser', [UserController::class, 'UpdateUser'])->name('UpdateUser');
    Route::delete('deleteUser/{id}', [UserController::class, 'destroy'])->name('delete.user');



    Route::get('superadmin/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('role:Super Admin');

    Route::get('admin/dashboard', function () {
        return view('adminDashboard');
    })->name('adminDashboard')->middleware('role:Admin');


    Route::get('staff/dashboard', function () {
        return view('staffDashboard');
    })->name('staffDashboard')->middleware('role:Staff');

    Route::get('/manageStaff', [StaffController::class, 'index'])->name('staff.index');
    Route::post('/addNewStaff', [StaffController::class, 'addNewStaff'])->name('addStaff');
    Route::put('/UpdateStaff', [StaffController::class, 'UpdateStaff'])->name('updateStaff');
    Route::delete('/deleteStaff/{id}', [StaffController::class, 'destroy'])->name('destroy.staff');


    //manage Employee
    Route::get('/employee/create', [EmployeeController::class, 'index'])->name('employee.create');
    Route::post('/AddNewEmployee', [EmployeeController::class, 'AddNewEmployee'])->name('employee.add');
    Route::put('/UpdateEmployee', [EmployeeController::class, 'UpdateEmployee']);
    Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

    //manage client
    Route::get('/client/create', [ClientController::class, 'index'])->name('client.create');
    Route::post('/AddNewClient', [ClientController::class, 'addNewClient'])->name('client.add');
    Route::put('/UpdateClient', [ClientController::class, 'UpdateClient']);
    Route::delete('/client/{id}', [ClientController::class, 'destroy'])->name('client.destroy');

    //manage Holiday
    Route::get('/holiday/create', [HolidayController::class, 'index'])->name('holiday.create');
    Route::post('/AddNewHoliday', [HolidayController::class, 'AddNewHoliday'])->name('holiday.add');
    Route::put('/UpdateHoliday', [HolidayController::class, 'UpdateHoliday']);
    Route::delete('/holiday/{id}', [HolidayController::class, 'destroy'])->name('holiday.destroy');

    //manage Leave
    Route::get('/leave/create', [LeaveController::class, 'index'])->name('leave.create');
    Route::post('/AddNewLeave', [LeaveController::class, 'AddNewLeave'])->name('leave.add');
    Route::put('/UpdateLeave', [LeaveController::class, 'UpdateLeave']);
    Route::delete('/leave/{id}', [LeaveController::class, 'destroy'])->name('leave.destroy');


    //manage Department Route
    Route::get('/manageDepartment', [DepartmentController::class, 'manageDepartment'])->name('department.create');
    Route::post('/addNewDepartment', [DepartmentController::class, 'addNewDepartment'])->name('addDepartment');
    Route::put('/UpdateDepartment', [DepartmentController::class, 'UpdateDepartment'])->name('updateDepartment');
    Route::delete('/deleteDepartment/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');

    //manage Designations Route
    Route::get('/manageDesignation', [DesignationController::class, 'manageDesignation'])->name('manageDesignation');
    Route::post('/addNewDesignation', [DesignationController::class, 'addNewDesignation'])->name('addDesignation');
    Route::put('/UpdateDesignation', [DesignationController::class, 'UpdateDesignation'])->name('updateDesignation');
    Route::delete('/deleteDesignation/{id}', [DesignationController::class, 'destroy'])->name('destroy.designation');


    Route::get('/companies', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/companies/{id}', [CompanyController::class, 'showCompanyDetails'])->name('company.details');


    Route::get('/attendance/create', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/addAttendance', [AttendanceController::class, 'addAttendance'])->name('addAttendance');
    Route::put('UpdateAttendance', [AttendanceController::class, 'UpdateAttendance']);
    Route::delete('/deleteAttendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');


    Route::get('/attendance', [ManageAttendanceController::class, 'index'])->name('manageAttendance.index');
    Route::post('/attendance/store', [ManageAttendanceController::class, 'store'])->name('attendance.store');



    Route::get('/calendar', [EventController::class, 'index'])->name('event.index');
    Route::get('/fetch-events', [EventController::class, 'fetchEvents']);
    Route::post('/store-event', [EventController::class, 'store']);
    Route::get('/event/{id}', [EventController::class, 'show']);
    Route::put('/update-event/{id}', [EventController::class, 'update']);
    Route::delete('/delete-event/{id}', [EventController::class, 'destroy']);



    Route::post('/api/track-attendance', [GeoAttendanceController::class, 'trackAttendance'])->middleware('auth');
    Route::get('/api/daily-summary', [GeoAttendanceController::class, 'dailySummary'])->middleware('auth');

    // Route::get('/attendance-summary', [GeoAttendanceController::class, 'getAttendanceSummary'])->name('attendance.summary')->middleware('auth');
});
Route::middleware('auth')->group(function () {
    Route::post('/attendance/checkin', [GeoAttendanceController::class, 'checkIn'])->name('attendance.checkin');
    Route::post('/attendance/checkout', [GeoAttendanceController::class, 'checkOut'])->name('attendance.checkout');
    Route::get('/attendance/summary', [GeoAttendanceController::class, 'summary'])->name('attendance.summary');


    //Attendance Coordinates
    Route::get('/admin/attendance-coordinates', [GeoAttendanceController::class, 'showAttendanceCoordinates'])->name('attendance.coordinate');


    // Route::post('/coordinate/attendance/checkin', [AttendCoordController::class, 'checkIns']);
    // Route::post('/coordinate/attendance/checkout', [AttendCoordController::class, 'checkOuts']);








    //attendance details(This has been Hidden )
    Route::get('/admin/attendance-details', [AttendanceDetailsController::class, 'index'])->name('attendance.details.index');
});
