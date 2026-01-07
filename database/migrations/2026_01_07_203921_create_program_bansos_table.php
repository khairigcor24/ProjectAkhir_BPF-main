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
        Schema::create('program_bansos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program'); // Nama program: BLT Pangan, Bantuan Tunai, dll
            $table->text('deskripsi');
            $table->integer('kuota')->default(0); // Jumlah kuota penerima
            $table->decimal('nominal_bantuan', 15, 2)->nullable(); // Nominal bantuan per penerima
            $table->string('gambar')->nullable(); // Upload gambar program
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->enum('status', ['aktif', 'nonaktif', 'selesai'])->default('aktif');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // Admin yang membuat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_bansos');
    }
};
