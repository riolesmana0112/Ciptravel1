@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Create New Driver</h2>
    <form action="{{ route('driver.store') }}" method="POST">
        @csrf
        <!-- Tanggal (Read-only) -->
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{ now()->toDateString() }}" readonly>
        </div>

        <!-- Nama -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <!-- Mobil -->
        <div class="mb-3">
            <label for="mobil" class="form-label">Mobil</label>
            <input type="text" class="form-control" id="mobil" name="mobil" required>
        </div>

        <!-- Plat Nomor -->
        <div class="mb-3">
            <label for="plat_nomor" class="form-label">Plat Nomor</label>
            <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" required>
        </div>

        <!-- Jemput -->
        <div class="mb-3">
            <label for="jemput" class="form-label">Jemput</label>
            <input type="text" class="form-control" id="jemput" name="jemput" required>
        </div>

        <!-- Drop Off -->
        <div class="mb-3">
            <label for="drop_off" class="form-label">Drop Off</label>
            <input type="text" class="form-control" id="drop_off" name="drop_off" required>
        </div>

        <!-- Berangkat -->
        <div class="mb-3">
            <label for="berangkat" class="form-label">Berangkat</label>
            <input type="datetime-local" class="form-control" id="berangkat" name="berangkat" required>
        </div>

        <!-- Pulang -->
        <div class="mb-3">
            <label for="pulang" class="form-label">Pulang</label>
            <input type="datetime-local" class="form-control" id="pulang" name="pulang" required>
        </div>

        <!-- Tujuan -->
        <div class="mb-3">
            <label for="tujuan" class="form-label">Tujuan</label>
            <input type="text" class="form-control" id="tujuan" name="tujuan" required>
        </div>

        <!-- Button -->
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('driver.index') }}" class="btn btn-danger">Back</a>
    </form>
</div>
@endsection
