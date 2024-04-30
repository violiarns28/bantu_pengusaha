<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRISPresensi extends Model
{
    use HasFactory;

    protected $table = 'hris_presensi';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nomor_user',
        'tanggal',
        'clock_in',
        'clock_out',
        'latitude',
        'longitude',
        'lokasi_presensi',
        'keterangan',
        'foto_clock_in',
        'foto_clock_out',
        'hardware_id',
        'created_at',
        'updated_at',
    ];
}
