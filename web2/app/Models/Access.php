<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    protected $table = 'beone_access';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama',
    ];
}
