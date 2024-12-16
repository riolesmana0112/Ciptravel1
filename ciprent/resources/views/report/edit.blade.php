@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Report</h2>
    <form action="{{ route('report.update', $report->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Tanggal -->
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{ $report->tanggal }}" readonly>
        </div>

        <!-- Nama Driver -->
        <div class="mb-3">
            <label for="nama_driver" class="form-label">Nama Driver</label>
            <input type="text" class="form-control" id="nama_driver" name="nama_driver" value="{{ $report->nama_driver }}" required>
        </div>

        <!-- Jenis Kendaraan -->
        <div class="mb-3">
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
        <div class="mb-3">
            <label for="plat_nomor" class="form-label">Plat Nomor</label>
            <select class="form-control" id="plat_nomor" name="plat_nomor" required>
                <option value="" disabled>Pilih Plat Nomor</option>
            </select>
        </div>

        <!-- Tujuan -->
        <div class="mb-3">
            <label for="tujuan" class="form-label">Tujuan</label>
            <input type="text" class="form-control" id="tujuan" name="tujuan" value="{{ $report->tujuan }}" required>
        </div>

        <!-- Keberangkatan -->
        <div class="mb-3">
            <label for="keberangkatan" class="form-label">Keberangkatan</label>
            <input type="datetime-local" class="form-control" id="keberangkatan" name="keberangkatan" value="{{ $report->keberangkatan }}" required>
        </div>

        <!-- Kepulangan -->
        <div class="mb-3">
            <label for="kepulangan" class="form-label">Kepulangan</label>
            <input type="datetime-local" class="form-control" id="kepulangan" name="kepulangan" value="{{ $report->kepulangan }}" required>
        </div>

        <!-- Type Sewa -->
        <div class="mb-3">
            <label for="type_sewa" class="form-label">Type Sewa</label>
            <select class="form-control" id="type_sewa" name="type_sewa" required>
                <option value="all_in_1" {{ $report->type_sewa == 'all_in_1' ? 'selected' : '' }}>All in 1</option>
                <option value="all_in_2" {{ $report->type_sewa == 'all_in_2' ? 'selected' : '' }}>All in 2</option>
                <option value="lk" {{ $report->type_sewa == 'lk' ? 'selected' : '' }}>Lepas Kunci</option>
            </select>
        </div>

        <!-- Keterangan Type -->
        <div class="mb-3">
            <label for="keterangan_type" class="form-label">Keterangan Type</label>
            <textarea class="form-control" id="keterangan_type" name="keterangan_type" rows="2" required>{{ $report->keterangan_type }}</textarea>
        </div>

        <!-- Harga Sewa -->
        <div class="mb-3">
            <label for="harga_sewa" class="form-label">Harga Sewa</label>
            <input type="text" class="form-control format-uang" id="harga_sewa" name="harga_sewa" value="{{ $report->harga_sewa }}" required>
        </div>

        <!-- DP -->
        <div class="mb-3">
            <label for="dp" class="form-label">DP</label>
            <input type="text" class="form-control format-uang" id="dp" name="dp" value="{{ $report->dp }}" required>
        </div>

        <!-- Approval -->
        <div class="form-check mb-3">
    <input 
        type="hidden" 
        name="approval_status" 
        value="0"  
    >
    <input 
        type="checkbox" 
        class="form-check-input" 
        id="approval_status" 
        name="approval_status" 
        value="1"  
        {{ old('approval_status', $report->approval_status) ? 'checked' : '' }} />
    <label class="form-check-label" for="approval_status">Approved</label>
</div>


        <!-- Bukti Pembayaran -->
        <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
            <select class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
                <option value="Invoice" {{ $report->bukti_pembayaran == 'Invoice' ? 'selected' : '' }}>Invoice</option>
                <option value="Kwitansi" {{ $report->bukti_pembayaran == 'Kwitansi' ? 'selected' : '' }}>Kwitansi</option>
            </select>
        </div>

        <!-- Tombol Save dan Back -->
        <button type="submit" class="btn btn-success btn-custom">Save</button>
        <a href="{{ route('report.index') }}" class="btn btn-danger btn-custom">Back</a>
    </form>
</div>

<!-- Script for Dropdowns -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const vehicleData = {
            "Innova": ["B 1698 NIL", "B 2875 BGZ", "D 1111 NRM"],
            "Commuter": ["D 7225 AS", "D 7055 FB", "B 7025 TDB"],
            "Premio": ["AD 7011 E", "AD 7191 GD"],
            "Avanza": ["D 1669 SAZ"],
            "Elf": ["B 7228 TDB"]
        };

        const jenisKendaraanSelect = document.getElementById('jenis_kendaraan');
        const platNomorSelect = document.getElementById('plat_nomor');

        // Populate plat nomor options based on the selected jenis kendaraan
        const selectedVehicle = jenisKendaraanSelect.value;
        if (vehicleData[selectedVehicle]) {
            vehicleData[selectedVehicle].forEach(plate => {
                const option = document.createElement('option');
                option.value = plate;
                option.textContent = plate;
                option.selected = plate === "{{ $report->plat_nomor }}"; // Pre-select if matches current report
                platNomorSelect.appendChild(option);
            });
        }

        // Update Plat Nomor options based on selected Jenis Kendaraan
        jenisKendaraanSelect.addEventListener('change', function () {
            const selectedVehicle = this.value;
            platNomorSelect.innerHTML = '<option value="">Pilih Plat Nomor</option>'; // Reset options

            if (vehicleData[selectedVehicle]) {
                vehicleData[selectedVehicle].forEach(plate => {
                    const option = document.createElement('option');
                    option.value = plate;
                    option.textContent = plate;
                    platNomorSelect.appendChild(option);
                });
            }
        });

        // Update Keterangan Type based on Type Sewa
        const typeSewaSelect = document.getElementById('type_sewa');
        const keteranganTypeTextarea = document.getElementById('keterangan_type');

        typeSewaSelect.addEventListener('change', function () {
            const selectedType = this.value;
            if (selectedType === "all_in_1") {
                keteranganTypeTextarea.value = "Mobil, Supir, BBM, Toll";
            } else if (selectedType === "all_in_2") {
                keteranganTypeTextarea.value = "Mobil, Supir, BBM";
            } else if (selectedType === "lk") {
                keteranganTypeTextarea.value = "Lepas Kunci";
            }
        });
    });
</script>

<!-- Custom Styles -->
<style>
    .verification-checkbox {
        width: 1.5em; /* Smaller width */
        height: 1.5em; /* Smaller height */
        transform: scale(1); /* Remove scaling for a more standard size */
    }

    .form-check-label {
        margin-left: 0.5em; /* Space between checkbox and label */
    }

    .btn-custom {
        font-size: 1rem;
        padding: 0.5rem 1rem;
    }
</style>

@endsection
