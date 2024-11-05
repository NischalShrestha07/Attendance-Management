@extends('layouts.staffLayout')
@section('content')
<style>
    .small-box {
        position: relative;
        display: flex;
        justify-content: space-between;
        padding: 20px;
        color: #fff;
        border-radius: 8px;
        transition: transform 0.2s;
        min-height: 150px;
        /* Standardize box height */
    }

    .small-box .inner h3,
    .small-box .inner h4 {
        font-weight: bold;
    }

    .small-box:hover {
        transform: scale(1.05);
    }

    .small-box-footer {
        color: rgba(255, 255, 255, 0.8);
        font-weight: bold;
    }

    .small-box-footer:hover {
        color: #fff;
        text-decoration: none;
    }

    .row {
        margin-bottom: 20px;
    }

    .mt-4 {
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .small-box {
            min-height: 180px;
            /* Adjust for mobile */
        }
    }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Welcome {{Auth::user()->name}}!</b></h1>
                    <h1 class="m-0"><b>Dashboard/Staff</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('staffDashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Staff</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">

            <!-- Additional Boxes Row -->
            <div class="row mt-4">
                <!-- Total Hours Worked -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h4>Total Hours Worked</h4>
                            <p>120 Hours</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>

                <!-- Tasks Completed -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h4>Tasks Completed</h4>
                            <p>32</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>

                <!-- Attendance Percentage -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4>Attendance</h4>
                            <p>95% This Month</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection