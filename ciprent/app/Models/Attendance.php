<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'status', // 'present', 'absent', etc.
        'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

