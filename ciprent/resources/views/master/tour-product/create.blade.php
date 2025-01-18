@extends('layouts.app')


@section('content')
<div class="container p-4">
    <h1 class="mb-4">Add Tour Product</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('tour-product.store') }}"
        method="POST">
        @csrf
        <div class="mb-3">
            <label for="master_tour_id" class="form-label">Choose Tour Type</label>
            <select
                name="master_tour_id"
                class="form-control"
                id="master_tour_id"
                required
                autocomplete="off">
                @forelse ($type as $t)
                <option value="{{ $t->id }}">{{ $t->product_name }} - {{ $t->product_type }} </option>
                @empty
                <option value="">Choose Tour Type</option>
                @endforelse
            </select>
        </div>
        <div class="mb-3">
            <label for="tour_detail_id" class="form-label">Choose Tour Detail</label>
            <select
                name="tour_detail_id"
                class="form-control"
                id="tour_detail_id"
                required
                autocomplete="off">
                @forelse ($detail as $t)
                <option value="{{ $t->id }}">{{ $t->tour_title }}</option>
                @empty
                <option value="">Choose Tour Detail</option>
                @endforelse
            </select>
        </div>
        <!-- Buttons for Back and Save -->
        <div class="d-flex justify-content-between">
            <!-- Back button (red) -->
            <a href="{{ route('tour-product.index') }}" class="btn btn-danger btn-lg">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
            <!-- Save button (blue) -->
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
        </div>
    </form>
</div>


@endsection