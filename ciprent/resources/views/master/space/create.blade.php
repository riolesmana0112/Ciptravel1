@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Add Addon Space Data</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('space-addon.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="addon_title" class="form-label">Addon Title</label>
                <input type="text" name="addon_title" id="addon_title" class="form-control" required autocomplete="off"
                    value="{{ old('addon_title') }}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Addon Price</label>
                <input type="number" name="price" id="price" class="form-control" required autocomplete="off"
                    value="{{ old('price') }}">
            </div>

            <!-- Buttons for Back and Save -->
            <div class="d-flex justify-content-between">
                <!-- Back button (red) -->
                <a href="{{ route('space-addon.index') }}" class="btn btn-danger btn-lg">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </a>
                <!-- Save button (blue) -->
                <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
            </div>
        </form>
    </div>
@endsection
