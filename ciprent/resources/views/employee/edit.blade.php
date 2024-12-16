@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Edit Karyawan</h1>
    </div>

    <form action="{{ route('employee.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="address">Address</label>
            <textarea name="address" class="form-control" required>{{ $employee->address }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="birth_date">Birth Date</label>
            <input type="date" name="birth_date" class="form-control" value="{{ $employee->birth_date }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="position">Position</label>
            <input type="text" name="position" class="form-control" value="{{ $employee->position }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="salary">Salary</label>
            <input 
                type="text" 
                name="salary" 
                id="salary" 
                class="form-control" 
                value="{{ number_format($employee->salary, 0, ',', '.') }}" 
                required 
                onkeyup="formatNumber(this)">
        </div>

        <!-- Edit Kehadiran -->
        <div class="form-group mb-3">
            <label for="attendance">Attendance</label>
            @php
                $attendance = \App\Models\Attendance::where('employee_id', $employee->id)
                    ->whereDate('date', now()->toDateString())
                    ->first();
            @endphp
            @if ($attendance)
                <div class="d-flex">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="attendance_status" value="present" {{ $attendance->status == 'present' ? 'checked' : '' }}>
                        <label class="form-check-label">Present</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="attendance_status" value="absent" {{ $attendance->status == 'absent' ? 'checked' : '' }}>
                        <label class="form-check-label">Absent</label>
                    </div>
                </div>
            @else
                <div class="d-flex">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="attendance_status" value="present" required>
                        <label class="form-check-label">Present</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="attendance_status" value="absent" required>
                        <label class="form-check-label">Absent</label>
                    </div>
                </div>
            @endif
        </div>

        <!-- Buttons for Save and Back -->
        <div class="d-flex justify-content-between">
            <!-- Back button (red) -->
            <a href="{{ route('employee.index') }}" class="btn btn-danger btn-lg">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
            <!-- Save button -->
            <button type="submit" class="btn btn-success btn-lg">Save</button>
        </div>
    </form>
</div>

<script>
    function formatNumber(input) {
        let value = input.value.replace(/\./g, ''); // Remove dots
        value = new Intl.NumberFormat('id-ID').format(value); // Format number
        input.value = value; // Display formatted value
    }
</script>
@endsection
