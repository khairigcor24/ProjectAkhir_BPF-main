<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';

    protected $fillable = [
        'nama_donatur',
        'email',
        'telepon',
        'alamat',
        'jenis_donasi',
        'jumlah',
        'deskripsi_barang',
        'status',
        'catatan',
        'user_id',
        'tanggal_donasi',
    ];

    protected $casts = [
        'tanggal_donasi' => 'datetime',
        'jumlah' => 'decimal:2',
    ];

    /**
     * Relasi ke User (Staff yang memvalidasi)
     */
    public function validator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Alias untuk method validator (untuk kompatibilitas)
     */
    public function user()
    {
        return $this->validator();
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan jenis donasi
     */
    public function scopeByJenis($query, $jenis)
    {
        return $query->where('jenis_donasi', $jenis);
    }
}



