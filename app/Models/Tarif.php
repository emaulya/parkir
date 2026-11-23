<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tb_tarif';

    protected $primaryKey = 'id_tarif';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_tarif',
        'jenis_kendaraan',
        'tarif_per_jam',
    ];

    protected function casts(): array
    {
        return [
            'id_tarif' => 'integer',
            'tarif_per_jam' => 'decimal:2',
        ];
    }
}
