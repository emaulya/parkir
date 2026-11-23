<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kendaraan extends Model
{
    protected $table = 'tb_kendaraan';

    protected $primaryKey = 'id_kendaraan';

    public $timestamps = false;

    protected $fillable = [
        'id_kendaraan',
        'plat_nomor',
        'jenis_kendaraan',
        'warna',
        'pemilik',
        'id_user',
    ];

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_kendaraan', 'id_kendaraan');
    }
}
