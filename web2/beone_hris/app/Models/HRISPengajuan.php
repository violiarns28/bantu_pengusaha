<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRISPengajuan extends Model
{
    use HasFactory;

    protected $table = 'hris_pengajuan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nomor_user',
        'tanggal',
        'tanggal2',
        'jenis_pengajuan',
        'waktu',
        'keterangan',
        'approve_by',
        'approve_at',
        'status_approve',
    ];
}