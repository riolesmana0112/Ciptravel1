@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <!-- Tulisan Cipta Indonesia ERP System -->
    <h1 class="display-1 fw-bold text-primary mb-4" style="font-size: 3.5rem;">Cipta Indonesia ERP System</h1>

    <!-- Tulisan Easier Travel Solution -->
    <h1 class="display-2 fw-bold text-primary mb-4" style="font-size: 2.5rem; margin-bottom: 2rem;">Easier Travel Solution</h1>

    <!-- Tulisan Hi, Welcome! -->
    <h2 class="text-muted mb-5" style="font-size: 1.5rem; margin-bottom: 3rem;">Hi, Welcome! {{ $data->username }} </h2>
</div>

<div class="container shadow mt-5 p-5">
    <!-- Tombol Navigasi -->
    <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('employee.index') }}" class="btn btn-lg btn-primary mx-3 d-flex align-items-center justify-content-center" style="width: 200px; height: 60px;">
            Employee
        </a>
        <a href="{{ route('car.index') }}" class="btn btn-lg btn-primary mx-3 d-flex align-items-center justify-content-center" style="width: 200px; height: 60px;">
            Operation
        </a>
        <a href="{{ route('master.index') }}" class="btn btn-lg btn-primary mx-3 d-flex align-items-center justify-content-center" style="width: 200px; height: 60px;">
            Data Master
        </a>
    </div>

    <!-- Tombol Logout -->
    <div class="d-flex justify-content-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger" style="width: 200px; height: 50px; font-size: 1rem;">
                Logout
            </button>
        </form>
    </div>
</div>

@endsection