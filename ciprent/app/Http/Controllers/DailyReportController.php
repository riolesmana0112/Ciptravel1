<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    public function index()
    {
        $reports = DailyReport::all();
        return view('daily_report.index', compact('reports'));
    }

    public function create()
    {
        return view('daily_report.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'driver_name' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'keberangkatan' => 'required|date',
            'kepulangan' => 'required|date',
            'tujuan' => 'required|string|max:255',
        ]);

        DailyReport::create($validatedData);

        return redirect()->route('daily_report.index')->with('success', 'Daily report created successfully!');
    }

    public function edit($id)
    {
        $report = DailyReport::findOrFail($id);
        return view('daily_report.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'driver_name' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'keberangkatan' => 'required|date',
            'kepulangan' => 'required|date',
            'tujuan' => 'required|string|max:255',
        ]);

        $report = DailyReport::findOrFail($id);
        $report->update($validatedData);

        return redirect()->route('daily_report.index')->with('success', 'Daily report updated successfully!');
    }

    public function destroy($id)
    {
        $report = DailyReport::findOrFail($id);
        $report->delete();

        return redirect()->route('daily_report.index')->with('success', 'Daily report deleted successfully!');
    }

    public function show($id)
    {
        $report = DailyReport::findOrFail($id);
        return view('daily_report.show', compact('report'));
    }
}