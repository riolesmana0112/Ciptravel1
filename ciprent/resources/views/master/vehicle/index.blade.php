@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Master Vehicle Data</h1>
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

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <!-- Action Buttons: Back to Home, Maintenance, BOP, Daily Report, Order Report, Add New Car -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <!-- Back to Welcome Button -->
        <a href="{{ route('master.index') }}" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>

        <!-- Other Buttons -->
        <div class="d-flex gap-3">
            <a href="{{ route('vehicle.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-car-front-fill"></i> Add New Vehicle
            </a>
        </div>
    </div>

    <!-- Car Details Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Type</th>
                    <th>Image</th>
                    <th>Vehicle Name</th>
                    <th>Vehicle Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $car)
                <tr class="bg-white">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $car->vehicle_type }}</td>
                    <td><img class="img-thumbnail" src="{{ $car->vehicle_picture }}" width="100" /></td>
                    <td>
                        {{ $car->vehicle_name }}
                    </td>
                    <td>
                        {{ $car->vehicle_number }}
                    </td>
                    <td class="text-center">
                        <!-- Save Button -->
                        <a href="{{ route('vehicle.edit', $car->id) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-save"></i> Upadate
                        </a>
                        <form action="{{ route('vehicle.destroy', $car->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this car?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No Vehicle Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection