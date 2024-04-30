<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRISKodePresensi extends Model
{
    use HasFactory;

    protected $table = 'hris_kode_presensi';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'kode_presensi',
        'keterangan',
        'hitung_hari_kerja',
    ];
}
