<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Nama tabel database
     */
    protected $table = 'tb_user';

    /**
     * Primary key
     */
    protected $primaryKey = 'id_user';

    public $incrementing = true;

    /**
     * Tipe primary key
     */
    protected $keyType = 'int';

    /**
     * Kolom yang boleh diisi
     */
    protected $fillable = [
        'id_user',
        'nama_lengkap',
        'username',
        'password',
        'role',
        'status_aktif',
    ];

    /**
     * Jangan tampilkan password
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Jika tabel tb_user tidak punya created_at
     * dan updated_at.
     */
    public $timestamps = false;

    public function getNameAttribute(): string
    {
        return (string) ($this->attributes['nama_lengkap'] ?? $this->attributes['username'] ?? '');
    }
}
