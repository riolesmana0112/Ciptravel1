@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Data Harga</h2>
    <form action="{{ route('bop.store') }}" method="POST">
        @csrf

        <!-- Tanggal Field -->
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>

        <!-- Nama Driver Field -->
        <div class="mb-3">
            <label for="nama_driver" class="form-label">Nama Driver</label>
            <input type="text" class="form-control" id="nama_driver" name="nama_driver" required>
        </div>

        <!-- Jenis Kendaraan Field -->
        <div class="mb-3">
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

        <!-- Plat Nomor Field (Dynamic) -->
        <div class="mb-3">
            <label for="plat_nomor" class="form-label">Plat Nomor</label>
            <select class="form-control" id="plat_nomor" name="plat_nomor" required>
                <option value="" disabled selected>Pilih Plat Nomor</option>
            </select>
        </div>

        <!-- Tujuan Field -->
        <div class="mb-3">
            <label for="tujuan" class="form-label">Tujuan</label>
            <input type="text" class="form-control" id="tujuan" name="tujuan" required>
        </div>

        <!-- Keberangkatan Field -->
        <div class="mb-3">
            <label for="keberangkatan" class="form-label">Keberangkatan</label>
            <input type="datetime-local" class="form-control" id="keberangkatan" name="keberangkatan" required>
        </div>

        <!-- Kepulangan Field -->
        <div class="mb-3">
            <label for="kepulangan" class="form-label">Kepulangan</label>
            <input type="datetime-local" class="form-control" id="kepulangan" name="kepulangan" required>
        </div>

        <!-- Harga Field -->
        <div class="mb-3">
            <label for="harga" class="form-label">Jumlah Uang</label>
            <input type="text" class="form-control" id="harga" name="harga" required>
        </div>

        <!-- Approval Status Field -->
        <div class="form-check mb-3">
            <!-- Input hidden untuk menangani checkbox yang tidak dicentang -->
            <input type="hidden" name="approval_status" value="0"> 
            <input type="checkbox" class="form-check-input" id="approval_status" name="approval_status" >
            <label class="form-check-label" for="approval_status">Approved</label>
        </div>

        <!-- Nomor Rekening Field -->
        <div class="mb-3">
            <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
            <select class="form-control" id="nomor_rekening" name="nomor_rekening" required>
                <option value="" disabled selected>Pilih Nomor Rekening</option>
                <option value="7940359133 - AA Wiguna">7940359133 - AA Wiguna</option>
            </select>
        </div>

        <!-- Action Buttons -->
        <button type="submit" class="btn btn-success btn-custom">Save</button>
        <a href="{{ route('bop.index') }}" class="btn btn-danger btn-custom">Back</a>
    </form>
</div>

<script>
    // Set tanggal otomatis ke hari ini
    const tanggalInput = document.getElementById('tanggal');
    const today = new Date().toISOString().split('T')[0];
    tanggalInput.value = today;

    // Data plat nomor berdasarkan jenis kendaraan
    const platNomorData = {
        Innova: ["B 1698 NIL", "B 2875 BGZ", "D 1111 NRM"],
        Commuter: ["D 7225 AS", "D 7055 FB", "B 7025 TDB"],
        Premio: ["AD 7011 E", "AD 7191 GD"],
        Avanza: ["D 1669 SAZ"],
        Elf: ["B 7228 TDB"]
    };

    // Dropdown dinamis untuk plat nomor
    const jenisKendaraan = document.getElementById('jenis_kendaraan');
    const platNomor = document.getElementById('plat_nomor');

    jenisKendaraan.addEventListener('change', function () {
        const selectedJenis = this.value;
        platNomor.innerHTML = '<option value="" disabled selected>Pilih Plat Nomor</option>';
        if (platNomorData[selectedJenis]) {
            platNomorData[selectedJenis].forEach(function (plat) {
                const option = document.createElement('option');
                option.value = plat;
                option.textContent = plat;
                platNomor.appendChild(option);
            });
        }
    });

    // Format input harga ke dalam format Rupiah
    const hargaInput = document.getElementById('harga');
    hargaInput.addEventListener('input', function () {
        let value = this.value.replace(/[^,\d]/g, ''); // Hapus semua karakter non-digit
        const numberString = value.toString().split(',')[0];
        const split = numberString.length % 3;
        let rupiah = numberString.substr(0, split);
        const ribuan = numberString.substr(split).match(/\d{3}/g);

        if (ribuan) {
            const separator = split ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        this.value = `Rp ${rupiah}`;
    });
</script>
@endsection
