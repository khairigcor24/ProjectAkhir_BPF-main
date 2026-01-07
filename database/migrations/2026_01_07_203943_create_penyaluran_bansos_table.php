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
        Schema::create('penyaluran_bansos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerima_bansos_id')->constrained('penerima_bansos')->onDelete('cascade');
            $table->foreignId('program_bansos_id')->constrained('program_bansos')->onDelete('cascade');
            $table->decimal('nominal_diterima', 15, 2);
            $table->enum('metode_penyaluran', ['transfer', 'tunai', 'voucher', 'barang'])->default('transfer');
            $table->string('no_rekening')->nullable(); // Untuk transfer
            $table->string('nama_bank')->nullable();
            $table->string('bukti_penyaluran')->nullable(); // Upload bukti penyaluran
            $table->date('tanggal_penyaluran');
            $table->enum('status', ['dijadwalkan', 'diproses', 'disalurkan', 'gagal'])->default('dijadwalkan');
            $table->text('catatan')->nullable();
            $table->foreignId('disalurkan_oleh')->nullable()->constrained('users')->onDelete('set null'); // Staff/Admin yang menyalurkan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyaluran_bansos');
    }
};
