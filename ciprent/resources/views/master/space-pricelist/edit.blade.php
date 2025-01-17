@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Update Space price list</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('space-pricelist.update', $pricelist->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="space_detail_id" class="form-label">Choose Space Detail</label>
                <select name="space_detail_id" class="form-control" id="space_detail_id" required autocomplete="off">
                    @forelse ($detail as $d)
                        <option value="{{ old('space_detail_id', $pricelist->space_detail_id) }}"
                            {{ old('space_detail_id', $pricelist->space_detail_id) == $d->id }}>{{ $d->location }} -
                            {{ $d->space_title }} </option>
                    @empty
                        <option value="">Choose Space Detail</option>
                    @endforelse
                </select>
            </div>
            <div class="mb-3">
                <label for="addon" class="form-label">Choose Addon</label>
                @foreach ($addon as $d)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" id="addon-{{ $d->id }}" name="addons[]" value="{{ $d->id }}"
                            class="mr-2">
                        <label for="addon-{{ $d->id }}">{{ $d->addon_title }} - {{ $d->price }} </label>
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
