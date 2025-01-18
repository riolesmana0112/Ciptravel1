@extends('layouts.app')


@section('content')
<div class="container p-4">
    <h1 class="mb-4">Add Tour Data</h1>

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
     action="{{ route('tour-detail.store') }}"
        method="POST">
        @csrf
        <div class="mb-3">
            <label for="tour_title" class="form-label">Tour Title</label>
            <input
                type="text"
                name="tour_title"
                id="tour_title"
                class="form-control"
                required
                autocomplete="off"
                value="{{ old('tour_title') }}">
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input
                type="date"
                name="start_date"
                id="start_date"
                class="form-control"
                required
                autocomplete="off"
                value="{{ old('start_date') }}">
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input
                type="date"
                name="end_date"
                id="end_date"
                class="form-control"
                required
                autocomplete="off"
                value="{{ old('end_date') }}">
        </div>
        <div class="mb-3">
            <label for="pickup" class="form-label">Pickup</label>
            <input
                type="text"
                name="pickup"
                id="pickup"
                class="form-control"
                required
                autocomplete="off"
                value="{{ old('pickup') }}">
        </div>
        <div class="mb-3">
            <label for="pickup_name" class="form-label">Pickup Name</label>
            <input
                type="text"
                name="pickup_name"
                id="pickup_name"
                class="form-control"
                required
                autocomplete="off"
                value="{{ old('pickup_name') }}">
        </div>
        <div class="mb-3">
            <label for="map_location" class="form-label">Map Location</label>
            <input
                type="text"
                name="map_location"
                id="map_location"
                class="form-control"
                required
                autocomplete="off"
                value="{{ old('map_location') }}">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input
                type="text"
                name="price"
                id="price"
                class="form-control"
                required
                autocomplete="off"
                value="{{ old('price') }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input id="description" type="hidden" name="description" value="{{ old('description') }}"/>
            <trix-editor input="description"></trix-editor>
        </div>
        <div class="mb-3">
            <label for="facilities" class="form-label">Fasilities</label>
            <input id="x" type="hidden" name="facilities" value="{{ old('facilities') }}">
            <trix-editor input="x"></trix-editor>
        </div>
        <!-- Buttons for Back and Save -->
        <div class="d-flex justify-content-between">
            <!-- Back button (red) -->
            <a href="{{ route('tour-detail.index') }}" class="btn btn-danger btn-lg">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
            <!-- Save button (blue) -->
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
        </div>
    </form>
</div>


@endsection