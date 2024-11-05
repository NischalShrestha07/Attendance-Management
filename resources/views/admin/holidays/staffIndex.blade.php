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
                    <h1>Holiday </h1>
                    <p>Dashboard/Holiday</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Holiday</li>
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
                            <h2 class="ml-2">Holiday</h2>
                            {{-- <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#addHolidayModal">Add New Holiday</button> --}}
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

                            <!-- Add Holiday Modal -->
                            <div class="modal fade" id="addHolidayModal" tabindex="-1" role="dialog"
                                aria-labelledby="addHolidayModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h4 class="modal-title" id="addHolidayModalLabel">Add New Holiday</h4>
                                            <button type="button" class="close text-white" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>


                                        <div class="modal-body">
                                            <form action="{{ url('AddNewHoliday') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="title" class="font-weight-bold">Title:</label>
                                                    <input type="text" id="title" name="title"
                                                        placeholder="Holiday Title" class="form-control" required>
                                                </div>


                                                <div class="form-group">
                                                    <label for="type" class="font-weight-bold">Type:</label>
                                                    <input type="text" id="type" name="type" placeholder="Type"
                                                        class="form-control" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="startDate" class="font-weight-bold">Start Date:
                                                    </label>
                                                    <input type="date" id="startDate" name="startDate"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="endDate" class="font-weight-bold">End Date:
                                                    </label>
                                                    <input type="date" id="endDate" name="endDate" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="details" class="font-weight-bold">Details:</label>
                                                    <input type="text" id="details" name="details" placeholder="Details"
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


                            <table id="EmployeeTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Details</th>
                                        {{-- <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($holidays as $item)
                                    <tr>

                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->startDate }}</td>
                                        <td>{{ $item->endDate }}</td>
                                        <td>{{ $item->details }}</td>
                                        {{-- <td class="font-weight-medium">
                                            <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                data-target="#updateModel{{ $item->id }}">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>





                                            <div class="modal" id="updateModel{{ $item->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header btn-primary">
                                                            <h4 class="modal-title"><b>Update Holiday</b></h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateHoliday') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')


                                                                <div class="mb-3">
                                                                    <label for="title" class="form-label">Holiday's
                                                                        Title:</label>
                                                                    <input type="text" id="title" name="title"
                                                                        value="{{$item->title}}"
                                                                        placeholder=" Holiday's Title:"
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
                                            </div>

                                            <form action="{{route('holiday.destroy',$item->id)}}" method="POST"
                                                style="display:inline-block;"> @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm w-10" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                                    <i class="fas fa-lg fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td> --}}
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