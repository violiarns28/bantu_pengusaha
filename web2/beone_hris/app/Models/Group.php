<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'beone_group';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama',
    ];
}
