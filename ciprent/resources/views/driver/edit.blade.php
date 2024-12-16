@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Data Driver</h2>

    <form action="{{ route('driver.update', $driver->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Tanggal -->
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input 
                type="text" 
                class="form-control @error('tanggal') is-invalid @enderror" 
                id="tanggal" 
                name="tanggal" 
                value="{{ old('tanggal', $driver->tanggal) }}" 
                readonly>
            @error('tanggal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nama -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input 
                type="text" 
                class="form-control @error('nama') is-invalid @enderror" 
                id="nama" 
                name="nama" 
                value="{{ old('nama', $driver->nama) }}" 
                required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Mobil -->
        <div class="mb-3">
            <label for="mobil" class="form-label">Mobil</label>
            <input 
                type="text" 
                class="form-control @error('mobil') is-invalid @enderror" 
                id="mobil" 
                name="mobil" 
                value="{{ old('mobil', $driver->mobil) }}" 
                required>
            @error('mobil')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Plat Nomor -->
        <div class="mb-3">
            <label for="plat_nomor" class="form-label">Plat Nomor</label>
            <input 
                type="text" 
                class="form-control @error('plat_nomor') is-invalid @enderror" 
                id="plat_nomor" 
                name="plat_nomor" 
                value="{{ old('plat_nomor', $driver->plat_nomor) }}" 
                required>
            @error('plat_nomor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Jemput -->
        <div class="mb-3">
            <label for="jemput" class="form-label">Jemput</label>
            <input 
                type="text" 
                class="form-control @error('jemput') is-invalid @enderror" 
                id="jemput" 
                name="jemput" 
                value="{{ old('jemput', $driver->jemput) }}" 
                required>
            @error('jemput')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Drop Off -->
        <div class="mb-3">
            <label for="drop_off" class="form-label">Drop Off</label>
            <input 
                type="text" 
                class="form-control @error('drop_off') is-invalid @enderror" 
                id="drop_off" 
                name="drop_off" 
                value="{{ old('drop_off', $driver->drop_off) }}" 
                required>
            @error('drop_off')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Berangkat -->
        <div class="mb-3">
            <label for="berangkat" class="form-label">Berangkat</label>
            <input 
                type="datetime-local" 
                class="form-control @error('berangkat') is-invalid @enderror" 
                id="berangkat" 
                name="berangkat" 
                value="{{ old('berangkat', $driver->berangkat) }}" 
                required>
            @error('berangkat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pulang -->
        <div class="mb-3">
            <label for="pulang" class="form-label">Pulang</label>
            <input 
                type="datetime-local" 
                class="form-control @error('pulang') is-invalid @enderror" 
                id="pulang" 
                name="pulang" 
                value="{{ old('pulang', $driver->pulang) }}" 
                required>
            @error('pulang')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tujuan -->
        <div class="mb-3">
            <label for="tujuan" class="form-label">Tujuan</label>
            <input 
                type="text" 
                class="form-control @error('tujuan') is-invalid @enderror" 
                id="tujuan" 
                name="tujuan" 
                value="{{ old('tujuan', $driver->tujuan) }}" 
                required>
            @error('tujuan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('driver.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
