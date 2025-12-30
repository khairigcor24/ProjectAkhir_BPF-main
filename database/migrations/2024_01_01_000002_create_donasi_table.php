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
        Schema::create('donasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_donatur');
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('jenis_donasi', ['uang', 'barang', 'jasa'])->default('uang');
            $table->decimal('jumlah', 15, 2)->nullable(); // Untuk donasi uang
            $table->text('deskripsi_barang')->nullable(); // Untuk donasi barang
            $table->enum('status', ['pending', 'diterima', 'ditolak', 'selesai'])->default('pending');
            $table->text('catatan')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Staff yang memvalidasi
            $table->timestamp('tanggal_donasi')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi');
    }
};

