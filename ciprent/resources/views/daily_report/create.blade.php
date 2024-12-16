@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Daily Report</h1>
    <form action="{{ route('daily_report.store') }}" method="POST">
        @csrf

        <!-- Tanggal otomatis -->
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{ now()->toDateString() }}" readonly>
        </div>

        <!-- Nama Driver -->
        <div class="form-group mb-3">
            <label for="driver_name" class="form-label">Driver Name</label>
            <input type="text" class="form-control" name="driver_name" required>
        </div>

        <!-- Jenis Kendaraan -->
        <div class="form-group mb-3">
            <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
            <select class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" required>
                <option value="" disabled selected>Pilih Jenis Kendaraan</option>
                <option value="Commuter">Hiace Commuter</option>
                <option value="Elf">Elf</option>
                <option value="Premio">Hiace Premio</option>
                <option value="Innova">Innova Reborn</option>
                <option value="Avanza">All New Avanza</option>
            </select>
        </div>

        <!-- Plat Nomor -->
        <div class="form-group mb-3">
            <label for="plat_nomor" class="form-label">Plat Nomor</label>
            <select class="form-control" id="plat_nomor" name="plat_nomor" required>
                <option value="" disabled selected>Pilih Plat Nomor</option>
            </select>
        </div>

        <!-- Keberangkatan -->
        <div class="mb-3">
            <label for="keberangkatan" class="form-label">Keberangkatan</label>
            <input type="datetime-local" class="form-control" id="keberangkatan" name="keberangkatan" required>
        </div>

        <!-- Kepulangan -->
        <div class="mb-3">
            <label for="kepulangan" class="form-label">Kepulangan</label>
            <input type="datetime-local" class="form-control" id="kepulangan" name="kepulangan" required>
        </div>

        <!-- Tujuan -->
        <div class="form-group mb-3">
            <label for="tujuan" class="form-label">Tujuan</label>
            <input type="text" class="form-control" name="tujuan" required>
        </div>
        <button type="submit" class="btn btn-success btn-custom">Save</button>
        <a href="{{ route('daily_report.index') }}" class="btn btn-danger btn-custom">Back</a>
    </form>
</div>

<!-- Script untuk Set Tanggal Otomatis dan Plat Nomor Dinamis -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Set Tanggal Otomatis
        const tanggalInput = document.getElementById('tanggal');
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0]; // Format: YYYY-MM-DD
        tanggalInput.value = formattedDate;
        
        // Data mapping untuk plat nomor berdasarkan jenis kendaraan
        const platNomorData = {
            Innova: ["B 1698 NIL", "B 2875 BGZ", "D 1111 NRM"],
            Commuter: ["D 7225 AS", "D 7055 FB", "B 7025 TDB"],
            Premio: ["AD 7011 E", "AD 7191 GD"],
            Avanza: ["D 1669 SAZ"],
            Elf: ["B 7228 TDB"]
        };

        // Event listener untuk mengubah plat nomor berdasarkan jenis kendaraan
        document.getElementById('jenis_kendaraan').addEventListener('change', function () {
            const jenisKendaraan = this.value;
            const platNomorSelect = document.getElementById('plat_nomor');

            // Reset opsi plat nomor
            platNomorSelect.innerHTML = '<option value="" disabled selected>Pilih Plat Nomor</option>';

            // Tambahkan plat nomor sesuai dengan jenis kendaraan
            if (platNomorData[jenisKendaraan]) {
                platNomorData[jenisKendaraan].forEach(function (platNomor) {
                    const option = document.createElement('option');
                    option.value = platNomor;
                    option.textContent = platNomor;
                    platNomorSelect.appendChild(option);
                });
            }
        });
    });
</script>
@endsection
