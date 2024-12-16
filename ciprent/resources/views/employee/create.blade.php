@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Tambah Karyawan</h1>
    </div>

    <form action="{{ route('employee.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="phone">Nomor Telepon</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="address">Alamat</label>
            <textarea name="address" class="form-control" rows="3" required></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="birth_date">Tanggal Lahir</label>
            <input type="date" name="birth_date" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="position">Jabatan</label>
            <input type="text" name="position" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="salary">Gaji</label>
            <input type="text" name="salary" id="salary" class="form-control" required onkeyup="formatNumber(this)">
        </div>

        <!-- Buttons for Save and Back -->
        <div class="d-flex justify-content-between">
            <!-- Back button (red) -->
            <a href="{{ route('employee.index') }}" class="btn btn-danger btn-lg">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
            <!-- Save button -->
            <button type="submit" class="btn btn-success btn-lg">Save</button>
        </div>
    </form>
</div>

<script>
    function formatNumber(input) {
        let value = input.value.replace(/\./g, ''); // Remove dots
        value = new Intl.NumberFormat('id-ID').format(value); // Format number
        input.value = value; // Display formatted value
    }
</script>
@endsection
