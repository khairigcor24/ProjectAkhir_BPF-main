<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyaluranBansos extends Model
{
    use HasFactory;

    protected $fillable = [
        'penerima_bansos_id',
        'program_bansos_id',
        'nominal_diterima',
        'metode_penyaluran',
        'no_rekening',
        'nama_bank',
        'bukti_penyaluran',
        'tanggal_penyaluran',
        'status',
        'catatan',
        'disalurkan_oleh',
    ];

    protected $casts = [
        'tanggal_penyaluran' => 'date',
        'nominal_diterima' => 'decimal:2',
    ];

    /**
     * Relasi ke Penerima Bansos
     */
    public function penerimaBansos()
    {
        return $this->belongsTo(PenerimaBansos::class, 'penerima_bansos_id');
    }

    /**
     * Relasi ke Program Bansos
     */
    public function programBansos()
    {
        return $this->belongsTo(ProgramBansos::class, 'program_bansos_id');
    }

    /**
     * Relasi ke User (Staff/Admin yang menyalurkan)
     */
    public function distributor()
    {
        return $this->belongsTo(User::class, 'disalurkan_oleh');
    }

    /**
     * Scope untuk penyaluran berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk penyaluran berdasarkan metode
     */
    public function scopeByMetode($query, $metode)
    {
        return $query->where('metode_penyaluran', $metode);
    }
}
