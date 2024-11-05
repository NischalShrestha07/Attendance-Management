<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adminlte.io/themes/v3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 May 2024 05:15:42 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{Auth::user()->name}}({{Auth::user()->roleName}})</title>
    {{-- ICON IS NOT WORKING --}}
    <link rel="icon" href="{{ asset('images/icons8-books-16.png') }}">
    <base href="{{ asset('admincss') }}/" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/dropdown.css')}}">
    {{--
    <link rel="stylesheet" href="../../../code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <link rel="icon" style="border-radius: 50px;" href="{{ asset('storage/'.Auth::user()->photo) }}">
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="../plugins/fullcalendar/main.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Fade in the alert on page load
        let alertBox = document.querySelectorAll('.custom-alert');

        // Automatically fade out after 5 seconds
        setTimeout(function() {
            alertBox.forEach(function(alert) {
                alert.classList.add('fade-out');
            });
        }, 5000); // 5 seconds

        // Remove the alert from the DOM after the fade-out transition completes
        setTimeout(function() {
            alertBox.forEach(function(alert) {
                alert.remove();
            });
        }, 5500); // 5 seconds + 0.5s for fade-out effect
    });
    </script>
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="dist/css/adminlte.min2167.css?v=3.2.0">

    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">


    {{-- /////TOKEN RELATED IMPORTANT POINTS --}}
    <meta name="csrf-token" content="{{csrf_token()}}" />

    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <style>
        .multi-select-dropdown {
            position: relative;
            width: 100%;
        }

        .select-box {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .select-box input {
            border: none;
            background: none;
            outline: none;
            width: 90%;
            cursor: pointer;
        }

        .select-box .arrow {
            width: 10px;
            height: 10px;
            border: solid #666;
            border-width: 0 2px 2px 0;
            display: inline-block;
            padding: 3px;
            transform: rotate(45deg);
            transition: transform 0.3s ease;
        }

        .select-box.active .arrow {
            transform: rotate(-135deg);
        }

        .options-container {
            display: none;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            position: absolute;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            margin-top: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .options-container label {
            display: block;
            padding: 10px 15px;
            cursor: pointer;
            background-color: white;
            border-bottom: 1px solid #eee;
            transition: background-color 0.3s ease;
        }

        .options-container label:hover {
            background-color: #f0f0f0;
        }

        .options-container input {
            margin-right: 8px;
        }

        .options-container::-webkit-scrollbar {
            width: 6px;
        }

        .options-container::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        .options-container label:last-child {
            border-bottom: none;
        }

        .custom-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 5px;
            padding: 20px;
            max-width: 300px;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.5s ease-out;
        }

        .custom-alert.fade-in {
            opacity: 1;
            transform: translateX(0);
        }

        .custom-alert.fade-out {
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.5s ease-in;
        }

        .alert strong {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .close {
            font-size: 1.2rem;
        }
    </style>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('admincss/dist/img/its.png') }}" alt="AdminLTELogo" height="60"
                width="60">
        </div>

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">

                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">

                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">

                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-5">

            <a href="index3.html" class="brand-link">
                <img style="margin-left: 0" src="dist/img/AdminLTELogo.png" alt="School Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><b
                        style="font-family: cursive">{{Auth::user()->roleName}}</b></span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('storage/' . Auth::user()->photo)}}" class="img-circle elevation-2"
                            alt=" Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            {{Auth::user()->name}}</a>
                    </div>
                </div>

                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{route('dashboard')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                    <span class="right badge badge-danger">Super Admin</span>
                                </p>
                            </a>
                        </li>

                        <!-- Employees -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Employees
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('employee.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Employees</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Manage Roles -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>
                                    Manage Roles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('manageRole')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Manage Permissions -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-key"></i>
                                <p>
                                    Manage Permissions
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('managePermission')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Permissions</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        <!-- Assign Permission to Role -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-tag"></i>
                                <p>
                                    Assign Permission Role
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('managePermissionRole')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Assign Permission-Role</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        <!-- Assign Permission Route -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-route"></i>
                                <p>
                                    Assign Permission Route
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('assignPermissionRoute')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Assign Permission-Route</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        <!-- Manage Users -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Manage Users
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('users')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Holidays -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-umbrella-beach"></i>
                                <p>
                                    Holidays
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('holiday.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Holidays</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Leaves -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>
                                    Leaves
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('leave.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Leaves</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Calendar -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                    Calendar
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('event.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Calendar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Departments -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-building"></i>
                                <p>
                                    Departments
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('department.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Departments</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Designations -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-id-badge"></i>
                                <p>
                                    Designations
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('manageDesignation')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Designations</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Manage Staff -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Staff
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('staff.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Staff List</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Clients
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('client.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Clients List</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Attendances Employees
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('attendance.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Attendance Records</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Attendances Details
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('attendance.details.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Attendance Details</p>
                                    </a>
                                </li>

                            </ul>
                        </li> --}}

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Attendances
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('manageAttendance.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Attendance</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Geolocation Attendances
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('attendance.summary')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Geolocation Attendance</p>
                                    </a>
                                </li>

                            </ul>

                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Attendance Coordinates
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('attendance.coordinate')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Coordinates List</p>
                                    </a>
                                </li>

                            </ul>

                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <!-- Changed to a logout icon for clarity -->
                                <p>
                                    Logout
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('logout')}}" class="nav-link"
                                        onclick="return confirm('Do you want to Log Out?')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Confirm Logout</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </nav>

            </div>

        </aside>

        @yield('content')
        p
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="https://adminlte.io/">Super Admin</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>


    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script>
        function toggleDropdown() {
    const optionsContainer = document.getElementById('options-container');
    const selectBox = document.querySelector('.select-box');

    if (optionsContainer.style.display === 'block') {
    optionsContainer.style.display = 'none';
    selectBox.classList.remove('active');
    } else {
    optionsContainer.style.display = 'block';
    selectBox.classList.add('active');
    }
    }

    function updateSelected() {
    const selectedNames = [];
    const checkboxes = document.querySelectorAll('.options-container input[type="checkbox"]:checked');

    checkboxes.forEach((checkbox) => {
    const label = checkbox.parentElement; // Get the parent label element
    selectedNames.push(label.textContent.trim()); // Get the label text (role name)
    });

    document.getElementById('selected-options').value = selectedNames.join(', ');
    }
// Auto-populate selected roles when updating
document.addEventListener('DOMContentLoaded', function () {
updateSelected();
});
    window.onclick = function (event) {
    const optionsContainer = document.getElementById('options-container');
    const selectBox = document.querySelector('.select-box');

    if (!selectBox.contains(event.target)) {
    optionsContainer.style.display = 'none';
    selectBox.classList.remove('active');
    }
    }
    function toggleDropdown() {
    const container = document.getElementById('options-container');
    container.style.display = container.style.display === 'block' ? 'none' : 'block';
    }

    function updateSelected() {
    const checkboxes = document.querySelectorAll('#options-container input[type="checkbox"]');
    const selectedOptions = [];
    checkboxes.forEach(checkbox => {
    if (checkbox.checked) {
    selectedOptions.push(checkbox.nextSibling.textContent.trim());
    }
    });
    document.getElementById('selected-options').value = selectedOptions.join(', ');
    }

    </script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="plugins/chart.js/Chart.min.js"></script>

    <script src="plugins/sparklines/sparkline.js"></script>

    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>

    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="{{ asset('js/geolocation.js') }}" defer></script> <!-- Adjust the path as needed -->
    <script>
        // geolocation.js

    function successCallback(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;
    console.log("Latitude: " + latitude + ", Longitude: " + longitude);

    // You can send this data to your Laravel backend via an AJAX request or store it in a hidden input field
    }

    function errorCallback(error) {
    switch(error.code) {
    case error.PERMISSION_DENIED:
    console.error("User denied the request for Geolocation.");
    break;
    case error.POSITION_UNAVAILABLE:
    console.error("Location information is unavailable.");
    break;
    case error.TIMEOUT:
    console.error("The request to get user location timed out.");
    break;
    case error.UNKNOWN_ERROR:
    console.error("An unknown error occurred.");
    break;
    }
    }

    // Call the geolocation function
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    } else {
    console.error("Geolocation is not supported by this browser.");
    }
    </script>
    <script src="plugins/summernote/summernote-bs4.min.js"></script>

    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="dist/js/adminlte2167.js?v=3.2.0"></script>

    <script src="dist/js/demo.js"></script>

    <script src="dist/js/pages/dashboard.js"></script>
    <input type="hidden" id="geolocation" name="geolocation">
    <script>
        function successCallback(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;

    // Send the data to your Laravel backend
    fetch('/your-backend-route', {
    method: 'POST',
    headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Ensure CSRF token is
    included
    },
    body: JSON.stringify({ latitude, longitude }),
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
    }
    </script>
    <script>
        function getGeolocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('geolocation').value = position.coords.latitude + ',' + position.coords.longitude;
            });
        }
    }

    window.onload = function() {
        getGeolocation();
    };
    </script>
    {{-- Icon Usage --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @yield('customJs')
</body>


</html>