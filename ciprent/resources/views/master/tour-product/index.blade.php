@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Tour Product</h1>
    </div>

    <!-- Display Validation Errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <!-- Action Buttons: Back to Home, Maintenance, BOP, Daily Report, Order Report, Add New Car -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <!-- Back to Welcome Button -->
        <a href="{{ route('master.index') }}" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>

        <!-- Other Buttons -->
        <div class="d-flex gap-3">
            <a href="{{ route('tour-product.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-car-front-fill"></i> Add New Product
            </a>
        </div>
    </div>

    <!-- Car Details Table -->
    <div class="table-responsive shadow-sm rounded p-4">
        <table class="table table-hover align-start table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Tour Type</th>
                    <th>Tour Detail</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $product)
                <tr class="bg-white">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $product->type->product_name }} - {{ $product->type->product_type }}</td>
                    <td>{{ $product->detail->tour_title }}</td>
                    <td class="text-center">
                        <!-- Save Button -->
                        <a href="{{ route('tour-product.edit', $product->id) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-save"></i> Update
                        </a>
                        <form action="{{ route('tour-product.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this car?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No pricelist Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection