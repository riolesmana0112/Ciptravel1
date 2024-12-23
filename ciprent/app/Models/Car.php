<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'kendaraan',
        'plat_nomor',
        'car_image',
        'path',
        'status',
        'condition',
        'keterangan',
        'verified',
    ];

    /**
     * Tipe data casting untuk atribut model.
     *
     * @var array
     */
    protected $casts = [
        'verified' => 'boolean', // Cast verified menjadi tipe boolean
    ];

    /**
     * Default nilai atribut untuk model.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'Available', // Status default mobil
        'condition' => 'Good', // Kondisi default mobil
        'verified' => false, // Tidak terverifikasi secara default
    ];

    /**
     * Scope query untuk mobil yang terverifikasi.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVerified($query)
    {
        return $query->where('verified', true);
    }

    /**
     * Scope query untuk mobil dengan status tertentu.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope query untuk mobil berdasarkan kondisi.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $condition
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCondition($query, $condition)
    {
        return $query->where('condition', $condition);
    }
}
