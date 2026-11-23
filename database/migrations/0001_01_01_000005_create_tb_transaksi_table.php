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
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->constrained('tb_kendaraan')->onDelete('cascade');
            $table->foreignId('area_parkir_id')->constrained('tb_area_parkir')->onDelete('cascade');
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar')->nullable();
            $table->integer('durasi_jam')->nullable();
            $table->decimal('tarif', 10, 2);
            $table->decimal('biaya_total', 10, 2)->default(0);
            $table->string('status')->default('aktif'); // aktif, selesai
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi');
    }
};
