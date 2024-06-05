<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRISRekapPresensi extends Model
{
    use HasFactory;

    protected $table = 'hris_rekap_presensi';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nomor_user',
        'tanggal',
        'tipe_schedule',
        'keterangan_status',
        'schedule_clock_in',
        'schedule_clock_out',
        'clock_in',
        'clock_out',
        'koreksi_clock_in',
        'koreksi_clock_out',
        'icon',
        'class_badge',
        'total_jam_kerja',
        'hitung_hari_kerja',
    ];
}
