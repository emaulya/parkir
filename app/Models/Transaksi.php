<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $table = 'tb_transaksi';

    protected $primaryKey = 'id_parkir';

    public $timestamps = false;

    protected $fillable = [
        'id_parkir',
        'id_kendaraan',
        'waktu_masuk',
        'waktu_keluar',
        'id_tarif',
        'durasi_jam',
        'total_biaya',
        'status',
        'id_user',
        'id_area',
    ];

    protected function casts(): array
    {
        return [
            'waktu_masuk' => 'datetime',
            'waktu_keluar' => 'datetime',
            'durasi_jam' => 'integer',
            'id_tarif' => 'integer',
            'total_biaya' => 'decimal:2',
            'id_user' => 'integer',
            'id_area' => 'integer',
        ];
    }

    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id_kendaraan');
    }

    public function areaParkir(): BelongsTo
    {
        return $this->belongsTo(AreaParkir::class, 'id_area', 'id_area');
    }
}
