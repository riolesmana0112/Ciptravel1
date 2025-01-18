@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Update Addon Space {{ $data->addon_title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('space-addon.update', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to update this addon?')" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="addon_title" class="form-label">Addon Title</label>
                <input type="text" name="addon_title" id="addon_title" class="form-control" required autocomplete="off"
                    value="{{ old('addon_title', $data->addon_title) }}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Addon Price</label>
                <input type="number" name="price" id="price" class="form-control" required autocomplete="off"
                    value="{{ old('price', $data->price) }}">
            </div>

            <!-- Buttons for Back and Save -->
            <div class="d-flex justify-content-between">
                <!-- Back button (red) -->
                <a href="{{ route('space-addon.index') }}" class="btn btn-danger btn-lg">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </a>
                <!-- Save button (blue) -->
                <button type="submit" class="btn btn-success btn-lg">Update</button>
            </div>
        </form>
    </div>
@endsection
