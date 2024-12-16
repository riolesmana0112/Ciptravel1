@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Car Status</h1>
    </div>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Action Buttons: Back to Home, Maintenance, BOP, Daily Report, Order Report, Add New Car -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <!-- Back to Welcome Button -->
        <a href="{{ route('welcome') }}" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>

        <!-- Other Buttons -->
        <div class="d-flex gap-3">
            <!-- Maintenance Button -->
            <a href="{{ route('maintenance.index') }}" class="btn btn-info btn-lg">
                <i class="bi bi-tools"></i> Maintenance
            </a>

            <!-- BOP Button (New) -->
            <a href="{{ route('bop.index') }}" class="btn btn-warning btn-lg">
                <i class="bi bi-cogs"></i> BOP
            </a>

<!-- Daily Report Button (Added) -->
            <a href="{{ route('daily_report.index') }}" class="btn btn-secondary btn-lg">
                <i class="bi bi-calendar"></i> Daily Report
            </a>

            <!-- Order Report Button -->
            <a href="{{ route('report.index') }}" class="btn btn-secondary btn-lg">
                <i class="bi bi-file-earmark-text"></i> Order Report
            </a>

            <!-- Add New Car Button -->
            <a href="{{ route('car.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-car-front-fill"></i> Add New Car
            </a>
        </div>
    </div>

    <!-- Car Details Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Mobil</th>
                    <th>Nomor Plat</th>
                    <th>Status</th>
                    <th>Kondisi</th>
                    <th>Deskripsi</th>
                    <th>Verifikasi</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cars as $car)
                    <tr class="bg-white">
                        <!-- Form to update car details -->
                        <form action="{{ route('car.update', $car->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <td>{{ $car->kendaraan }}</td>
                            <td>{{ $car->plat_nomor }}</td>
                            <td>
                                <select name="status" class="form-select">
                                    <option value="Available" {{ $car->status === 'Available' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="Busy" {{ $car->status === 'Busy' ? 'selected' : '' }}>Tak Tersedia</option>
                                </select>
                            </td>
                            <td>
                                <select name="condition" class="form-select">
                                    <option value="Good" {{ $car->condition === 'Good' ? 'selected' : '' }}>Bagus</option>
                                    <option value="Poor" {{ $car->condition === 'Poor' ? 'selected' : '' }}>Rusak</option>
                                </select>
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    name="keterangan" 
                                    class="form-control" 
                                    value="{{ $car->keterangan }}" 
                                    placeholder="Enter details"
                                >
                            </td>
                            <td class="text-center">
                                <label>
                                    <input type="hidden" name="verified" value="0">
                                    <input 
                                        type="checkbox" 
                                        name="verified" 
                                        value="1" 
                                        class="large-checkbox" 
                                        {{ $car->verified ? 'checked' : '' }}
                                    >
                                </label>
                            </td>
                            <td class="text-center">
                                <!-- Save Button -->
                                <form action="{{ route('car.update', $car->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="bi bi-save"></i> Save
                                    </button>
                                </form>

                                <!-- Delete Form -->
                                <form action="{{ route('car.destroy', $car->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this car?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </form>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No cars available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .large-checkbox {
        width: 20px;
        height: 20px;
        accent-color: #007bff;
    }

    .table td, .table th {
        text-align: center;
        vertical-align: middle;
    }

    .table .form-select {
        width: 100px;
    }

    .table td, .table th {
        padding: 0.75rem 1rem;
    }
</style>
@endsection
