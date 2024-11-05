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
                    <h1>Leaves </h1>
                    <p>Dashboard/Leaves</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Leave Requests</li>
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
                            <h2 class="ml-2">Leave Requests</h2>
                            {{-- <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#addLeaveModal">Add New Leave Request</button> --}}
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

                            <!-- Add Leave Modal -->
                            <div class="modal fade" id="addLeaveModal" tabindex="-1" role="dialog"
                                aria-labelledby="addLeaveModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h4 class="modal-title" id="addLeaveModalLabel">Add New Leave</h4>
                                            <button type="button" class="close text-white" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>


                                        <div class="modal-body">
                                            <form action="{{ url('AddNewLeave') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="photo" class="font-weight-bold">Photo:</label>
                                                    <input type="file" id="photo" name="photo" placeholder="Leave Photo"
                                                        class="form-control" required>
                                                </div>


                                                <div class="form-group">
                                                    <label for="employeeName" class="font-weight-bold">Employee
                                                        Name:</label>
                                                    <input type="text" id="employeeName" name="employeeName"
                                                        placeholder="employeeName" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="leaveType" class="font-weight-bold">Leave Type
                                                        :</label>
                                                    <input type="text" id="leaveType" name="leaveType"
                                                        placeholder="leaveType" class="form-control" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="from" class="font-weight-bold">From:
                                                    </label>
                                                    <input type="date" id="from" name="from" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="to" class="font-weight-bold">To:
                                                    </label>
                                                    <input type="date" id="to" name="to" class="form-control">
                                                </div>


                                                <div class="form-group">
                                                    <label for="days" class="font-weight-bold">Days:</label>
                                                    <input type="text" id="days" name="days" placeholder="Days"
                                                        class="form-control ">
                                                </div>
                                                <div class="form-group">
                                                    <label for="reason" class="font-weight-bold">Reason:</label>
                                                    <input type="text" id="reason" name="reason" placeholder="Reason"
                                                        class="form-control ">
                                                </div>
                                                <div class="form-group">
                                                    <label for="status" class="font-weight-bold">Status:</label>
                                                    <input type="text" id="status" name="status" placeholder="Status"
                                                        class="form-control ">
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


                            <table id="LeaveTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Employee Name</th>
                                        <th>Leave Type</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Days</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $item)
                                    <tr>
                                        <td>
                                            <img class="img-fluid rounded-circle" src="/storage/{{ $item->photo }}"
                                                width="40px" alt="Leave Request Photo">
                                        </td>
                                        <td>{{ $item->employeeName }}</td>
                                        <td>{{ $item->leaveType }}</td>
                                        <td>{{ $item->from }}</td>
                                        <td>{{ $item->to }}</td>
                                        <td>{{ $item->days }}</td>
                                        <td>{{ $item->reason }}</td>
                                        <td>{{ $item->status }}</td>
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
                                                                Leave Request Details</h5>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Enhanced client Details Card -->
                                                            <div class="card">
                                                                <div class="card-header bg-dark text-white">
                                                                    <h5 class="card-title mb-0">Leave Request
                                                                        Information
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <!-- client's Image -->
                                                                        <div class="col-md-4 text-center">
                                                                            <img src="{{ asset('storage/' . $item->photo) }}"
                                                                                alt="{{ $item->name }}"
                                                                                class="img-fluid rounded shadow"
                                                                                style="max-height: 250px; margin-top: 30px;  width: 400px;">
                                                                        </div>
                                                                        <!-- client's Details -->
                                                                        <div class="col-md-8">
                                                                            <div class="row mb-3">
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Full Name:</strong></h6>
                                                                                    <p>{{ $item->employeeName }}</p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Leave Type:</strong>
                                                                                    </h6>
                                                                                    <p>{{ $item->leaveType }}</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>From:</strong>
                                                                                    </h6>
                                                                                    <p>{{ $item->from }}</p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>To:</strong>
                                                                                    </h6>
                                                                                    <p>{{ $item->to }}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Days:</strong>
                                                                                    </h6>
                                                                                    <p>{{ $item->days }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Reason:</strong>
                                                                                    </h6>
                                                                                    <p>{{ $item->reason}}</p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Status:</strong>
                                                                                    </h6>
                                                                                    <p>{{ $item->status}}
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


                                            {{--
                                            <div class="modal" id="updateModel{{ $item->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header btn-primary">
                                                            <h4 class="modal-title"><b>Update Leave</b></h4>
                                                            <button type="
                                                            button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateLeave') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')


                                                                <div class="mb-3">
                                                                    <label for="title" class="form-label">Leave's
                                                                        Title:</label>
                                                                    <input type="text" id="title" name="title"
                                                                        value="{{$item->title}}"
                                                                        placeholder=" Leave's Title:"
                                                                        class="form-control mb-2">

                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="type">Type:</label>
                                                                    <input type="tel" id="type" name="type"
                                                                        value="{{ $item->type }}"
                                                                        class="form-control mb-2">
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="startDate"
                                                                        class="font-weight-bold">Start Date
                                                                    </label>
                                                                    <input type="date" id="startDate" name="startDate"
                                                                        value="{{$item->startDate}}"
                                                                        placeholder="Start Date" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="endDate" class="font-weight-bold">End
                                                                        Date
                                                                    </label>
                                                                    <input type="date" id="endDate" name="endDate"
                                                                        value="{{$item->endDate}}"
                                                                        placeholder="End Date" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="details"
                                                                        class="font-weight-bold">Details:
                                                                    </label>
                                                                    <input type="text" id="details" name="details"
                                                                        value="{{$item->details}}" placeholder="Details"
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
                                            </div> --}}

                                            {{-- <form action="{{route('leave.destroy',$item->id)}}" method="POST"
                                                style="display:inline-block;"> @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm w-10" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                                    <i class="fas fa-lg fa-trash-alt"></i>
                                                </button>
                                            </form> --}}
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
        $("#LeaveTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#LeaveTable_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection