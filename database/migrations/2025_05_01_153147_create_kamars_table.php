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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            // $table->id();
            $table->string('nomor_kamar');
            $table->string('gambar_url');
            $table->string('public_id');
            $table->enum('ac', ['tersedia', 'tidak tersedia']);
            $table->enum('wifi', ['tersedia', 'tidak tersedia']);
            $table->enum('televisi', ['tersedia', 'tidak tersedia']);
            $table->enum('penjemputan', ['tersedia', 'tidak tersedia']);
            // $table->enum('status', ['tersedia', 'telah dipesan'])->default('tersedia');
            $table->enum('status', ['tersedia', 'terjadwal', 'telah dipesan'])->default('tersedia');
            $table->string('kapasitas')->default('2 Orang');

            $table->enum('tipe_kelas', ['reguler', 'VIP', 'VVIP']); // <--- baris tambahan
            $table->foreignId('penginapan_id')->constrained()->onDelete('cascade');            
            // $table->timestamps();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
