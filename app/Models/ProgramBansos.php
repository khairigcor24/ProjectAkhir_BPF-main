<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramBansos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_program',
        'deskripsi',
        'kuota',
        'nominal_bantuan',
        'gambar',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'created_by',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'nominal_bantuan' => 'decimal:2',
    ];

    /**
     * Relasi ke User (Admin yang membuat program)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relasi ke Penerima Bansos
     */
    public function penerima()
    {
        return $this->hasMany(PenerimaBansos::class, 'program_bansos_id');
    }

    /**
     * Relasi ke Penyaluran Bansos
     */
    public function penyaluran()
    {
        return $this->hasMany(PenyaluranBansos::class, 'program_bansos_id');
    }

    /**
     * Scope untuk program aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope untuk program berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Cek apakah program masih memiliki kuota
     */
    public function hasQuota(): bool
    {
        $terpakai = $this->penerima()->where('status_verifikasi', 'diterima')->count();
        return $terpakai < $this->kuota;
    }

    /**
     * Hitung kuota tersisa
     */
    public function getKuotaTersisaAttribute(): int
    {
        $terpakai = $this->penerima()->where('status_verifikasi', 'diterima')->count();
        return max(0, $this->kuota - $terpakai);
    }
}
