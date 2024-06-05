<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRISLembur extends Model
{
    use HasFactory;

    protected $table = 'hris_lembur';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nomor_user',
        'tanggal',
        'jenis_pengajuan',
        'jenis_lembur',
        'waktu',
        'waktu2',
        'keterangan',
        'approve_by',
        'approve_at',
        'status_approve',
        'total_jam_lembur',
    ];
}
