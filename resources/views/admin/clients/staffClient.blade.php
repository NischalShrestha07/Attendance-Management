@extends('layouts.staffLayout')

@section('customCss')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Client </h1>
                    <p>Dashboard/Client</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">client</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="navbar p-3 ">
                            <h2 class="ml-2">Client</h2>
                            {{-- <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#addClientModal">Add New Client</button> --}}
                        </div>

                        <div class="card-body">
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

                            <!-- Add Client Modal -->
                            <div class="modal fade" id="addClientModal" tabindex="-1" role="dialog"
                                aria-labelledby="addClientModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h4 class="modal-title" id="addClientModalLabel">Add New Client</h4>
                                            <button type="button" class="close text-white" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>


                                        <div class="modal-body">
                                            <form action="{{ url('AddNewClient') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="photo" class="font-weight-bold">Client Photo:</label>
                                                    <input type="file" id="photo" name="photo"
                                                        placeholder=" Client Photo" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fullname" class="font-weight-bold">Full Name:</label>
                                                    <input type="text" id="fullname" name="fullname"
                                                        placeholder="Enter Client Name" class="form-control" required>
                                                </div>


                                                <div class="form-group">
                                                    <label for="phone" class="font-weight-bold">Phone No:</label>
                                                    <input type="tel" id="phone" name="phone"
                                                        placeholder="Enter Phone Number" class="form-control" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="font-weight-bold">Email Address:</label>
                                                    <input type="email" id="email" name="email"
                                                        placeholder="Enter Email Address" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="address" class="font-weight-bold">address:</label>
                                                    <input type="date" id="address" name="address" placeholder="Address"
                                                        class="form-control datepicker">
                                                </div>



                                                <div class="form-group">
                                                    <label for="companyName" class="font-weight-bold">Company
                                                        Name:</label>
                                                    <input type="text" id="companyName" name="companyName"
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
                                                    <label for="status" class="font-weight-bold">Employee
                                                        Status:</label>
                                                    <select id="status" name="status" class="form-control" required>
                                                        <option value="" disabled selected> Employee Status
                                                        </option>
                                                        <option value="Active"> <i class="fas fa-check-circle"></i>
                                                            Active</option>
                                                        <option value="Inactive"> <i class="fas fa-times-circle"></i>
                                                            Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="notes" class="font-weight-bold">Notes:</label>
                                                    <input type="textarea" id="notes" name="notes" placeholder="Notes"
                                                        class="form-control datepicker">
                                                </div>

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


                            <table id="EmployeeTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Full Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Company Name</th>
                                        <th>Department</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Notes</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $item)
                                    <tr>
                                        {{-- <td>{{ $item->image }}</td> --}}
                                        <td>
                                            <img class="img-fluid rounded-circle" src="/storage/{{ $item->photo }}"
                                                width="40px" alt="Client Photo">
                                        </td>
                                        <td>{{ $item->fullname }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->email}}</td>
                                        <td>{{ $item->companyName }}</td>
                                        <td>{{ $item->department }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->notes }}</td>
                                        <td class="font-weight-medium">
                                            {{-- <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                data-target="#updateModel{{ $item->id }}">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button> --}}



                                            <!-- View Button -->
                                            <button type="button" class="btn" title="View" data-toggle="modal"
                                                data-target="#viewModel{{ $item->id }}">
                                                <i class="fas fa-eye fa-lg"></i>
                                            </button>

                                            <!-- View Modal -->
                                            <div class="modal fade" id="viewModel{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="viewModelLabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="viewModelLabel{{ $item->id }}">
                                                                Client Details</h5>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Enhanced client Details Card -->
                                                            <div class="card">
                                                                <div class="card-header bg-dark text-white">
                                                                    <h5 class="card-title mb-0">Client's Information
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <!-- client's Image -->
                                                                        <div class="col-md-4 text-center">
                                                                            <img src="{{ asset('storage/' . $item->photo) }}"
                                                                                width="100px" alt="{{ $item->name }}"
                                                                                class="img-fluid rounded shadow"
                                                                                style="max-height: 250px; width: auto;">
                                                                        </div>
                                                                        <!-- client's Details -->
                                                                        <div class="col-md-8">
                                                                            <div class="row mb-3">
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Full Name:</strong></h6>
                                                                                    <p>{{ $item->fullname }}</p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Phone Number:</strong>
                                                                                    </h6>
                                                                                    <p>{{ $item->phone }}</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Email Address:</strong>
                                                                                    </h6>
                                                                                    <p>{{ $item->email }}</p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Company Name:</strong>
                                                                                    </h6>
                                                                                    <p>{{ $item->companyName }}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Department:</strong>
                                                                                    </h6>
                                                                                    <p>{{ $item->department }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Address:</strong>
                                                                                    </h6>
                                                                                    <p>{{ $item->address}}</p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Status:</strong>
                                                                                    </h6>
                                                                                    <p>{{ $item->status}}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Notes:</strong>
                                                                                    </h6>
                                                                                    <p>{{ $item->notes}}
                                                                                    </p>
                                                                                </div>



                                                                            </div>
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

                                            <div class="modal" id="updateModel{{ $item->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header btn-primary">
                                                            <h4 class="modal-title"><b>Update Client</b></h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateClient') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')


                                                                <div class="mb-3">
                                                                    <label for="fullname" class="form-label">Client's
                                                                        Full Name:</label>
                                                                    <input type="text" id="fullname" name="fullname"
                                                                        value="{{$item->fullname}}"
                                                                        placeholder="Enter Client's Name:"
                                                                        class="form-control mb-2">

                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="phone">Phone No:</label>
                                                                    <input type="tel" id="phone" name="phone"
                                                                        value="{{ $item->phone }}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="email" class="font-weight-bold">Email
                                                                        Address:</label>
                                                                    <input type="email" id="email" name="email"
                                                                        value="{{$item->email}}" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="companyName"
                                                                        class="font-weight-bold">Company Name
                                                                        Address:</label>
                                                                    <input type="text" id="companyName"
                                                                        name="companyName"
                                                                        value="{{$item->companyName}}"
                                                                        placeholder="Enter Company Name:"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="department"
                                                                        class="font-weight-bold">Department:</label>
                                                                    <input type="text" id="department" name="department"
                                                                        value="{{$item->department}}"
                                                                        placeholder="Department:" class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="address"
                                                                        class="font-weight-bold">Address:</label>
                                                                    <input type="text" id="address" name="address"
                                                                        value="{{$item->address}}"
                                                                        placeholder="Address:" class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="status" class="font-weight-bold">
                                                                        Status:</label>
                                                                    <select id="status" name="status"
                                                                        class="form-control" required>
                                                                        <option disabled> Client Status</option>
                                                                        <option value="Active" {{ $item->status
                                                                            == 'Active' ? 'selected' : '' }}>Active
                                                                        </option>
                                                                        <option value="Inactive" {{ $item->status
                                                                            == 'Inactive' ? 'selected' : '' }}>Inactive
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="notes"
                                                                        class="font-weight-bold">Notes:</label>
                                                                    <input type="textarea" id="notes" name="notes"
                                                                        value="{{$item->notes}}" placeholder="Notes:"
                                                                        class="form-control">
                                                                </div>



                                                                <div class="form-group">
                                                                    <label for="photo"
                                                                        class="font-weight-bold">Photo:</label>
                                                                    <input type="file" id="photo"
                                                                        value="{{$item->photo}}" name="photo"
                                                                        class="form-control">
                                                                </div>

                                                                <input type="hidden" name="id" value="{{ $item->id }}">

                                                                <div class="d-grid">
                                                                    <button type="submit" name="save"
                                                                        class="btn btn-success" value="Save Changes"><i
                                                                            class="fas fa-save"></i>
                                                                        Save Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{route('client.destroy',$item->id)}}" method="POST"
                                                style="display:inline-block;"> @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm w-10" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this?')">
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

@section('customJs')
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(function() {
        $("#EmployeeTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#EmployeeTable_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection