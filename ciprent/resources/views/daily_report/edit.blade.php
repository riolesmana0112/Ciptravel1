@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Daily Report</h1>
    <form action="{{ route('daily_report.update', $report) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Tanggal otomatis (read-only) -->
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{ $report->tanggal }}" readonly>
        </div>

        <!-- Nama Driver -->
        <div class="form-group mb-3">
            <label for="driver_name" class="form-label">Driver Name</label>
            <input type="text" class="form-control" name="driver_name" value="{{ old('driver_name', $report->driver_name) }}" required>
        </div>

        <!-- Jenis Kendaraan -->
        <div class="form-group mb-3">
            <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
            <select class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" required>
                <option value="" disabled>Pilih Jenis Kendaraan</option>
                <option value="Commuter" {{ $report->jenis_kendaraan == 'Commuter' ? 'selected' : '' }}>Hiace Commuter</option>
                <option value="Elf" {{ $report->jenis_kendaraan == 'Elf' ? 'selected' : '' }}>Elf</option>
                <option value="Premio" {{ $report->jenis_kendaraan == 'Premio' ? 'selected' : '' }}>Hiace Premio</option>
                <option value="Innova" {{ $report->jenis_kendaraan == 'Innova' ? 'selected' : '' }}>Innova Reborn</option>
                <option value="Avanza" {{ $report->jenis_kendaraan == 'Avanza' ? 'selected' : '' }}>All New Avanza</option>
            </select>
        </div>

        <!-- Plat Nomor -->
        <div class="form-group mb-3">
            <label for="plat_nomor" class="form-label">Plat Nomor</label>
            <select class="form-control" id="plat_nomor" name="plat_nomor" required>
                <option value="" disabled>Pilih Plat Nomor</option>
                <!-- Opsi ini akan diubah oleh JavaScript -->
            </select>
        </div>

        <!-- Keberangkatan -->
        <div class="mb-3">
            <label for="keberangkatan" class="form-label">Keberangkatan</label>
            <input type="datetime-local" class="form-control" name="keberangkatan" value="{{ old('keberangkatan', $report->keberangkatan) }}" required>
        </div>

        <!-- Kepulangan -->
        <div class="mb-3">
            <label for="kepulangan" class="form-label">Kepulangan</label>
            <input type="datetime-local" class="form-control" name="kepulangan" value="{{ old('kepulangan', $report->kepulangan) }}" required>
        </div>

        <!-- Tujuan -->
        <div class="form-group mb-3">
            <label for="tujuan" class="form-label">Tujuan</label>
            <input type="text" class="form-control" name="tujuan" value="{{ old('tujuan', $report->tujuan) }}" required>
        </div>

        <div class="d-flex justify-content-start gap-3">
            <!-- Save button first -->
            <button type="submit" class="btn btn-primary btn-custom">Save</button>
            <!-- Back button second -->
            <a href="{{ route('daily_report.index') }}" class="btn btn-danger btn-custom">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const platNomorData = {
            Innova: ["B 1698 NIL", "B 2875 BGZ", "D 1111 NRM"],
            Commuter: ["D 7225 AS", "D 7055 FB", "B 7025 TDB"],
            Premio: ["AD 7011 E", "AD 7191 GD"],
            Avanza: ["D 1669 SAZ"],
            Elf: ["B 7228 TDB"]
        };

        const jenisKendaraanSelect = document.getElementById('jenis_kendaraan');
        const platNomorSelect = document.getElementById('plat_nomor');

        function populatePlatNomor(jenisKendaraan, selectedPlat = '') {
            platNomorSelect.innerHTML = '<option value="" disabled selected>Pilih Plat Nomor</option>';
            if (platNomorData[jenisKendaraan]) {
                platNomorData[jenisKendaraan].forEach(function (plat) {
                    const option = document.createElement('option');
                    option.value = plat;
                    option.textContent = plat;
                    if (plat === selectedPlat) {
                        option.selected = true;
                    }
                    platNomorSelect.appendChild(option);
                });
            }
        }

        const initialJenisKendaraan = jenisKendaraanSelect.value;
        const initialPlatNomor = "{{ $report->plat_nomor }}";
        if (initialJenisKendaraan) {
            populatePlatNomor(initialJenisKendaraan, initialPlatNomor);
        }

        jenisKendaraanSelect.addEventListener('change', function () {
            populatePlatNomor(this.value);
        });
    });
</script>
@endsection
