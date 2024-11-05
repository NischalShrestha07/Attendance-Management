@extends('layouts.superLayout')

@section('content')
<div class="container mt-4">
    <h2>Attendance Records</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Date</th>
                <th>Login Time</th>
                <th>Status</th>
                <th>Geolocation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->employee->name }}</td>
                <td>{{ $attendance->date }}</td>
                <td>{{ $attendance->login_time }}</td>
                <td>{{ $attendance->status }}</td>
                <td>{{ $attendance->geolocation }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection