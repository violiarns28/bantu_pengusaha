<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRISGlobalLock extends Model
{
    use HasFactory;

    protected $table = 'hris_global_lock';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'tanggal_lock',
        'created_by',
        'created_at',
        'updated_at',
    ];
}
