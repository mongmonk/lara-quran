<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalSholatHarian extends Model
{
    protected $table = 'jadwal_sholat_harian';

    protected $fillable = [
        'nama_masjid',
        'alamat',
        'img',
        'adzan',
        'pesan1',
        'pesan2',
        'id_kota',
        'url',
        'chat_id',
    ];

    protected $casts = [
        'id_kota' => 'integer',
    ];
}
