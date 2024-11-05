@extends('layouts.superLayout')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Assign Permission Route</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Assign Permissions</li>
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
                                <h2 class="ml-2 menu-title"> Permissions Routes</h2>

                                <div class="navbar d-flex justify-content-end">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#assignPermissionRoute">
                                        Asign Permission To Route
                                    </button>
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

                            <div class="modal" id="assignPermissionRoute">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header btn-primary">
                                            <h4 class="modal-title">Assign Permission To Route</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>



                                        <div class="modal-body">
                                            <form action="{{ url('create-permission-route') }}" method="POST"
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
                                                    <label for="">Route</label>
                                                    <select name="route" id="" class="form-control" required>
                                                        <option value="">Select Route</option>
                                                        @foreach ($routeDetails as $route)
                                                        <option value="{{$route['name']}}">{{$route['name']}}</option>

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
                                            <th>PERMISSION</th>
                                            <th>Route Name</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $x=0;
                                        @endphp
                                        @foreach ($routerPermission as $item)
                                        <tr>
                                            <td>{{++$x}}</td>
                                            <td>{{ $item->permission->name }}</td>
                                            <td>{{$item->router}}</td>

                                            <td>

                                                <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                    data-target="#updateModel{{ $item->id }}">
                                                    <i class="fas fa-edit fa-lg"></i>
                                                </button>


                                                <form action="{{ route('deletePermissionRoute', $item->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button data-id="{{$item->id}}" data-name="{{$item->name}}"
                                                        type="submit" class="btn btn-sm w-10" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this item?\n If you delete this permission, then this permission is deletd from all users.')">
                                                        <i class="fas fa-lg fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>



                                            <div class="modal" id="updateModel{{ $item->id }}">
                                                <div class="modal-dialog  modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header btn-primary">
                                                            <h4 class="modal-title">Update Permission To Route</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdatePermissionRoute') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden" name="id" value="{{ $item->id }}">

                                                                <div class="form-group">
                                                                    <label for="">Permission</label>
                                                                    <select name="permission_id" id=""
                                                                        class="form-control" required>
                                                                        {{-- <option value="">Select Permission</option>
                                                                        --}}
                                                                        @foreach ($permissions as $item)
                                                                        <option value="{{$item->id}}">{{$item->name}}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">Route</label>

                                                                    {{-- ARRAY TO STRING DROPDOWNS --}}
                                                                    <select name="route" id="" class="form-control"
                                                                        required>
                                                                        <option value="">Select Option</option>
                                                                        @foreach ($routeDetails as $route)
                                                                        <option value="{{$route['name']}}"
                                                                            {{$route['name']==old('router',$item->
                                                                            router) ? 'selected':''}}>
                                                                            {{$route['name']}}</option>
                                                                        {{-- {{ dd($item->router) }} --}}
                                                                        @endforeach

                                                                        {{-- also gives the old data --}}
                                                                        {{-- @foreach ($routeDetails as $route)
                                                                        <option value="{{$route->router}}" {{$route->
                                                                            router==$item->router?'selected':''}}>
                                                                            {{$route->router}}</option>
                                                                        @endforeach --}}


                                                                    </select>
                                                                </div>

                                                                <div class="d-grid">
                                                                    <button type="submit" name="save"
                                                                        class="btn btn-success" value="Save Changes"><i
                                                                            class="fas fa-save"></i>
                                                                        Save Changes </button>

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
                            </div>



                        </div>

                    </div>

                </div>

            </div>

        </section>

</div>





@endsection