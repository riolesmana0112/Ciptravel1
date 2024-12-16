<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Attendance;

class EmployeeController extends Controller
{
    // Menampilkan semua data employee
    public function index()
    {
        $employees = Employee::all(); // Ambil semua data employee
        return view('employee.index', compact('employees')); // Kirim data ke view
    }

    // Menampilkan form untuk menambah employee
    public function create()
    {
        return view('employee.create'); // Form tambah employee
    }

    // Menyimpan data employee baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'birth_date' => 'required|date',
            'position' => 'required|string|max:100',
            'salary' => 'required|string', // Salary sebagai string karena input format nominal
        ]);

        // Format salary ke bentuk angka (menghapus titik)
        $salary = str_replace('.', '', $request->salary);

        // Simpan data ke database
        Employee::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'position' => $request->position,
            'salary' => $salary, // Simpan dalam format angka
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('employee.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit data employee
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.edit', compact('employee'));
    }

    // Mengupdate data employee
    public function update(Request $request, $id)
    {
        // Validasi data dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'birth_date' => 'required|date',
            'position' => 'required|string|max:100',
            'salary' => 'required|string', // Salary dalam format nominal
            'attendance_status' => 'nullable|in:present,absent', // Validasi status kehadiran
        ]);
    
        // Format salary ke angka tanpa titik
        $salary = str_replace('.', '', $request->salary);
    
        // Update data karyawan
        $employee = Employee::findOrFail($id);
        $employee->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'position' => $request->position,
            'salary' => $salary, // Simpan salary dalam format angka
        ]);
    
        // Jika status kehadiran dikirimkan, update status kehadiran
        if ($request->has('attendance_status')) {
            // Cari atau buat data kehadiran untuk hari ini
            $attendance = \App\Models\Attendance::where('employee_id', $employee->id)
                ->whereDate('date', now()->toDateString())
                ->first();
    
            if ($attendance) {
                // Update status kehadiran yang sudah ada
                $attendance->status = $request->attendance_status;
                $attendance->save();
            } else {
                // Jika tidak ada data kehadiran, buat baru
                \App\Models\Attendance::create([
                    'employee_id' => $employee->id,
                    'date' => now()->toDateString(),
                    'status' => $request->attendance_status,
                ]);
            }
        }
    
        // Redirect ke halaman daftar karyawan dengan pesan sukses
        return redirect()->route('employee.index')->with('success', 'Data karyawan dan kehadiran berhasil diperbarui.');
    }

    // Menghapus data employee
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Karyawan berhasil dihapus!');
    }

    // Menandai kehadiran karyawan
    public function markAttendance(Request $request, Employee $employee)
    {
        // Check if an attendance entry already exists for the given employee on the current date
        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($attendance) {
            return redirect()->route('employee.index')->with('error', 'Attendance already marked for today.');
        }

        // Create a new attendance entry
        Attendance::create([
            'employee_id' => $employee->id,
            'status' => $request->input('status'),
            'date' => now(),
        ]);

        return redirect()->route('employee.index')->with('success', 'Attendance marked successfully.');
    }

    // Menampilkan daftar kehadiran
    public function attendance()
    {
        // Mengambil data kehadiran dengan relasi employee
        $attendances = Attendance::with('employee')->orderBy('date', 'desc')->get();

        // Mengirim data ke view attendance
        return view('attendance', compact('attendances'));
    }
}
