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
        Schema::create('tb_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('plat_nomor')->unique();
            $table->string('jenis_kendaraan');
            $table->string('merek');
            $table->string('warna')->nullable();
            $table->string('pemilik');
            $table->string('nomor_telepon')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kendaraan');
    }
};
