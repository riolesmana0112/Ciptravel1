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

    <form action="{{ route('space-pricelist.store') }}"
        method="POST">
        @csrf
        <div class="mb-3">
            <label for="space_detail_id" class="form-label">Choose Space Detail</label>
            <select
                name="space_detail_id"
                class="form-control"
                id="space_detail_id"
                required
                autocomplete="off">
                @forelse ($detail as $data)
                <option value="{{ $data->id }}">{{ $data->location }} - {{ $data->space_title }} </option>
                @empty
                <option value="">Choose Space Detail</option>
                @endforelse
            </select>
        </div>
        <div class="mb-3">
            <label for="addon" class="form-label">Choose Addon</label>
            @foreach ($addon as $data)
            <div class="flex items-center mb-2">
                <input type="checkbox" id="addon-{{ $data->id }}" name="addons[]" 
                    value="{{ $data->id }}" class="mr-2">
                <label for="addon-{{ $data->id }}">{{ $data->addon_title }} - {{ $data->price }} </label>
            </div>
            @endforeach
        </div>
        <!-- Buttons for Back and Save -->
        <div class="d-flex justify-content-between">
            <!-- Back button (red) -->
            <a href="{{ route('space-pricelist.index') }}" class="btn btn-danger btn-lg">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
            <!-- Save button (blue) -->
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
        </div>
    </form>
</div>


@endsection