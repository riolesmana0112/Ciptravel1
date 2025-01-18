@extends('layouts.app')


@section('content')
<div class="container p-4">
    <h1 class="mb-4">Update Space Data</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form
     action="{{ route('space-detail.update', $data->id) }}"
        method="POST">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label">Available:</label>
            <input type="radio" id="available_yes" name="available" value="1" 
                   {{ $data->available == 1 ? 'checked' : '' }}>
            <label for="available_yes" class="form-label">Yes</label>
            <input type="radio" id="available_no" name="available" value="0" 
                   {{ $data->available == 0 ? 'checked' : '' }}>
            <label for="available_no" class="form-label">No</label>
        </div>
        
        <div class="mb-3">
            <label for="space_title" class="form-label">Space Title</label>
            <input
                type="text"
                name="space_title"
                id="space_title"
                class="form-control"
                required
                autocomplete="off"
                value="{{ $data->space_title }}">
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input
                type="text"
                name="location"
                id="location"
                class="form-control"
                required
                autocomplete="off"
                value="{{ $data->location }}">
        </div>
        <div class="mb-3">
            <label for="google_location" class="form-label">Google Map Location</label>
            <input
                type="text"
                name="google_location"
                id="google_location"
                class="form-control"
                required
                autocomplete="off"
                value="{{ $data->google_location }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input id="description" type="hidden" name="description" value="{{ $data->description }}"/>
            <trix-editor input="description"></trix-editor>
        </div>
        <div class="mb-3">
            <label for="fasilities" class="form-label">Fasilities</label>
            <input id="x" type="hidden" name="fasilities" value="{{ $data->fasilities }}">
            <trix-editor input="x"></trix-editor>
        </div>
        <div class="mb-3">
            <label for="min_pax" class="form-label">Min Pax</label>
            <input
                type="text"
                name="min_pax"
                id="min_pax"
                class="form-control"
                required
                autocomplete="off"
                value="{{ $data->min_pax }}">
        </div>
        <div class="mb-3">
            <label for="max_pax" class="form-label">Max Pax</label>
            <input
                type="text"
                name="max_pax"
                id="max_pax"
                class="form-control"
                required
                autocomplete="off"
                value="{{ $data->max_pax }}">
        </div>
        <div class="mb-3">
            <label for="days" class="form-label">Days</label>
            <input
                type="number"
                name="days"
                id="days"
                class="form-control"
                required
                autocomplete="off"
                value="{{ $data->days }}">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input
                type="number"
                name="price"
                id="price"
                class="form-control"
                required
                autocomplete="off"
                value="{{ $data->price }}">
        </div>
        <!-- Buttons for Back and Save -->
        <div class="d-flex justify-content-between">
            <!-- Back button (red) -->
            <a href="{{ route('space-detail.index') }}" class="btn btn-danger btn-lg">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
            <!-- Save button (blue) -->
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
        </div>
    </form>
</div>


@endsection