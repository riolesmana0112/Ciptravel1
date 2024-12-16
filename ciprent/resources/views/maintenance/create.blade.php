@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Create New Maintenance</h2>
    <form action="{{ route('maintenance.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>

        <div class="mb-3">
            <label for="nama_requestor" class="form-label">Nama Requestor</label>
            <input type="text" class="form-control" id="nama_requestor" name="nama_requestor" required>
        </div>

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

        <div class="mb-3">
            <label for="plat_nomor" class="form-label">Plat Nomor</label>
            <select class="form-control" id="plat_nomor" name="plat_nomor" required>
                <option value="" disabled selected>Pilih Plat Nomor</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
            <select class="form-control" id="nomor_rekening" name="nomor_rekening" required>
                <option value="" disabled selected>Pilih Nomor Rekening</option>
                <option value="2330828440 - Ando">2330828440 - Ando</option>
                <option value="7940359133 - AA Wiguna">7940359133 - AA Wiguna</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="jenis_maintenance" class="form-label">Jenis Maintenance</label>
            <input type="text" class="form-control" id="jenis_maintenance" name="jenis_maintenance" required>
        </div>

        <div class="mb-3">
            <label for="biaya" class="form-label">Biaya</label>
            <input type="number" class="form-control" id="biaya" name="biaya" required>
        </div>

        <div class="mb-3">
            <label for="vendor" class="form-label">Vendor</label>
            <input type="text" class="form-control" id="vendor" name="vendor" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" nullable></textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="approval_status" name="approval_status">
            <label class="form-check-label" for="approval_status">Approved</label>
        </div>

        <button type="submit" class="btn btn-success btn-custom">Save</button>
        <a href="{{ route('maintenance.index') }}" class="btn btn-danger btn-custom">Back</a>
    </form>
</div>

<script>
    // Set tanggal otomatis ke hari ini
    const tanggalInput = document.getElementById('tanggal');
    const today = new Date().toISOString().split('T')[0]; // Format tanggal ke yyyy-mm-dd
    tanggalInput.value = today;

    // Data plat nomor berdasarkan jenis kendaraan
    const platNomorData = {
        Innova: ["B 1698 NIL", "B 2875 BGZ", "D 1111 NRM"],
        Commuter: ["D 7225 AS", "D 7055 FB", "B 7025 TDB"],
        Premio: ["AD 7011 E", "AD 7191 GD"],
        Avanza: ["D 1669 SAZ"],
        Elf: ["B 7228 TDB"]
    };

    // Element dropdown
    const jenisKendaraan = document.getElementById('jenis_kendaraan');
    const platNomor = document.getElementById('plat_nomor');

    // Event listener untuk perubahan pada jenis kendaraan
    jenisKendaraan.addEventListener('change', function () {
        const selectedJenis = this.value;

        // Hapus semua opsi pada plat nomor
        platNomor.innerHTML = '<option value="" disabled selected>Pilih Plat Nomor</option>';

        // Tambahkan opsi berdasarkan jenis kendaraan yang dipilih
        if (platNomorData[selectedJenis]) {
            platNomorData[selectedJenis].forEach(function (plat) {
                const option = document.createElement('option');
                option.value = plat;
                option.textContent = plat;
                platNomor.appendChild(option);
            });
        }
    });
</script>
@endsection