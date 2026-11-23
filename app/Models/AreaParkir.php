<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AreaParkir extends Model
{
    protected $table = 'tb_area_parkir';

    protected $primaryKey = 'id_area';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_area',
        'nama_area',
        'kapasitas',
        'terisi',
    ];

    protected function casts(): array
    {
        return [
            'id_area' => 'integer',
            'kapasitas' => 'integer',
            'terisi' => 'integer',
        ];
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_area', 'id_area');
    }
}
