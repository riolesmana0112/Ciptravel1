@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <!-- Page Header -->
    <h2 class="mb-4 text-center">Order Report</h2>

    <!-- Button to Create New Report and Back to Welcome -->
    <div class="mb-3 d-flex justify-content-between">
        <!-- Back Button -->
        <a href="{{ route('car.index') }}" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>
        <!-- Create New Report Button -->
        <a href="{{ route('report.create') }}" class="btn btn-success btn-lg">
            <i class="bi bi-car-front-fill"></i> Create New Report
        </a>
    </div>

    <!-- Table of Reports -->
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
                    <th>Tipe Sewa</th>
                    <th>Keterangan Tipe</th>
                    <th>Harga Sewa</th>
                    <th>DP</th>
                    <th>Approval</th>
                    <th>Bukti Pembayaran</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $report)
                    <tr class="bg-white">
                        <!-- Tanggal Otomatis -->
                        <td>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</td>
                        <td>{{ $report->nama_driver }}</td>
                        <td>{{ $report->jenis_kendaraan }}</td>
                        <td>{{ $report->plat_nomor }}</td>
                        <td>{{ $report->tujuan }}</td>
                        <!-- Keberangkatan -->
                        <td>{{ $report->keberangkatan }}</td>
                        <!-- Kepulangan -->
                        <td>{{ $report->kepulangan }}</td>
                        <td>{{ $report->type_sewa }}</td>
                        <td>{{ $report->keterangan_type }}</td>
                        <td>Rp {{ number_format($report->harga_sewa, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($report->dp, 0, ',', '.') }}</td>
                        <!-- Approval -->
                        <td>
                            <input type="checkbox" {{ $report->approval_status ? 'checked' : '' }} disabled class="verification-checkbox">
                        </td>
                        <td>{{ $report->bukti_pembayaran }}</td>
                        <!-- Actions -->
                        <td class="text-center">
                            <a href="{{ route('report.edit', $report->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('report.destroy', $report->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this report?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="16" class="text-center">No reports found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Custom Styles -->
<style>
    /* Checkbox berwarna biru dan lebih besar */
    .verification-checkbox:checked {
        accent-color: blue;
    }

    .verification-checkbox {
        width: 1.5em;
        height: 1.5em;
    }

    /* Style tabel dan tombol */
    .table td, .table th {
        text-align: center;
        vertical-align: middle;
    }

    .table td, .table th {
        padding: 0.75rem 1rem;
    }

    .btn-lg {
        font-size: 1.25rem;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
</style>
@endsection
