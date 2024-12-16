@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Car Edit </h1>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('car.update', $car->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menggunakan method PUT untuk update -->

        <div class="mb-3">
            <label for="kendaraan" class="form-label">Car</label>
            <input type="text" name="kendaraan" id="kendaraan" class="form-control" value="{{ old('kendaraan', $car->kendaraan) }}" required>
        </div>
        <div class="mb-3">
            <label for="plat_nomor" class="form-label">Plate</label>
            <input type="text" name="plat_nomor" id="plat_nomor" class="form-control" value="{{ old('plat_nomor', $car->plat_nomor) }}" required>
        </div>
        
        <!-- Buttons for Back and Save -->
        <div class="d-flex justify-content-between">
            <!-- Back button (red) -->
            <a href="{{ route('car.index') }}" class="btn btn-danger btn-lg">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
            <!-- Save button (blue) -->
            <button type="submit" class="btn btn-primary btn-lg">Save</button>
        </div>
    </form>
</div>
@endsection