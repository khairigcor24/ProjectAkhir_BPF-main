<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaBansos extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_bansos_id',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kota_kabupaten',
        'provinsi',
        'telepon',
        'email',
        'jumlah_anggota_keluarga',
        'penghasilan_perbulan',
        'status_ekonomi',
        'keterangan',
        'dokumen_pendukung',
        'status_verifikasi',
        'catatan_verifikasi',
        'verified_by',
        'tanggal_verifikasi',
        'created_by',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_verifikasi' => 'datetime',
        'penghasilan_perbulan' => 'decimal:2',
        'dokumen_pendukung' => 'array',
    ];

    /**
     * Relasi ke Program Bansos
     */
    public function programBansos()
    {
        return $this->belongsTo(ProgramBansos::class, 'program_bansos_id');
    }

    /**
     * Relasi ke User (Staff/Admin yang memverifikasi)
     */
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Relasi ke User (User yang membuat pendaftaran)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relasi ke Penyaluran Bansos
     */
    public function penyaluran()
    {
        return $this->hasMany(PenyaluranBansos::class, 'penerima_bansos_id');
    }

    /**
     * Scope untuk penerima yang sudah diverifikasi
     */
    public function scopeTerverifikasi($query)
    {
        return $query->where('status_verifikasi', 'diterima');
    }

    /**
     * Scope untuk penerima berdasarkan status verifikasi
     */
    public function scopeByStatusVerifikasi($query, $status)
    {
        return $query->where('status_verifikasi', $status);
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function($q) use ($keyword) {
            $q->where('nama_lengkap', 'like', "%{$keyword}%")
              ->orWhere('nik', 'like', "%{$keyword}%")
              ->orWhere('alamat', 'like', "%{$keyword}%");
        });
    }

    /**
     * Cek apakah sudah memiliki penyaluran
     */
    public function hasPenyaluran(): bool
    {
        return $this->penyaluran()->where('status', 'disalurkan')->exists();
    }
}
