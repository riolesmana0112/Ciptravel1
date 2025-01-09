@extends('layouts.app')


@section('content')
<div class="container p-4">
    <h1 class="mb-4">Add Price List Data</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('pricelist.store') }}"
        method="POST">
        @csrf
        <div class="mb-3">
            <label for="vehicle_id" class="form-label">Choose Vechicle Type</label>
            <select
                name="vehicle_id"
                class="form-control"
                id="vehicle_id"
                required
                autocomplete="off">
                @forelse ($vehicle as $data)
                <option value="{{ $data->id }}">{{ $data->vehicle_name }} - {{ $data->vehicle_type }} </option>
                @empty
                <option value="">Choose Vehicle </option>
                @endforelse
            </select>
        </div>
        <div class="mb-3">
            <label for="pickup_id" class="form-label">Choose Pickup Point</label>
            <select
                name="pickup_id"
                class="form-control"
                id="pickup_id"
                required
                autocomplete="off">
                @foreach ($pickup as $p)
                <option value="{{ $p->id }}">{{ $p->pickup_name }} </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="drop_id" class="form-label">Choose Drop Point</label>
            <select
                name="drop_id"
                class="form-control"
                id="drop_id"
                required
                autocomplete="off">
                @foreach ($drop as $d)
                <option value="{{ $d->id }}">{{ $d->drop_name }} </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input
                type="number"
                name="price"
                id="price"
                class="form-control"
                required autocomplete="off"
                value="{{ old('price') }}">
        </div>
        <div class="mb-3">
            <label for="charge_per_hour" class="form-label">Charge Per Hour</label>
            <input
                type="number"
                name="charge_per_hour"
                id="charge_per_hour"
                class="form-control"
                required autocomplete="off"
                value="{{ old('charge_per_hour') }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input id="x" type="hidden" name="description">
            <trix-editor input="x"></trix-editor>
        </div>
        <!-- Buttons for Back and Save -->
        <div class="d-flex justify-content-between">
            <!-- Back button (red) -->
            <a href="{{ route('pricelist.index') }}" class="btn btn-danger btn-lg">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
            <!-- Save button (blue) -->
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
        </div>
    </form>
</div>


@endsection