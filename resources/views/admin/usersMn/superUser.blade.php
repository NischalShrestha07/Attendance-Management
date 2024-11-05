@extends('layouts.superLayout')

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
                                <h2 class="ml-2 menu-title">User</h2>

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
                                                    <label for="name" class="font-weight-bold">Name:</label>
                                                    <input type="text" id="name" name="name"
                                                        placeholder="Enter User Name" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="username" class="font-weight-bold">Username:</label>
                                                    <input type="text" id="username" name="username"
                                                        placeholder="Enter Address" class="form-control" required>
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