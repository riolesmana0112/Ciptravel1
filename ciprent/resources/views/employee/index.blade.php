@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Employee List</h1>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('welcome') }}" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>

        <!-- Button Group: Driver, View Attendance, and Add New Employee -->
        <div class="d-flex gap-3">
            <!-- Driver Button -->
            <a href="{{ route('driver.index') }}" class="btn btn-secondary btn-lg">
                <i class="bi bi-car-front-fill"></i> Driver
            </a>
            
            <!-- View Attendance Button -->
            <a href="{{ route('attendance.index') }}" class="btn btn-info btn-lg">
                <i class="bi bi-check-circle-fill"></i> View Attendance
            </a>
            
            <!-- Add New Employee Button -->
            <a href="{{ route('employee.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-person-plus-fill"></i> Add New Employee
            </a>
        </div>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Birth Date</th>
                    <th>Position</th>
                    <th>Salary</th>
                    <th>Attendance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr class="bg-white">
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>{{ $employee->birth_date }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>Rp {{ number_format($employee->salary, 0, ',', '.') }}</td>
                        
                        <!-- Attendance Column -->
                        <td>
                            @php
                                $attendance = \App\Models\Attendance::where('employee_id', $employee->id)
                                    ->whereDate('date', now()->toDateString())
                                    ->first();
                            @endphp
                            @if ($attendance)
                                <span class="badge bg-{{ $attendance->status == 'present' ? 'success' : ($attendance->status == 'absent' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($attendance->status) }}
                                </span>
                            @else
                                <!-- Form to Mark Attendance -->
                                <form action="{{ route('attendance.mark', $employee->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="present" required>
                                        <label class="form-check-label">Present</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="absent" required>
                                        <label class="form-check-label">Absent</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Mark Attendance
                                    </button>
                                </form>
                            @endif
                        </td>
                        
                        <td>
                            <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
