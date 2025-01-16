@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <!-- Tulisan Cipta Indonesia ERP System -->
    <h1 class="display-1 fw-bold text-primary mb-4" style="font-size: 3.5rem;">Cipta Indonesia ERP System</h1>

    <!-- Tulisan Easier Travel Solution -->
    <h1 class="display-2 fw-bold text-primary mb-4" style="font-size: 2.5rem; margin-bottom: 2rem;">Easier Travel Solution</h1>

    <!-- Tulisan Hi, Welcome! -->
    <h2 class="text-muted mb-5" style="font-size: 1.5rem; margin-bottom: 3rem;">Data Master</h2>
</div>

<div class="container shadow mt-5 p-5">
    <!-- Tombol Navigasi -->
    <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('vehicle.index') }}" class="btn btn-lg btn-primary mx-3 d-flex align-items-center justify-content-center">
            Master Vehicle Data
        </a>
        <a href="{{ route('pickup.index') }}" class="btn btn-lg btn-primary mx-3 d-flex align-items-center justify-content-center">
            Master Pickup Data
        </a>
        <a href="{{ route('drop.index') }}" class="btn btn-lg btn-primary mx-3 d-flex align-items-center justify-content-center">
            Master Drop Data
        </a>
        <a href="{{ route('pricelist.index') }}" class="btn btn-lg btn-primary mx-3 d-flex align-items-center justify-content-center">
            Master Price List
        </a>
    </div>
    <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('tour.index') }}" class="btn btn-lg btn-primary mx-3 d-flex align-items-center justify-content-center">
            Master Tour
        </a>
        <a href="{{ route('tour-detail.index') }}" class="btn btn-lg btn-primary mx-3 d-flex align-items-center justify-content-center">
           Tour Detail
        </a>
        <a href="{{ route('drop.index') }}" class="btn btn-lg btn-primary mx-3 d-flex align-items-center justify-content-center">
            Tour Gallery
        </a>
    </div>
    {{-- <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('space.index') }}" class="btn btn-lg btn-primary mx-3 d-flex align-items-center justify-content-center">
            Space Addon
        </a>
        <a href="{{ route('space-detail.index') }}" class="btn btn-lg btn-primary mx-3 d-flex align-items-center justify-content-center">
           Space Detail
        </a>
        <a href="{{ route('drop.index') }}" class="btn btn-lg btn-primary mx-3 d-flex align-items-center justify-content-center">
            Space Gallery
        </a>
    </div> --}}
    <div class="d-flex justify-content-center">
        <a href="{{ route('home') }}" class="btn btn-danger">
            Back to Home
        </a>
    </div>
</div>

@endsection