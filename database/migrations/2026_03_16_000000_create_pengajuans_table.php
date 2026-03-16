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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nasabah');
            $table->enum('tipe_pengajuan', ['Sepeda Motor', 'Mobil', 'Multiguna']);
            $table->decimal('nominal_pengajuan', 15, 2);
            $table->integer('tenor');
            $table->decimal('pendapatan_bulanan', 15, 2);
            $table->text('catatan')->nullable();
            $table->enum('status', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
