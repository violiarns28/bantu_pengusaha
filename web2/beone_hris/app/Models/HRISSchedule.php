<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRISSchedule extends Model
{
    use HasFactory;

    protected $table = 'hris_schedule';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'tipe_schedule',
        'nomor_user',
        'tanggal',
        'clock_in',
        'clock_out',
        'created_at',
        'updated_at',
    ];
}
