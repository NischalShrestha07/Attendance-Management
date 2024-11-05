@extends('layouts.superLayout')

@section('content')

<!-- Modal -->
<div class="modal fade" id="createPermissionModal" tabindex="-1" role="dialog"
    aria-labelledby="createPermissionModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="createPermissionForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Permission</label>
                        <input type="text " class="form-control" name="permission " placeholder="Permission" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Permissions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Permissions</li>
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
                                <h2 class="ml-2 menu-title"> Permissions</h2>

                                <div class="navbar d-flex justify-content-end">
                                    <button type="button" data-toggle="modal" class="btn btn-success"
                                        data-target="#addNewPermission">Create Permission</button>
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


                            <div class="modal" id="addNewPermission">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header btn-primary">
                                            <h4 class="modal-title">Add New Permissions</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>



                                        <div class="modal-body">
                                            <form action="{{ url('addNewPermission') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="name">Permission:</label>
                                                    <input type="text" id="name" name="name" placeholder="Permission:"
                                                        class="form-control mb-2">
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
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $x=0;
                                        @endphp
                                        @foreach ($permissions as $item)
                                        <tr>
                                            <td>{{++$x}}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>

                                                <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                    data-target="#updateModel{{ $item->id }}">
                                                    <i class="fas fa-edit fa-lg"></i>
                                                </button>


                                                <form action="{{ route('deletePermission', $item->id) }}" method="POST"
                                                    style="display:inline-block;"> @csrf
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
                                                            <h4 class="modal-title">Update Permission</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdatePermission') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden" name="id" value="{{ $item->id }}">

                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Role
                                                                    </label>
                                                                    <input type="text" class="form-control" id="name"
                                                                        name="name" value="{{ $item->name }}">
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