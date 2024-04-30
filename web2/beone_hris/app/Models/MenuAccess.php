<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAccess extends Model
{
    use HasFactory;

    protected $table = 'beone_menu_access';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'access_id',
        'menu_id',
    ];
}
