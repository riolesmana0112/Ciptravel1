@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Maintenance List</h1>
    </div>

    <!-- Navigation Buttons -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Back Button -->
        <a href="{{ route('car.index') }}" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>

        <!-- Button: Create New Maintenance -->
        <div class="d-flex gap-3">
            <a href="{{ route('maintenance.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-plus-circle-fill"></i> Create New Maintenance
            </a>
        </div>
    </div>

    <!-- Maintenance Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Requestor</th>
                    <th>Jenis Kendaraan</th>
                    <th>Plat Nomor</th>
                    <th>Jenis Maintenance</th>
                    <th>Biaya</th>
                    <th>Vendor</th>
                    <th>Keterangan</th>
                    <th>Approved</th>
                    <th>Nomor Rekening</th> <!-- New Column -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($maintenances as $maintenance)
                    <tr class="bg-white">
                        <td>{{ $maintenance->tanggal }}</td>
                        <td>{{ $maintenance->nama_requestor }}</td>
                        <td>{{ $maintenance->jenis_kendaraan }}</td>
                        <td>{{ $maintenance->plat_nomor }}</td>
                        <td>{{ $maintenance->jenis_maintenance }}</td>
                        <td>Rp {{ number_format($maintenance->biaya, 0, ',', '.') }}</td>
                        <td>{{ $maintenance->vendor }}</td>
                        <td>{{ $maintenance->keterangan }}</td>
                        <td>
                            <!-- Approval Status as Checkbox with Tooltip -->
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                disabled 
                                title="{{ $maintenance->approval_status ? 'Approved' : 'Pending' }}"
                                {{ $maintenance->approval_status ? 'checked' : '' }}
                            >
                        </td>
                        <td>{{ $maintenance->nomor_rekening }}</td> <!-- Display Nomor Rekening -->
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('maintenance.edit', $maintenance->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('maintenance.destroy', $maintenance->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this maintenance record?');">
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
