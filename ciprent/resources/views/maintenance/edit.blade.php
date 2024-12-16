@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Maintenance</h2>

    <form action="{{ route('maintenance.update', $maintenance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Tanggal -->
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input 
                type="date" 
                class="form-control @error('tanggal') is-invalid @enderror" 
                id="tanggal" 
                name="tanggal" 
                value="{{ old('tanggal', $maintenance->tanggal) }}" 
                required>
            @error('tanggal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nama Requestor -->
        <div class="mb-3">
            <label for="nama_requestor" class="form-label">Nama Requestor</label>
            <input 
                type="text" 
                class="form-control @error('nama_requestor') is-invalid @enderror" 
                id="nama_requestor" 
                name="nama_requestor" 
                value="{{ old('nama_requestor', $maintenance->nama_requestor) }}" 
                required>
            @error('nama_requestor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Jenis Kendaraan -->
        <div class="mb-3">
            <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
            <select class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" required>
                <option value="" disabled selected>Pilih Jenis Kendaraan</option>
                <option value="Commuter" {{ old('jenis_kendaraan', $maintenance->jenis_kendaraan) == 'Commuter' ? 'selected' : '' }}>Hiace Commuter</option>
                <option value="Elf" {{ old('jenis_kendaraan', $maintenance->jenis_kendaraan) == 'Elf' ? 'selected' : '' }}>Elf</option>
                <option value="Premio" {{ old('jenis_kendaraan', $maintenance->jenis_kendaraan) == 'Premio' ? 'selected' : '' }}>Hiace Premio</option>
                <option value="Innova" {{ old('jenis_kendaraan', $maintenance->jenis_kendaraan) == 'Innova' ? 'selected' : '' }}>Innova Reborn</option>
                <option value="Avanza" {{ old('jenis_kendaraan', $maintenance->jenis_kendaraan) == 'Avanza' ? 'selected' : '' }}>All New Avanza</option>
            </select>
            @error('jenis_kendaraan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Plat Nomor -->
        <div class="mb-3">
            <label for="plat_nomor" class="form-label">Plat Nomor</label>
            <select class="form-control" id="plat_nomor" name="plat_nomor" required>
                <option value="" disabled selected>Pilih Plat Nomor</option>
            </select>
            @error('plat_nomor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Jenis Maintenance -->
        <div class="mb-3">
            <label for="jenis_maintenance" class="form-label">Jenis Maintenance</label>
            <input 
                type="text" 
                class="form-control @error('jenis_maintenance') is-invalid @enderror" 
                id="jenis_maintenance" 
                name="jenis_maintenance" 
                value="{{ old('jenis_maintenance', $maintenance->jenis_maintenance) }}" 
                required>
            @error('jenis_maintenance')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Biaya -->
        <div class="mb-3">
            <label for="biaya" class="form-label">Biaya</label>
            <input 
                type="number" 
                class="form-control @error('biaya') is-invalid @enderror" 
                id="biaya" 
                name="biaya" 
                value="{{ old('biaya', $maintenance->biaya) }}" 
                required>
            @error('biaya')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Vendor -->
        <div class="mb-3">
            <label for="vendor" class="form-label">Vendor</label>
            <input 
                type="text" 
                class="form-control @error('vendor') is-invalid @enderror" 
                id="vendor" 
                name="vendor" 
                value="{{ old('vendor', $maintenance->vendor) }}" 
                required>
            @error('vendor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nomor Rekening -->
        <div class="mb-3">
            <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
            <select class="form-control @error('nomor_rekening') is-invalid @enderror" id="nomor_rekening" name="nomor_rekening" required>
                <option value="" disabled selected>Pilih Nomor Rekening</option>
                @foreach ($nomorRekeningList as $rekening)
                    <option value="{{ $rekening }}" {{ old('nomor_rekening', $maintenance->nomor_rekening) == $rekening ? 'selected' : '' }}>
                        {{ $rekening }}
                    </option>
                @endforeach
            </select>
            @error('nomor_rekening')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Keterangan -->
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea 
                class="form-control @error('keterangan') is-invalid @enderror" 
                id="keterangan" 
                name="keterangan" 
                rows="3" 
                nullable>{{ old('keterangan', $maintenance->keterangan) }}</textarea>
            @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Approval Status -->
        <div class="form-check mb-3">
            <input 
                type="checkbox" 
                class="form-check-input" 
                id="approval_status" 
                name="approval_status" 
                {{ old('approval_status', $maintenance->approval_status) ? 'checked' : '' }} />
            <label class="form-check-label" for="approval_status">Approved</label>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<script>
    const platNomorData = {
        Innova: ["B 1698 NIL", "B 2875 BGZ", "D 1111 NRM"],
        Commuter: ["D 7225 AS", "D 7055 FB", "B 7025 TDB"],
        Premio: ["AD 7011 E", "AD 7191 GD"],
        Avanza: ["D 1669 SAZ"],
        Elf: ["B 7228 TDB"]
    };

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
    const selectedPlatNomor = "{{ old('plat_nomor', $maintenance->plat_nomor) }}"; // Plat nomor yang dipilih sebelumnya

    function updatePlatNomorOptions() {
        const selectedType = jenisKendaraanSelect.value;
        const platNumbers = platNomorData[selectedType] || [];

        // Reset options
        platNomorSelect.innerHTML = '<option value="" disabled selected>Pilih Plat Nomor</option>';

        // Tambahkan opsi baru
        platNumbers.forEach(function (plat) {
            const option = document.createElement('option');
            option.value = plat;
            option.textContent = plat;
            if (plat === selectedPlatNomor) {
                option.selected = true; // Tetapkan opsi terpilih
            }
            platNomorSelect.appendChild(option);
        });
    }

    // Update dropdown ketika jenis kendaraan berubah
    jenisKendaraanSelect.addEventListener('change', updatePlatNomorOptions);

    // Panggil fungsi saat halaman dimuat untuk menetapkan nilai awal
    updatePlatNomorOptions();
});

</script>
@endsection
