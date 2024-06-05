<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemParameter extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'beone_system_parameter';

    protected $fillable = [
        'islogactive',
    ];
}
