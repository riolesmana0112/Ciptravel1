@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Daily Reports</h1>
    </div>

    <!-- Navigation Buttons -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Back Button -->
        <a href="{{ route('car.index') }}" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>

        <!-- Button: Add New Report -->
        <div class="d-flex gap-3">
            <a href="{{ route('daily_report.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-plus-circle-fill"></i> Add New Report
            </a>
        </div>
    </div>

    <!-- Daily Reports Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Driver Name</th>
                    <th>Jenis Mobil</th>
                    <th>Plat Nomor</th>
                    <th>Keberangkatan</th>
                    <th>Kepulangan</th>
                    <th>Tujuan</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr class="bg-white">
                        <td>{{ $report->tanggal }}</td>
                        <td>{{ $report->driver_name }}</td>
                        <td>{{ $report->jenis_kendaraan }}</td>
                        <td>{{ $report->plat_nomor }}</td>
                        <td>{{ $report->keberangkatan }}</td>
                        <td>{{ $report->kepulangan }}</td>
                        <td>{{ $report->tujuan }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('daily_report.edit', $report->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('daily_report.destroy', $report->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this report?');">
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

<!-- Custom Styles -->
<style>
    /* Style for Table */
    .table th, .table td {
        text-align: center;
        vertical-align: middle;
        padding: 0.75rem;
    }

    /* Checkbox Style */
    .form-check-input {
        width: 1.25rem;
        height: 1.25rem;
    }

    /* Hover Effect for Table Rows */
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Button Size */
    .btn-lg {
        font-size: 1.25rem;
    }
</style>
@endsection
