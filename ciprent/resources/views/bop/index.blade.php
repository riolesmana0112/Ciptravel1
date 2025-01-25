@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Daftar Biaya Operasional</h1>
    </div>

    <!-- Navigation Buttons -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Back Button -->
        <a href="{{ route('car.index') }}" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>

        <!-- Button: Create New BOP -->
        <div class="d-flex gap-3">
            <a href="{{ route('bop.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-plus-circle-fill"></i> Create New BOP
            </a>
        </div>
    </div>

    <!-- BOP Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Driver</th>
                    <th>Jenis Kendaraan</th>
                    <th>Plat Nomor</th>
                    <th>Tujuan</th>
                    <th>Keberangkatan</th>
                    <th>Kepulangan</th>
                    <th>Jumlah Uang</th>
                    <th>Nomor Rekening</th>
                    <th>Approval</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bops as $bop)
                    <tr class="bg-white">
                        <td>{{ $bop->tanggal }}</td>
                        <td>{{ $bop->nama_driver }}</td>
                        <td>{{ $bop->jenis_kendaraan }}</td>
                        <td>{{ $bop->plat_nomor }}</td>
                        <td>{{ $bop->tujuan }}</td>
                        <td>{{ $bop->keberangkatan ?? '-' }}</td>
                        <td>{{ $bop->kepulangan ?? '-' }}</td>
                        <td>{{ $bop->harga ? 'Rp ' . number_format($bop->harga, 0, ',', '.') : '-' }}</td>
                        <td>{{ $bop->nomor_rekening ?? '-' }}</td>
                        <td class="text-center">
                            <input type="checkbox" class="form-check-input"
                                   {{ $bop->approval_status == 1 ? 'checked' : '' }}
                                   disabled 
                                   style="transform: scale(1.5); cursor: not-allowed;">
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('bop.edit', $bop->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('bop.destroy', $bop->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Custom Styles -->
<style>
    /* Style for Table */
    .table th, .table td {
        text-align: center;
        vertical-align: middle;
        padding: 0.75rem;
    }

    /* Checkbox Style */
    .form-check-input {
        width: 1.25rem;
        height: 1.25rem;
    }

    /* Hover Effect for Table Rows */
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Button Size */
    .btn-lg {
        font-size: 1.25rem;
    }
</style>
@endsection
