<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use App\Models\GroupAccess;
use RealRashid\SweetAlert\Facades\Alert;

class GroupAccessController extends Controller
{
    public function getonegroupaccess($GroupID)
    {
        $onegroupaccess = GroupAccess::where('group_id','=',$GroupID)->get();

        return response()->json($onegroupaccess, 200);
    }

    public function updategroupaccessdata(Request $request)
    {
        DB::beginTransaction();
        try {   
        $route = '/masterGroup';
        $menu_id = Menu::where('route_menu', $route)->first()->id;
        $this->authorize('update', Menu::find($menu_id));

        $group_menu_access = $request->input('group_menu_access');
        $group_id = $request->input('editGroupID');

        GroupAccess::where('group_id','=', $group_id)->delete();

        foreach ($group_menu_access as $gma){
            $dashindex1 = strpos($gma, "-");
            $dashindex2 = strripos($gma, "-");
            $midrange = $dashindex2-$dashindex1;

            $GroupID = substr($gma, 0, $dashindex1);
            $MenuID = substr($gma, $dashindex1+1, $midrange-1);
            $AccessID = substr($gma,$dashindex2+1);

            GroupAccess::create([
                'group_id' => $GroupID,
                'menu_id' => $MenuID,
                'access_id' => $AccessID,
            ]);
        }
        DB::commit();
        //add log
        // $UserLogin = $request->session()->get('UserLogin');
        // $this->addLog("groupaccess", $UserLogin, "[banyak]", "update", "Update group access");

        return response()->json([
            'success' => true,
            'message' => 'Role Group Berhasil Update!',
            'code'    => 200,
            'icon'    => 'success'  
        ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 400 ,
                'icon'    => 'error' 
            ]);
        }

    }
}
