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
        Schema::create('orders', function (Blueprint $table) {
            // Membuat kolom UUID sebagai primary key
            $table->uuid('id')->primary(); // Kolom UUID untuk ID
            $table->string('no_transaction');
            $table->string('external_id');
            $table->string('item_name');
            $table->integer('qty');
            $table->decimal('price', 10, 2);
            $table->decimal('grand_total', 10, 2)->nullable();
            $table->string('invoice_url')->nullable();
            $table->string('status')->default('pending'); // Menambahkan status untuk order
            // belum
            // sesuai dengan kolom id di kamars
            // belum
            $table->integer('jumlah_hari')->nullable();
            $table->date('checkin')->nullable();  // ✅ Tambah ini
            $table->date('checkout')->nullable();
            $table->timestamp('jatuh_tempo')->nullable();
            // belum
            $table->string('name');
            $table->string('email');
            $table->string('no_telp');
            // batas
            $table->timestamps(); // Tanggal pembuatan dan update
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('kamar_id')->nullable(); 
            $table->foreign('kamar_id')->references('id')->on('kamars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
