<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_transaksi_insert');

        DB::unprepared("
            CREATE TRIGGER trg_transaksi_insert
            AFTER INSERT ON tb_transaksi
            FOR EACH ROW
            BEGIN
                INSERT INTO tb_log_aktivitas (id_user, aktivitas, waktu_aktivitas)
                VALUES (NEW.id_user, 'Transaksi baru ditambahkan', NOW());
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_transaksi_insert');
    }
};