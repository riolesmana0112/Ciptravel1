<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'birth_date',
        'position',
        'salary',
    ];

    // Define the relationship with the Attendance model
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Check if the employee has attended today
    public function hasAttendedToday()
    {
        return $this->attendances()
                    ->whereDate('date', now()->toDateString())
                    ->exists();
    }
}
