@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Attendance List</h1>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Change the route here to employee.index -->
        <a href="{{ route('employee.index') }}" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr class="bg-light">
                        <td>{{ $attendance->employee->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                        <td>
                            <span class="badge 
                            bg-{{ $attendance->status == 'present' ? 'success' : 'danger' }} 
                            text-white p-2 rounded-3">
                                @if($attendance->status == 'present')
                                    <i class="bi bi-check-circle-fill"></i> Present
                                @else
                                    <i class="bi bi-x-circle-fill"></i> Absent
                                @endif
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
