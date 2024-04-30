<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use App\Models\Group;
use App\Models\Site;
use App\Models\SystemParameter;
use App\Models\SiteAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\loggingTrait;

class SiteAccessController extends Controller
{
    use loggingTrait;

    public function index(Request $request)
    {
        $route = '/siteAccess';
        $menu_id = Menu::where('route_menu', $route)->first()->id;
        $this->authorize('view', Menu::find($menu_id));

        $listSiteAccess = SiteAccess::all();
        $listSite = Site::all();

        return view('master.siteaccess')
        ->with(compact('listSiteAccess'))
        ->with(compact('listSite'));
    }


    public function getonesiteaccessdata($id){
        $result = SiteAccess::join('beone_users','beone_users.id','=','beone_site_access.user_id')
                    ->join('beone_site','beone_site.id','=','beone_site_access.site_id')
                    ->where('beone_site_access.user_id', $id)
                    ->select('beone_site_access.*','beone_users.nama as nama_user','beone_site.nama as nama_site')
                    ->get();
        return response()->json($result);
    }
    

    public function getsiteaccessdata(Request $request){
 
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
    
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
    
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $nama = $request->get('nama');
   
        // Total records
        $totalRecords = User::select('count(*) as allcount')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')
        ->where(function($query) use ($request)
            {
                if ($request->has('nama')  &&  $request->input('nama') != '') {
                    $query->where('beone_users.nama','like', '%'.  $request->input('nama').'%');
                }
            })
        // ->whereIn('beone_users.site_id',$list_site_id)
        ->select('beone_users.*')
        ->count();
   
   
        // Fetch records
        $records = User::orderBy('beone_users.nama',$columnSortOrder)
        ->leftJoin('beone_site_access', 'beone_users.id', '=', 'beone_site_access.user_id')
        ->leftJoin('beone_site', 'beone_site.id', '=', 'beone_site_access.site_id')
        ->where(function($query) use ($request)
               {
                   if ($request->has('nama')  &&  $request->input('nama') != '') {
                       $query->where('beone_users.nama','like', '%'.  $request->input('nama').'%');
                   }
               })
        //   ->whereIn('beone_users.site_id',$list_site_id)
        ->select('beone_users.id','beone_users.nomor','beone_users.nama', DB::raw('GROUP_CONCAT(beone_site.nama SEPARATOR ", ") as sites'))
        ->groupBy('beone_users.id','beone_users.nama','beone_users.nomor' )
        ->skip($start)
        ->take($rowperpage)
        ->get();
          
   
       $data = [
           'data' => $records,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalRecordswithFilter,
       ];
       return response()->json($data, 200);
       }


    public function updatesiteaccessdata(Request $request)
    {
        DB::beginTransaction();
        try {   
        $route = '/siteAccess';
        $menu_id = Menu::where('route_menu', $route)->first()->id;
        $this->authorize('update', Menu::find($menu_id));

        $site_access = $request->input('site_access');
        $user_id = $request->input('editUserID');

        SiteAccess::where('user_id','=', $user_id)->delete();

        if ($site_access != null){
            foreach ($site_access as $sa){
                $site_id = $sa;
    
                SiteAccess::create([
                    'user_id' => $user_id,
                    'site_id' => $site_id,
                ]);
            }
        }
        
        DB::commit();
        //add log
        // $UserLogin = $request->session()->get('UserLogin');
        // $this->addLog("groupaccess", $UserLogin, "[banyak]", "update", "Update group access");

        return response()->json([
            'success' => true,
            'message' => 'Site Access Berhasil Update!',
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
