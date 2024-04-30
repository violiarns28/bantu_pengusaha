<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Access;
use App\Models\MenuAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuAccessController extends Controller
{
    public function index(Request $request)
    {
        $route = '/masterMenuAccess';
        $menu_id = Menu::where('route_menu', $route)->first()->id;
        $this->authorize('view', Menu::find($menu_id));

        $listmenu = Menu::all();
        $listaccess = Access::all();
        $listmenuaccess = MenuAccess::all();

        return view('master.menu_access')
        ->with(compact('listmenu'))
        ->with(compact('listaccess'))
        ->with(compact('listmenuaccess'));
    }
    
    public function updatemenuaccessdata(Request $request)
    {
    DB::beginTransaction();
    try {
        $route = '/masterMenuAccess';
        $menu_id = Menu::where('route_menu', $route)->first()->id;
        $this->authorize('update', Menu::find($menu_id));
        
        $menu_access = $request->input('menu_access');

        MenuAccess::truncate();

        foreach ($menu_access as $ma){
            $dashindex = strpos($ma, "-");

            $MenuID = substr($ma, 0, $dashindex);
            $AccessID = substr($ma,$dashindex+1);

            MenuAccess::create([
                'menu_id' => $MenuID,
                'access_id' => $AccessID,
            ]);
        }
        
        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Data Menu Access Berhasil Diupdate!',
            'code'    => 200,
            'icon'    => 'success'  
        ]);
    }catch (\Exception $e) {
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
