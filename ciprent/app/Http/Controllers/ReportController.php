<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Menampilkan daftar laporan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $reports = Report::all();
        return view('report.index', compact('reports'));
    }

    /**
     * Menampilkan form untuk membuat laporan baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('report.create');
    }

    /**
     * Menyimpan laporan baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'tanggal' => 'required|date',
            'nama_driver' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'keberangkatan' => 'required|date',
            'kepulangan' => 'required|date',
            'type_sewa' => 'required|string',
            'harga_sewa' => 'required|numeric',
            'dp' => 'required|numeric',
            'bukti_pembayaran' => 'nullable|string|max:255',
            'approval_status' => 'nullable|boolean',
            'keterangan_type' => 'nullable|string|max:500',
        ]);

        // Simpan data ke database
        Report::create([
            'tanggal' => $request->tanggal,
            'nama_driver' => $request->nama_driver,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'plat_nomor' => $request->plat_nomor,
            'tujuan' => $request->tujuan,
            'keberangkatan' => $request->keberangkatan,
            'kepulangan' => $request->kepulangan,
            'type_sewa' => $request->type_sewa,
            'keterangan_type' => $request->keterangan_type,
            'harga_sewa' => $request->harga_sewa,
            'dp' => $request->dp,
            'bukti_pembayaran' => $request->bukti_pembayaran,
            'approval_status' => $request->approval_status == '1', // Konversi ke boolean
        ]);

        return redirect()->route('report.index')->with('success', 'Laporan berhasil dibuat');
    }

    /**
     * Menampilkan form untuk mengedit laporan.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $report = Report::findOrFail($id);
        return view('report.edit', compact('report'));
    }

    /**
     * Memperbarui laporan yang sudah ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'tanggal' => 'required|date',
            'nama_driver' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'keberangkatan' => 'required|date',
            'kepulangan' => 'required|date',
            'type_sewa' => 'required|string',
            'harga_sewa' => 'required|numeric',
            'dp' => 'required|numeric',
            'bukti_pembayaran' => 'nullable|string|max:255',
            'approval_status' => 'nullable|boolean',
            'keterangan_type' => 'nullable|string|max:500',
        ]);

        // Cari data yang akan diupdate
        $report = Report::findOrFail($id);

        // Update data di database
        $report->update([
            'tanggal' => $request->tanggal,
            'nama_driver' => $request->nama_driver,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'plat_nomor' => $request->plat_nomor,
            'tujuan' => $request->tujuan,
            'keberangkatan' => $request->keberangkatan,
            'kepulangan' => $request->kepulangan,
            'type_sewa' => $request->type_sewa,
            'keterangan_type' => $request->keterangan_type,
            'harga_sewa' => $request->harga_sewa,
            'dp' => $request->dp,
            'bukti_pembayaran' => $request->bukti_pembayaran,
            'approval_status' => $request->approval_status == '1', // Konversi ke boolean
        ]);

        return redirect()->route('report.index')->with('success', 'Laporan berhasil diperbarui');
    }

    /**
     * Menghapus laporan yang sudah ada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('report.index')->with('success', 'Laporan berhasil dihapus');
    }
}
