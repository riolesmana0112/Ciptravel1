@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add Car</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('car.store') }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="kendaraan" class="form-label">Jenis Kendaraan</label>
            <input
                type="text"
                name="kendaraan"
                id="kendaraan"
                class="form-control"
                required
                autocomplete="off"
                value="{{ old('kendaraan') }}">
        </div>
        <div class="mb-3">
            <label for="plat_nomor" class="form-label">Nomor Plat</label>
            <input
                type="text"
                name="plat_nomor"
                id="plat_nomor"
                class="form-control"
                required autocomplete="off"
                value="{{ old('plat_nomor') }}">
        </div>
        <div class="mb-3">
            <label for="car_image" class="form-label">Gambar mobil</label>
            <input type="file" name="car_image" id="car_image" class="form-control" required autocomplete="off">
        </div>

        <!-- Buttons for Back and Save -->
        <div class="d-flex justify-content-between">
            <!-- Back button (red) -->
            <a href="{{ route('car.index') }}" class="btn btn-danger btn-lg">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
            <!-- Save button (blue) -->
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection