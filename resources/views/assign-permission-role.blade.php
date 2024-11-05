@extends('layouts.superLayout')
@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Assign Permission To Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Assign Permission To Roles</li>
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
                                <h2 class="ml-2 menu-title"> Assign Permission To Role</h2>

                                <div class="navbar d-flex justify-content-end">
                                    <button type="button" data-toggle="modal" class="btn btn-success"
                                        data-target="#assignPermissionRole">Create Permission Role</button>
                                </div>
                            </div>
                            {{-- sessions --}}
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
                            <div class="modal" id="assignPermissionRole">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header btn-primary">
                                            <h4 class="modal-title">Assign Permission To Role</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>



                                        <div class="modal-body">
                                            <form action="{{ url('createPermissionRole') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="">Permission</label>
                                                    <select name="permission_id" id="" class="form-control" required>
                                                        <option value="">Select Permission</option>
                                                        @foreach ($permissions as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Role</label>
                                                    <select name="role_id" id="" class="form-control" required>
                                                        <option value="">Select Role</option>
                                                        @foreach ($roles as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>



                                                <input type="submit" name="save" class="btn btn-success"
                                                    value="Save Changes" m-5 />
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
                                            <th>Permissions</th>
                                            <th>Roles</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $x=0;
                                        @endphp
                                        @foreach ($permissionWithRoles as $item)
                                        <tr>
                                            <td>{{++$x}}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @foreach ($item->roles as $role)
                                                {{ $role->name }}
                                                <br>
                                                @endforeach

                                            </td>
                                            <td>
                                                {{-- @if (strtolower($item->name != 'staff')) --}}
                                                <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                    data-target="#updateModel{{ $item->id }}">
                                                    <i class="fas fa-edit fa-lg"></i>
                                                </button>

                                                <form action="{{ route('destroy.assign', $item->id) }}" method="POST"
                                                    style="display:inline-block;"> @csrf
                                                    @method('DELETE')
                                                    <button data-id="{{$item->id}}" data-name="{{$item->name}}"
                                                        type="submit" class="btn btn-sm w-10" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                        <i class="fas fa-lg fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                {{-- @endif --}}
                                            </td>



                                            {{-- <div class="modal" id="updateModel{{ $item->id }}">
                                                <div class="modal-dialog  modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header btn-primary">
                                                            <h4 class="modal-title">Update Assign To Role</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdatePermissionRole') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden" name="id" value="{{ $item->id }}">

                                                                <div class="form-group">
                                                                    <label for="">Permission</label>
                                                                    <select name="permission_id" id="permission_id"
                                                                        class="form-control" required>
                                                                        <option value="">Select Permission</option>
                                                                        @foreach ($permissions as $item)
                                                                        <option value="{{$item->id}}">{{$item->name}}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">Role</label>
                                                                    <div class="multi-select-dropdown">
                                                                        <div class="select-box"
                                                                            onclick="toggleDropdown()">
                                                                            <input type="text" name=""
                                                                                id="selected-options"
                                                                                placeholder="Select Options" readonly>
                                                                            <div class="arrow"></div>
                                                                        </div>
                                                                        <div class="options-container"
                                                                            id="options-container">
                                                                            @foreach ($roles as $item)
                                                                            <label>
                                                                                <input type="checkbox"
                                                                                    value="{{ $item->id }}"
                                                                                    onchange="updateSelected()" {{
                                                                                    in_array($item->id)
                                                                                ?
                                                                                'checked' : '' }}>
                                                                                {{ $item->name }}
                                                                            </label>

                                                                            @endforeach

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                        </div>

                                                        <div class="d-grid">
                                                            <button type="submit" name="save" class="btn btn-success"
                                                                value="Save Changes"><i class="fas fa-save"></i>
                                                                Save Changes </button>

                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="modal fade" id="updateModel{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h4 class="modal-title" id="updateModalLabel">Update Assign
                                                                To Role</h4>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdatePermissionRole') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden" name="id" value="{{ $item->id }}">

                                                                <!-- Permission Selection -->
                                                                <div class="form-group">
                                                                    <label for="permission_id"
                                                                        class="font-weight-bold">Permission</label>
                                                                    <select name="permission_id" id="permission_id"
                                                                        class="form-control" required>
                                                                        <option value="" disabled selected>Select
                                                                            Permission</option>
                                                                        @foreach ($permissions as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name
                                                                            }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <!-- Role Multi-select Dropdown -->
                                                                <div class="form-group">
                                                                    <label for="roles"
                                                                        class="font-weight-bold">Role</label>
                                                                    <div class="multi-select-dropdown">
                                                                        <div class="select-box"
                                                                            onclick="toggleDropdown()">
                                                                            <input type="text" id="selected-options"
                                                                                placeholder="Select Options" readonly
                                                                                class="form-control">
                                                                            <div class="arrow"></div>
                                                                        </div>
                                                                        <div class="options-container"
                                                                            id="options-container">
                                                                            @foreach ($roles as $item)
                                                                            <label class="d-block">

                                                                                {{-- here i am getting errors --}}
                                                                                {{-- <input type="checkbox"
                                                                                    name="role_ids[]"
                                                                                    value="{{ $item->id }}"
                                                                                    onchange="updateSelected()" {{
                                                                                    in_array($item->id, $selectedRoles)
                                                                                ? 'checked' :
                                                                                '' }}> --}}
                                                                                {{ $item->name }}
                                                                            </label>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Save Changes Button -->
                                                                <div class="d-grid">
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-block">
                                                                        <i class="fas fa-save"></i> Save Changes
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{--
                                <div class="modal fade" id="updateModel{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="updateModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h4 class="modal-title" id="updateModalLabel">Update Assign
                                                    To Role</h4>
                                                <button type="button" class="close text-white" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">


                                                <input type="hidden" name="permission_id" id="permission_id">
                                                <p>Are </p>



                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>


                        </div>

                    </div>

                </div>

            </div>

</div>

</section>

</div>
@endsection