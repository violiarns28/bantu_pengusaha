<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Menu;
// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // use HasApiTokens;
    use HasFactory, Notifiable;

    protected $table = 'beone_users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor',
        'nama',
        'username',
        'password',
        'email',
        'group_id',
        'site_id',
    ];

    public function canViewMenusParent()
    {
        return
            $this->join('beone_group_access', 'beone_group_access.group_id', '=', $this->group_id)
            ->join('beone_menu', 'beone_group_access.menu_id', '=', 'beone_menu.id')
            ->where('beone_group_access.access_id', 1)
            ->get('beone_menu.*');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
