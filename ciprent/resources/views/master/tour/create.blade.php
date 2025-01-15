@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Add Master Tour Data</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tour.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control" required autocomplete="off"
                    value="{{ old('product_name') }}">
            </div>
            <div class="mb-3">
                <label for="product_type" class="form-label">Product Type</label>
                <select name="product_type" id="product_type" class="form-control" required>
                    <option value="" disabled selected>Pilih Product Type</option>
                    <option value="Domestik Luxury">Domestik Luxury</option>
                    <option value="Domestik Non Luxury">Domestik Non Luxury</option>
                    <option value="Non Domestik">Non Domestik</option>
                </select>
            </div>

            <!-- Buttons for Back and Save -->
            <div class="d-flex justify-content-between">
                <!-- Back button (red) -->
                <a href="{{ route('tour.index') }}" class="btn btn-danger btn-lg">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </a>
                <!-- Save button (blue) -->
                <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
            </div>
        </form>
    </div>
@endsection
