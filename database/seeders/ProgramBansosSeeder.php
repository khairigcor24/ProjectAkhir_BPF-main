<?php

namespace Database\Seeders;

use App\Models\ProgramBansos;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProgramBansosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil admin pertama sebagai creator
        $admin = User::where('role', 'admin')->first();

        $programs = [
            [
                'nama_program' => 'BLT Pangan (Bantuan Langsung Tunai Pangan)',
                'deskripsi' => 'Bantuan langsung tunai untuk kebutuhan pangan bagi keluarga kurang mampu. Program ini bertujuan untuk membantu memenuhi kebutuhan pokok keluarga yang terdampak secara ekonomi.',
                'kuota' => 500,
                'nominal_bantuan' => 300000,
                'tanggal_mulai' => now()->format('Y-m-d'),
                'tanggal_selesai' => now()->addMonths(3)->format('Y-m-d'),
                'status' => 'aktif',
                'created_by' => $admin->id ?? 1,
            ],
            [
                'nama_program' => 'Bantuan Tunai Desa',
                'deskripsi' => 'Program bantuan tunai untuk warga desa yang memenuhi kriteria sebagai keluarga prasejahtera. Bantuan diberikan untuk meningkatkan kesejahteraan keluarga.',
                'kuota' => 300,
                'nominal_bantuan' => 500000,
                'tanggal_mulai' => now()->format('Y-m-d'),
                'tanggal_selesai' => now()->addMonths(6)->format('Y-m-d'),
                'status' => 'aktif',
                'created_by' => $admin->id ?? 1,
            ],
            [
                'nama_program' => 'Bantuan Sembako',
                'deskripsi' => 'Program bantuan sembako untuk keluarga kurang mampu. Bantuan diberikan dalam bentuk paket sembako yang meliputi beras, minyak, gula, dan kebutuhan pokok lainnya.',
                'kuota' => 200,
                'nominal_bantuan' => 250000,
                'tanggal_mulai' => now()->format('Y-m-d'),
                'tanggal_selesai' => now()->addMonths(2)->format('Y-m-d'),
                'status' => 'aktif',
                'created_by' => $admin->id ?? 1,
            ],
            [
                'nama_program' => 'Bantuan Anak Yatim',
                'deskripsi' => 'Program khusus bantuan untuk anak yatim. Bantuan diberikan untuk memenuhi kebutuhan pendidikan dan kehidupan sehari-hari.',
                'kuota' => 100,
                'nominal_bantuan' => 400000,
                'tanggal_mulai' => now()->format('Y-m-d'),
                'tanggal_selesai' => now()->addYear()->format('Y-m-d'),
                'status' => 'aktif',
                'created_by' => $admin->id ?? 1,
            ],
            [
                'nama_program' => 'Bantuan Lansia',
                'deskripsi' => 'Program bantuan khusus untuk lansia (lanjut usia) yang membutuhkan. Bantuan diberikan untuk memenuhi kebutuhan hidup sehari-hari dan kesehatan.',
                'kuota' => 150,
                'nominal_bantuan' => 350000,
                'tanggal_mulai' => now()->format('Y-m-d'),
                'tanggal_selesai' => now()->addMonths(4)->format('Y-m-d'),
                'status' => 'aktif',
                'created_by' => $admin->id ?? 1,
            ],
        ];

        foreach ($programs as $program) {
            ProgramBansos::create($program);
        }
    }
}
