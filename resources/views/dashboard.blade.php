@extends('layouts.superLayout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Welcome {{Auth::user()->name}}!</b></h1>
                    <h1 class="m-0">Dashboard/Super Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Super Admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Total Users -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>1,200</h3>
                            <p>Total Users</p>
                            <small>Active across the system</small>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">Manage Users <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Projects -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>320</h3>
                            <p>Projects Ongoing</p>
                            <small>Across all departments</small>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <a href="#" class="small-box-footer">View Projects <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>$350K</h3>
                            <p>Total Revenue</p>
                            <small>Generated this quarter</small>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <a href="#" class="small-box-footer">Financial Reports <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- System Health -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>99.9%</h3>
                            <p>System Uptime</p>
                            <small>Last 30 days</small>
                        </div>
                        <div class="icon">
                            <i class="fas fa-server"></i>
                        </div>
                        <a href="#" class="small-box-footer">System Monitoring <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Additional Features Row -->
            <div class="row mt-4">
                <!-- Role Management -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h4>Role Management</h4>
                            <p>Manage Roles & Permissions</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <a href="#" class="small-box-footer">Manage Roles <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Admins Activity -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h4>Admin Activity</h4>
                            <p>Track actions of all admins</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a href="#" class="small-box-footer">View Logs <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Support Tickets -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h4>Support Tickets</h4>
                            <p>120 Open Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <a href="#" class="small-box-footer">Manage Tickets <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>


        </div>
    </section>

</div>
@endsection