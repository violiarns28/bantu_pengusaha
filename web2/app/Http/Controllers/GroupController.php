<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Menu;
use App\Models\GroupAccess;
use App\Models\Access;
use App\Models\MenuAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $route = '/masterGroup';
        $menu_id = Menu::where('route_menu', $route)->first()->id;
        $this->authorize('view', Menu::find($menu_id));
            
        $listmenu = Menu::all();
        $listgroupaccess = GroupAccess::all();
        $listaccess = Access::all();
        $listmenuaccess = MenuAccess::all();

        // $UserLogin = $request->session()->get('iduser');
        // $this->addLog("Group", $UserLogin, '', "View", "view group list");

        return view('master.group')
        ->with(compact('listmenu'))
        ->with(compact('listgroupaccess'))
        ->with(compact('listaccess'))
        ->with(compact('listmenuaccess'));
    }

    public function getgroupdata(Request $request){
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
        $totalRecords = Group::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Group::select('count(*) as allcount')
        ->where(function($query) use ($request)
            {
                if ($request->has('nama')  &&  $request->input('nama') != '') {
                    $query->where('nama','like', '%'.  $request->input('nama').'%');
                }
            })
        ->select('beone_group.*')
        ->count();
   
   
        // Fetch records
        $records = Group::orderBy('nama',$columnSortOrder)
           ->where(function($query) use ($request)
               {
                   if ($request->has('nama')  &&  $request->input('nama') != '') {
                       $query->where('nama','like', '%'.  $request->input('nama').'%');
                   }
               })
          ->select('beone_group.*')
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


       public function insertgroupdata(Request $request){
        DB::beginTransaction();
        try {
            $route = '/masterGroup';
            $menu_id = Menu::where('route_menu', $route)->first()->id;
            $this->authorize('create', Menu::find($menu_id));

            $input = $request->all();
    
            $input['nama'] = $input['nama'];
    
            Group::create($input);
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Data Group '.$input['nama'].' Berhasil Ditambahkan!',
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
    
        public function getonegroupdata($id)
        {
            $data = Group::where('id', $id)->get();
            return response()->json($data);
        }
    
        public function updategroupdata(Request $request)
        {
            DB::beginTransaction();
    
            try {
                $route = '/masterGroup';
                $menu_id = Menu::where('route_menu', $route)->first()->id;
                $this->authorize('update', Menu::find($menu_id));

                $group = Group::where('id', $request->input('editID'))->first();
                $rules = [
                    'editNama' => 'required'
                ];
                $this->validate($request,$rules);
    
                $dataupdate = Group::where('id',$request->input('editID'))->update([
                    'nama' => $request->input('editNama'),
                ]);
    
                //add log
                // $this->addLog("users", session()->get('username'), $user->id, "", "Update", "Updated Data User ".$request->input('editUsername'));
                
                DB::commit();
    
                return response()->json([
                    'success' => true,
                    'message' => 'Data Group '.$request->input('editNama').' Berhasil Update!',
                    'code'    => 200,
                    'icon'    => 'success'  
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                    'code'    => 400 ,
                    'icon'    => 'error' 
                ]);
            }
        }
    
        public function deletegroup($id)
        {
            DB::beginTransaction();
    
            try {
                $route = '/masterGroup';
                $menu_id = Menu::where('route_menu', $route)->first()->id;
                $this->authorize('delete', Menu::find($menu_id));
                
                $nama_group = Group::where('id', $id)->value('nama');
                $delete_data = Group::where('id', $id)->delete();
                DB::commit();
    
                return response()->json([
                    'success' => true,
                    'message' => 'Data Group '.$nama_group.' Berhasil Dihapus!',
                    'code'    => 200,
                    'icon'    => 'success'  
                ]);
                
            } catch (\Exception $e) {
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
