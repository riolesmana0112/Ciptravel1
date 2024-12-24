@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Update Vehicle</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('vehicle.update', $data->id) }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="vehicle_type" class="form-label">Choose Vechicle Type</label>
            <select
                name="vehicle_type"
                class="form-control"
                id="vehicle_type"
                required
                autocomplete="off">
                <option value="CAR">CAR</option>
                <option value="HELICOPTER">HELICOPTER</option>
                <option value="YATCH">YATCH</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="kendaraan" class="form-label">Vehicle Name</label>
            <input
                type="text"
                name="vehicle_name"
                id="vehicle_name"
                class="form-control"
                required
                autocomplete="off"
                value="{{ $data->vehicle_name }}">
        </div>
        <div class="mb-3">
            <label for="vehicle_number" class="form-label">Vehicle Number</label>
            <input
                type="text"
                name="vehicle_number"
                id="vehicle_number"
                class="form-control"
                required autocomplete="off"
                value="{{ $data->vehicle_number }}">
        </div>
        <img src="{{ $data->vehicle_picture }}" class="img-thumbnail" width="200" />
        <div class="mb-3">
            <label for="vehicle_picture" class="form-label">Vehicle Picture</label>
            <input type="file" name="vehicle_picture" id="vehicle_picture" class="form-control" autocomplete="off">
        </div>

        <!-- Buttons for Back and Save -->
        <div class="d-flex justify-content-between">
            <!-- Back button (red) -->
            <a href="{{ route('vehicle.index') }}" class="btn btn-danger btn-lg">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
            <!-- Save button (blue) -->
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection