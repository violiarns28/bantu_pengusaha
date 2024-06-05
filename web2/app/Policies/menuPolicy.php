<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Menu;
use App\Models\groupAccess;
use Illuminate\Auth\Access\HandlesAuthorization;

class menuPolicy
{
    use HandlesAuthorization;

   /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Menu $menu)
    {
        $access = groupAccess::where('group_id', $user->group_id)
                ->where('menu_id',$menu->id)
                ->where('access_id',1)
                ->first();
        if ($access) return true;
        else return false;
    }

    public function create(User $user, Menu $menu)
    {
        $access = groupAccess::where('group_id', $user->group_id)
                ->where('menu_id',$menu->id)
                ->where('access_id',2)
                ->first();
        if ($access) return true;
        else return false;
    }

    public function update(User $user, Menu $menu)
    {
        $access = groupAccess::where('group_id', $user->group_id)
                ->where('menu_id',7)
                ->where('access_id',3)
                ->first();
        if ($access) return true;
        else return false;
    }

    public function delete(User $user, Menu $menu)
    {
        $access = groupAccess::where('group_id', $user->group_id)
                ->where('menu_id',$menu->id)
                ->where('access_id',4)
                ->first();
        if ($access) return true;
        else return false;
    }
}
