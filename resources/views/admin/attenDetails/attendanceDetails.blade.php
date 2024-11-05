<!-- resources/views/admin/attendance_details/index.blade.php -->

@extends('layouts.superLayout')

@section('content')
<h1>Attendance Details</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Geo Attendance ID</th>
            <th>Recorded Time</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Location Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attendanceDetails as $detail)
        <tr>
            <td>{{ $detail->id }}</td>
            <td>{{ $detail->geo_attendance_id }}</td>
            <td>{{ $detail->recorded_time }}</td>
            <td>{{ $detail->latitude }}</td>
            <td>{{ $detail->longitude }}</td>
            <td>{{ $detail->location_name }}</td>
            <td>
                <!-- Add action buttons for edit/delete here -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection