@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Data Biaya Operasional</h2>
    <form action="{{ route('bop.update', $bop->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" 
                   value="{{ old('tanggal', $bop->tanggal) }}" required readonly>
        </div>

        <div class="mb-3">
            <label for="nama_driver" class="form-label">Nama Driver</label>
            <input type="text" class="form-control" id="nama_driver" name="nama_driver" 
                   value="{{ old('nama_driver', $bop->nama_driver) }}" required>
        </div>

        <div class="mb-3">
            <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
            <select class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" required>
                <option value="" disabled>Pilih Jenis Kendaraan</option>
                <option value="Commuter" {{ old('jenis_kendaraan', $bop->jenis_kendaraan) == 'Commuter' ? 'selected' : '' }}>Hiace Commuter</option>
                <option value="Elf" {{ old('jenis_kendaraan', $bop->jenis_kendaraan) == 'Elf' ? 'selected' : '' }}>Elf</option>
                <option value="Premio" {{ old('jenis_kendaraan', $bop->jenis_kendaraan) == 'Premio' ? 'selected' : '' }}>Hiace Premio</option>
                <option value="Innova" {{ old('jenis_kendaraan', $bop->jenis_kendaraan) == 'Innova' ? 'selected' : '' }}>Innova Reborn</option>
                <option value="Avanza" {{ old('jenis_kendaraan', $bop->jenis_kendaraan) == 'Avanza' ? 'selected' : '' }}>All New Avanza</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="plat_nomor" class="form-label">Plat Nomor</label>
            <select class="form-control" id="plat_nomor" name="plat_nomor" required>
                <option value="" disabled>Pilih Plat Nomor</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tujuan" class="form-label">Tujuan</label>
            <input type="text" class="form-control" id="tujuan" name="tujuan" 
                   value="{{ old('tujuan', $bop->tujuan) }}" required>
        </div>

        <div class="mb-3">
            <label for="keberangkatan" class="form-label">Keberangkatan</label>
            <input type="datetime-local" class="form-control" id="keberangkatan" name="keberangkatan" 
                   value="{{ old('keberangkatan', \Carbon\Carbon::parse($bop->keberangkatan)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
            <label for="kepulangan" class="form-label">Kepulangan</label>
            <input type="datetime-local" class="form-control" id="kepulangan" name="kepulangan" 
                   value="{{ old('kepulangan', \Carbon\Carbon::parse($bop->kepulangan)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Jumlah Uang</label>
            <input 
                type="text" 
                class="form-control @error('harga') is-invalid @enderror" 
                id="harga_rupiah" 
                name="harga_rupiah" 
                value="{{ number_format(old('harga', $bop->harga), 0, ',', '.') }}" 
                required>
            <input type="hidden" id="harga" name="harga" value="{{ old('harga', $bop->harga) }}">
            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check mb-3">
            <input type="hidden" name="approval_status" value="0">
            <input type="checkbox" class="form-check-input" id="approval_status" name="approval_status" 
                   value="1" {{ old('approval_status', $bop->approval_status) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="approval_status">Approved</label>
        </div>

        <div class="mb-3">
            <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
            <select class="form-control" id="nomor_rekening" name="nomor_rekening" required>
                <option value="7940359133 - AA Wiguna" 
                        {{ old('nomor_rekening', $bop->nomor_rekening) == '7940359133 - AA Wiguna' ? 'selected' : '' }}>
                    7940359133 - AA Wiguna
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-success btn-custom">Update</button>
        <a href="{{ route('bop.index') }}" class="btn btn-danger btn-custom">Back</a>
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

    const jenisKendaraan = document.getElementById('jenis_kendaraan');
    const platNomor = document.getElementById('plat_nomor');

    const selectedPlatNomor = "{{ old('plat_nomor', $bop->plat_nomor) }}";

    const populatePlatNomor = (selectedJenis) => {
        platNomor.innerHTML = '<option value="" disabled>Pilih Plat Nomor</option>';
        if (platNomorData[selectedJenis]) {
            platNomorData[selectedJenis].forEach(function (plat) {
                const option = document.createElement('option');
                option.value = plat;
                option.textContent = plat;
                if (plat === selectedPlatNomor) option.selected = true;
                platNomor.appendChild(option);
            });
        }
    };

    jenisKendaraan.addEventListener('change', function () {
        populatePlatNomor(this.value);
    });

    if (jenisKendaraan.value) {
        populatePlatNomor(jenisKendaraan.value);
    }

    // Format Rupiah
    const rupiahInput = document.getElementById('harga_rupiah');
    const hiddenInput = document.getElementById('harga');

    const formatRupiah = (angka) => {
        return angka.replace(/\D/g, '') // Menghapus semua karakter non-digit
            .replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Menambahkan titik tiap 3 digit
    };

    rupiahInput.addEventListener('input', function () {
        const rawValue = rupiahInput.value.replace(/\./g, ''); // Hilangkan format
        rupiahInput.value = formatRupiah(rawValue); // Format kembali sebagai rupiah
        hiddenInput.value = rawValue; // Simpan nilai asli (angka saja) ke input hidden
    });
</script>
@endsection
