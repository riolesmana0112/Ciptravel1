<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use Illuminate\Console\Command;
use Carbon\Carbon;

class RefreshAttendance extends Command
{
    protected $signature = 'attendance:refresh';
    protected $description = 'Refresh attendance data every day at midnight';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Ambil semua attendance untuk hari ini dan hapus
        Attendance::whereDate('date', Carbon::today())->delete();

        // Atau Anda bisa menambahkan logika lain, misalnya menambahkan data attendance default
        // Contoh: Attendance::create([...]);

        $this->info('Attendance data refreshed successfully!');
    }
}

