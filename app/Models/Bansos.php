<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bansos extends Model
{
    protected $fillable = [
        'nama_bantuan',
        'deskripsi',
        'kuota',
        'gambar',
        'status',
    ];
}
