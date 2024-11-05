@extends('layouts.superLayout')

@section('content')

<!-- Modal -->
<div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="createRoleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="createRoleForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Role</label>
                        <input type="text " class="form-control" name="role " placeholder="Role" required>
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

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Roles</li>
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
                                <h2 class="ml-2 menu-title"> Roles</h2>
                                {{-- <div>
                                    @if (@session('success'))
                                    <div class="alert alert-success bg-success h3 text-white rounded">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    @if (@session('error'))
                                    <div class="alert alert-danger bg-danger h3 text-white rounded">
                                        {{ session('error') }}
                                    </div>
                                    @endif
                                </div> --}}
                                <div class="navbar d-flex justify-content-end">
                                    <button type="button" data-toggle="modal" class="btn btn-success"
                                        data-target="#addNewRole">Create Role</button>
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
                            <div class="modal" id="addNewRole">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header btn-primary">
                                            <h4 class="modal-title">Add New Roles</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>



                                        <div class="modal-body">
                                            <form action="{{ url('addNewRole') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="name">Role:</label>
                                                    <input type="text" id="name" name="name" placeholder="Role:"
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
                                            <th>ROLES</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $x=0;
                                        @endphp
                                        @foreach ($roles as $item)
                                        <tr>
                                            <td>{{++$x}}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if (strtolower($item->name != 'staff'))
                                                <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                    data-target="#updateModel{{ $item->id }}">
                                                    <i class="fas fa-edit fa-lg"></i>
                                                </button>


                                                <form action="{{ route('destroy.role', $item->id) }}" method="POST"
                                                    style="display:inline-block;"> @csrf
                                                    @method('DELETE')
                                                    <button data-id="{{$item->id}}" data-name="{{$item->name}}"
                                                        type="submit" class="btn btn-sm w-10" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                        <i class="fas fa-lg fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </td>

                                            <div class="modal" id="updateModel{{ $item->id }}">
                                                <div class="modal-dialog  modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header btn-primary">
                                                            <h4 class="modal-title">Update Role</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateRole') }}" method="POST"
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
                                    `
                                </table>
                            </div>

                            {{-- <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>CODE/SKU</th>
                                            <th>NAME</th>
                                            <th>CATEGORY</th>
                                            <th>TAX</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 0;
                                        @endphp
                                        @foreach ($varProducts as $item)
                                        @php
                                        $i++;
                                        @endphp
                                        <tr>

                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category }}</td>
                                            <td>{{ $item->tax }}% VAT</td>


                                            <td class="font-weight-medium">
                                                <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                    data-target="#updateModel{{ $i }}">
                                                    <i class="fas fa-edit fa-lg"></i>
                                                </button>

                                                <button type="button" class="btn" title="View" data-toggle="modal"
                                                    data-target="#viewModel{{ $item->id }}">
                                                    <i class="fas fa-eye fa-lg"></i>
                                                </button>

                                                <div class="modal fade" id="viewModel{{ $item->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="viewModelLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title"
                                                                    id="viewModelLabel{{ $item->id }}">
                                                                    Varient Product Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card">
                                                                    <div class="card-header bg-dark text-white">
                                                                        <h5 class="card-title mb-0">Product Information
                                                                        </h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <h6><strong>Code/SKU:</strong></h6>
                                                                                <p>{{ $item->code }}</p>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h6><strong>Product Name:</strong></h6>
                                                                                <p>{{ $item->name }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <h6><strong>Category Name:</strong></h6>
                                                                                <p>{{ $item->category }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h6><strong>Tax:</strong></h6>
                                                                                <p>{{ $item->tax }}% VAT
                                                                                </p>
                                                                            </div>


                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <h6><strong>Selling Price:</strong></h6>
                                                                                <p>{{ $item->selling_price }}</p>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h6><strong>Purchase Price:</strong>
                                                                                </h6>
                                                                                <p>{{ $item->purchase_price }}</p>
                                                                            </div>

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="modal" id="updateModel{{ $i }}" tabindex="-1">
                                                    <div class="dialog" aria-labelledby="updateModelLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-primary text-white">
                                                                    <h4 class="modal-title" id="updateModelLabel">Update
                                                                        Varient Product</h4>
                                                                    <button type="button" class="close text-white"
                                                                        data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ url('UpdateVarProduct') }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')


                                                                        <label for="code">Code/Sku:</label>
                                                                        <input type="text" id="code" name="code"
                                                                            disabled value="{{ $item->code }}"
                                                                            placeholder="Enter Code/Sku:"
                                                                            class="form-control mb-2">


                                                                        <label for="name">Product Name:</label>
                                                                        <input type="text" id="name" name="name"
                                                                            value="{{ $item->name }}"
                                                                            placeholder="Enter Product Name:"
                                                                            class="form-control mb-2">







                                                                        <label for="tax">Tax:</label>
                                                                        <input type="text" id="tax" name="tax"
                                                                            value="{{ $item->tax }}" placeholder="Tax"
                                                                            class="form-control mb-2">




                                                                        <input type="hidden" name="id"
                                                                            value="{{ $item->id }}">
                                                                        <input type="submit" name="save"
                                                                            class="btn btn-success"
                                                                            value="Save Changes" />
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form action="" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm w-10" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                        <i class="fas fa-lg fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div> --}}

                        </div>

                    </div>

                </div>

            </div>

        </section>

</div>
@endsection