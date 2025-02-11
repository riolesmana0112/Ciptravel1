@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Master Price List</h1>
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
            <a href="{{ route('pricelist.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-car-front-fill"></i> Add New Price List
            </a>
        </div>
    </div>

    <!-- Car Details Table -->
    <div class="table-responsive shadow-sm rounded p-4">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Vehicle Name</th>
                    <th>Pickup Point</th>
                    <th>Drop Point</th>
                    <th>Price</th>
                    <th>Charge Per Hour</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $pricelist)
                <tr class="bg-white">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $pricelist->vehicle->vehicle_name }} - {{ $pricelist->vehicle->vehicle_type }}</td>
                    <td>{{ $pricelist->pickup_point->pickup_name }} ({{ $pricelist->pickup_point->alias }})</td>
                    <td>{{ $pricelist->drop_point->drop_name }} ({{ $pricelist->drop_point->alias }})</td>
                    <td>Rp. {{ number_format($pricelist->price, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($pricelist->charge_per_hour, 0, ',', '.') }}</td>
                    <td>{!! $pricelist->description !!}</td>

                    <td class="text-center">
                        <!-- Save Button -->
                        <a href="{{ route('pricelist.edit', $pricelist->id) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-save"></i> Update
                        </a>
                        <form action="{{ route('pricelist.destroy', $pricelist->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this car?');">
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
                    <td colspan="7" class="text-center">No pricelist Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection