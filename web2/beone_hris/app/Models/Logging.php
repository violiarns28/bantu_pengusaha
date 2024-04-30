<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logging extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'beone_log';

    protected $fillable = [
        'table',
        'user',
        'pkidint', //affected row ID
        'pkidstr',
        'action',
        'keterangan',
    ];
}
