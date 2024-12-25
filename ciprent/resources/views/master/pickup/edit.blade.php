@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Update Pickup Data</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('pickup.update', $data->id) }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kendaraan" class="form-label">Pickup Name</label>
            <input
                type="text"
                name="pickup_name"
                id="pickup_name"
                class="form-control"
                required
                autocomplete="off"
                value="{{ $data->pickup_name }}">
        </div>


        <!-- Buttons for Back and Save -->
        <div class="d-flex justify-content-between">
            <!-- Back button (red) -->
            <a href="{{ route('pickup.index') }}" class="btn btn-danger btn-lg">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
            <!-- Save button (blue) -->
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection