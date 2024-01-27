<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
    use HasFactory;

    protected $table = 'jadwal_periksa';

    protected $fillable = [
        'id_dokter',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'aktif',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function daftar_polis()
    {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal');
    }
}
