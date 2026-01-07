<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penerima_bansos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_bansos_id')->constrained('program_bansos')->onDelete('cascade');
            $table->string('nik', 16)->unique(); // NIK penerima
            $table->string('nama_lengkap');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->text('alamat');
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota_kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->integer('jumlah_anggota_keluarga')->default(1);
            $table->decimal('penghasilan_perbulan', 15, 2)->nullable();
            $table->enum('status_ekonomi', ['sangat_miskin', 'miskin', 'menengah_bawah', 'menengah'])->nullable();
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->longText('dokumen_pendukung')->nullable(); // Array file dokumen (KTP, KK, dll)
            $table->enum('status_verifikasi', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->text('catatan_verifikasi')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null'); // Staff/Admin yang memverifikasi
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // User yang membuat pendaftaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima_bansos');
    }
};
