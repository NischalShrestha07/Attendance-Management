@extends('layouts.superLayout')

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
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#addLeaveModal">Add New Leave Request</button>
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
                                                    <label for="leaveType" class="font-weight-bold">Leave Type:</label>
                                                    <select id="leaveType" name="leaveType" class="form-control"
                                                        required>
                                                        <option value="" disabled selected>Select leave type</option>
                                                        <option value="Sick Leave">Sick Leave</option>
                                                        <option value="Casual Leave">Casual Leave</option>
                                                        <option value="Vacation Leave">Vacation Leave</option>
                                                        <option value="Unpaid Leave">Unpaid Leave</option>
                                                    </select>
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
                                            <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                data-target="#updateModel{{ $item->id }}">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>
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
                                                                    <h5 class="card-title mb-0">Leave's Information
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <!-- client's Image -->
                                                                        <div class="col-md-4 text-center">
                                                                            <img src="{{ asset('storage/' . $item->photo) }}"
                                                                                alt="{{ $item->name }}"
                                                                                class="img-fluid rounded shadow"
                                                                                style="max-height: 250px; margin-top: 30px; width: 400px;">
                                                                        </div>
                                                                        <!-- client's Details -->
                                                                        <div class="col-md-8">
                                                                            <div class="row mb-3">
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>Full Name:</strong></h6>
                                                                                    <p>{{ $item->employeeName }}</p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>leave Type:</strong>
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
                                                                                    <p>{{ $item->to}}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div class="col-md-6">
                                                                                    <h6><strong>No of Days:</strong>
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

                                            <div class="modal fade" id="updateModel{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="updateModelLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="updateModelLabel"><i
                                                                    class="fas fa-edit"></i> Update Leave</h5>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateLeave') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <!-- Photo upload section -->
                                                                <div class="form-row">
                                                                    <div class="col-md-12 text-center mb-3">
                                                                        @if($item->photo)
                                                                        <img src="{{ asset('storage/'.$item->photo) }}"
                                                                            alt="Current Photo" class="img-thumbnail"
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

                                                                <!-- Employee Details Section -->
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="employeeName"
                                                                            class="font-weight-bold">Employee
                                                                            Name:</label>
                                                                        <input type="text" id="employeeName"
                                                                            name="employeeName" class="form-control"
                                                                            value="{{$item->employeeName}}" required>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="leaveType"
                                                                            class="font-weight-bold">Leave Type:</label>
                                                                        <select class="form-control" name="leaveType"
                                                                            id="leaveType">
                                                                            <option value="">Select Leave Type</option>
                                                                            <option value="Sick Leave" {{$item->
                                                                                leaveType=='Sick Leave' ? 'selected' :
                                                                                ''}}>Sick Leave</option>
                                                                            <option value="Casual Leave" {{$item->
                                                                                leaveType=='Casual Leave' ? 'selected' :
                                                                                ''}}>Casual Leave</option>
                                                                            <option value="Vacation Leave" {{$item->
                                                                                leaveType=='Vacation Leave' ? 'selected'
                                                                                :
                                                                                ''}}>Vacation Leave</option>
                                                                            <option value="Unpaid Leave" {{$item->
                                                                                leaveType=='Unpaid Leave' ? 'selected'
                                                                                :
                                                                                ''}}>Unpaid Leave</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- Leave Date Range Section -->
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="from" class="font-weight-bold">From
                                                                            Date:</label>
                                                                        <input type="date" id="from" name="from"
                                                                            class="form-control" value="{{$item->from}}"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="to" class="font-weight-bold">To
                                                                            Date:</label>
                                                                        <input type="date" id="to" name="to"
                                                                            class="form-control" value="{{$item->to}}"
                                                                            required>
                                                                    </div>
                                                                </div>

                                                                <!-- Additional Info Section -->
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="days"
                                                                            class="font-weight-bold">Days:</label>
                                                                        <input type="number" id="days" name="days"
                                                                            class="form-control" value="{{$item->days}}"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="status"
                                                                            class="font-weight-bold">Status:</label>
                                                                        <input class="form-control"
                                                                            value="{{$item->status}}" type="text"
                                                                            id="status" name="status" required>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="reason"
                                                                            class="font-weight-bold">Reason:</label>
                                                                        <input type="text" id="reason" name="reason"
                                                                            class="form-control"
                                                                            value="{{$item->reason}}">
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="id" value="{{ $item->id }}">

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


                                            <form action="{{route('leave.destroy',$item->id)}}" method="POST"
                                                style="display:inline-block;"> @csrf
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