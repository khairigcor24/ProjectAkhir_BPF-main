<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BansosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\Bansos::create([
    'nama_bantuan' => 'Bantuan Langsung Tunai (BLT)',
    'deskripsi' => 'Bantuan uang tunai untuk keluarga terdampak ekonomi.',
    'kuota' => 100,
    'status' => 'aktif'
    ]);
    }
}
