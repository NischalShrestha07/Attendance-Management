@extends('layouts.adminLayout')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="menu-title navbar">
                                <h2 class="ml-2 menu-title"> User</h2>

                                <div class="navbar d-flex justify-content-end">
                                    <button type="button" data-toggle="modal" class="btn btn-success"
                                        data-target="#addNewUser">Create User</button>
                                </div>
                            </div>

                            <div>
                                @if (session('success'))
                                <div class="alert alert-success text-white bg-success alert-dismissible custom-alert fade-in"
                                    role="alert">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                                @if (session('error'))
                                <div class="alert alert-danger text-white bg-danger alert-dismissible custom-alert fade-in"
                                    role="alert">
                                    <strong>Error!</strong> {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                            </div>

                            <!-- Add User Modal -->
                            <div class="modal fade" id="addNewUser" tabindex="-1" role="dialog"
                                aria-labelledby="addUserModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h4 class="modal-title" id="addUserModalLabel">Add New User</h4>
                                            <button type="button" class="close text-white" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>


                                        <div class="modal-body">
                                            <form action="{{ url('addNewUser') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="photo" class="font-weight-bold">User Photo:</label>
                                                    <input type="file" id="photo" name="photo" placeholder=" User Photo"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="username" class="font-weight-bold">Name:</label>
                                                    <input type="text" id="username" name="username"
                                                        placeholder="Enter User Name" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="font-weight-bold">Address:</label>
                                                    <input type="text" id="name" name="name" placeholder="Enter Address"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group" style="display: none;">
                                                    <label for="userId" class="font-weight-bold">User
                                                        Id:</label>
                                                    <input type="text" id="userId" name="userId"
                                                        placeholder="Auto id user" class="form-control" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="mobile" class="font-weight-bold">Mobile No:</label>
                                                    <input type="tel" id="mobile" name="mobile"
                                                        placeholder="Enter Mobile Number" class="form-control" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="font-weight-bold">Email Address:</label>
                                                    <input type="email" id="email" name="email"
                                                        placeholder="Enter Email Address" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password" class="font-weight-bold">Password:</label>
                                                    <input type="password" id="password" name="password"
                                                        placeholder="Password " class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="joinDate" class="font-weight-bold">Join Date:</label>
                                                    <input type="date" id="joinDate" name="joinDate"
                                                        placeholder="Join Date" class="form-control datepicker">
                                                </div>

                                                <div class="form-group">
                                                    <label for="roleName" class="font-weight-bold">Role:</label>
                                                    <select id="roleName" name="roleName" class="form-control" required>
                                                        <option value="" disabled selected> Select Role</option>

                                                        @foreach ($roles as $item)
                                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label for="company" class="font-weight-bold">Company:</label>
                                                    <input type="text" id="company" name="company"
                                                        placeholder="Company Name" class="form-control ">
                                                </div>

                                                <div class="form-group">
                                                    <label for="department" class="font-weight-bold">Department:</label>
                                                    <select class="form-control" name="department" id="department">
                                                        <option value="">Select Department</option>
                                                        @foreach ($departments as $item)
                                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="designation"
                                                        class="font-weight-bold">Designation:</label>
                                                    <select class="form-control" name="designation" id="designation">
                                                        <option value="" selected>Select Designation</option>
                                                        @foreach ($designation as $item)
                                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="status" class="font-weight-bold">User
                                                        Status:</label>
                                                    <select id="status" name="status" class="form-control" required>
                                                        <option value="" disabled selected> User Status
                                                        </option>
                                                        <option value="Active"> </i>
                                                            Active</option>
                                                        <option value="Inactive">
                                                            Inactive</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="role_id" value="{{ $item->id }}">

                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fas fa-save"></i> Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>S.N</td>
                                            <th>Photo</th>
                                            <th>UserName</th>
                                            <th>Employee Id</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>RoleName</th>
                                            <th>Company</th>
                                            <th>Department</th>
                                            <th>Designation</th>
                                            <th>Join Date</th>
                                            <th>Status</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $x=0;
                                        @endphp
                                        @foreach ($users as $item)
                                        <tr>
                                            <td>{{++$x}}</td>
                                            <td>
                                                <img class="img-fluid rounded-circle" src="/storage/{{ $item->photo }}"
                                                    width="40px" alt="User Photo">
                                            </td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->employeeId }}</td>
                                            <td>{{ $item->mobile }}</td>
                                            <td>{{ $item->email}}</td>
                                            <td>{{ $item->roleName }}</td>
                                            <td>{{ $item->company }}</td>
                                            <td>{{ $item->department }}</td>
                                            <td>{{ $item->designation }}</td>
                                            <td>{{ $item->joinDate }}</td>
                                            <td>{{ $item->status }}</td>

                                            <td>
                                                <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                    data-target="#updateModel{{ $item->id }}">
                                                    <i class="fas fa-edit fa-lg"></i>
                                                </button>
                                                <div class="modal fade" id="updateModel{{ $item->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="updateModelLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title" id="updateModelLabel"><i
                                                                        class="fas fa-edit"></i> Update User</h5>
                                                                <button type="button" class="close text-white"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ url('UpdateAttendance') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')


                                                                    <div class="form-row">
                                                                        <div class="col-md-12 text-center mb-3">
                                                                            @if($item->photo)
                                                                            <img src="{{ asset('storage/'.$item->photo) }}"
                                                                                alt="Current Photo"
                                                                                class="img-thumbnail"
                                                                                style="max-width: 150px; max-height: 150px;">
                                                                            @else
                                                                            <p class="text-muted">No photo available</p>
                                                                            @endif
                                                                        </div>
                                                                        <div class="form-group col-md-12">
                                                                            <label for="photo"
                                                                                class="font-weight-bold">Upload New
                                                                                Photo:</label>
                                                                            <input type="file" id="photo" name="photo"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="name" class="form-label">
                                                                                Full Name:</label>
                                                                            <select class="form-control" name="name"
                                                                                id="name">
                                                                                <option value="">Select Employee
                                                                                </option>
                                                                                @foreach ($users as $user)
                                                                                <option value="{{$user->name}}"
                                                                                    selected>
                                                                                    {{$user->name}}
                                                                                </option>

                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="date">Date:</label>
                                                                            <input type="date" id="date" name="date"
                                                                                value="{{ $item->date }}"
                                                                                class="form-control mb-2">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="first_in"
                                                                                class="font-weight-bold">First
                                                                                In
                                                                                :</label>
                                                                            <input type="text" id="first_in"
                                                                                name="first_in"
                                                                                value="{{$item->first_in}}"
                                                                                class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="break"
                                                                                class="font-weight-bold">Break
                                                                                :</label>
                                                                            <input type="text" id="break" name="break"
                                                                                value="{{$item->break}}"
                                                                                class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="last_out"
                                                                                class="font-weight-bold">Last
                                                                                Out:
                                                                            </label>
                                                                            <input type="text" id="last_out"
                                                                                name="last_out"
                                                                                value="{{$item->last_out}}"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <!-- Additional Info Section -->
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                            <label for="total_hours"
                                                                                class="font-weight-bold">Total
                                                                                Hours:</label>
                                                                            <input type="text" id="total_hours"
                                                                                name="total_hours"
                                                                                value="{{$item->total_hours}}"
                                                                                class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="shift" class="font-weight-bold">
                                                                                Shift:</label>
                                                                            <select id="shift" name="shift"
                                                                                class="form-control" required>
                                                                                <option disabled>Select Shift</option>
                                                                                <option value="Day Shift" {{ $item->
                                                                                    shift
                                                                                    == 'Day Shift' ? 'selected' : ''
                                                                                    }}>Day
                                                                                    Shift
                                                                                </option>
                                                                                <option value="Night Shift" {{ $item->
                                                                                    shift
                                                                                    == 'Night Shift' ? 'selected' : ''
                                                                                    }}>Night
                                                                                    Shift
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="status"
                                                                                class="font-weight-bold">
                                                                                Status:</label>
                                                                            <select id="status" name="status"
                                                                                class="form-control" required>
                                                                                <option disabled> Status</option>
                                                                                <option value="Active" {{ $item->status
                                                                                    == 'Active' ? 'selected' : ''
                                                                                    }}>Active
                                                                                </option>
                                                                                <option value="Inactive" {{ $item->
                                                                                    status
                                                                                    == 'Inactive' ? 'selected' : ''
                                                                                    }}>Inactive
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="capacity"
                                                                                class="font-weight-bold">Capacity:</label>
                                                                            <input type="textarea" id="capacity"
                                                                                name="capacity"
                                                                                value="{{$item->capacity}}"
                                                                                placeholder="capacity:"
                                                                                class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="overtime"
                                                                                class="font-weight-bold">overtime:</label>
                                                                            <input type="textarea" id="overtime"
                                                                                name="overtime"
                                                                                value="{{$item->overtime}}"
                                                                                placeholder="overtime:"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <input type="hidden" name="id"
                                                                        value="{{ $item->id }}">

                                                                    <!-- Submit Button -->
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success">
                                                                            <i class="fas fa-save"></i> Save Changes
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form action="{{ route('delete.user', $item->id) }}" method="POST"
                                                    style="display:inline-block;"> @csrf
                                                    @method('DELETE')
                                                    <button data-id="{{$item->id}}" data-name="{{$item->name}}"
                                                        type="submit" class="btn btn-sm w-10" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                        <i class="fas fa-lg fa-trash-alt"></i>
                                                    </button>
                                                </form>

                                            </td>





                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
</div>

@endsection