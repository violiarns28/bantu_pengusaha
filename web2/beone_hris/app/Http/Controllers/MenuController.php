<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $route = '/masterMenu';
        $menu_id = Menu::where('route_menu', $route)->first()->id;
        $this->authorize('view', Menu::find($menu_id));
        
        $listMenu = Menu::all();

        return view('master.menu')
        ->with(compact('listMenu'));
    }

    public function getmenudata(Request $request){
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
        $totalRecords = Menu::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Menu::select('count(*) as allcount')
        ->where(function($query) use ($request)
            {
                if ($request->has('nama')  &&  $request->input('nama') != '') {
                    $query->where('nama','like', '%'.  $request->input('nama').'%');
                }
            })
        ->select('beone_menu.*')
        ->count();
   
   
        // Fetch records
        $records = Menu::orderBy('nama',$columnSortOrder)
           ->where(function($query) use ($request)
               {
                   if ($request->has('nama')  &&  $request->input('nama') != '') {
                       $query->where('nama','like', '%'.  $request->input('nama').'%');
                   }
               })
          ->select('beone_menu.*')
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


    public function insertmenudata(Request $request){
    DB::beginTransaction();
    try {
        // Policy
        $route = '/masterMenu';
        $menu_id = Menu::where('route_menu', $route)->first()->id;
        $this->authorize('create', Menu::find($menu_id));

        $nama = $request->input('nama');
        $route_menu = $request->input('route');
        $icon = $request->input('icon');
        $value_parent = $request->input('parent_id');

        // Cek Apakah Parent
        if ($value_parent == NULL){
            $parent_id = 0;
        }else{
            $parent_id = $request->input('parent_id');
        }

        // isParent = true or false
        if ($parent_id == 0){
            $isparent = 1;
        }else{
            $isparent = 0;
        }

        // Cek apakah menu baru merupakan subParent
        $cekSubParent = Menu::where('id', '=',$parent_id)->first();
        if($cekSubParent == NULL){
            $issubparent = 0;
        }else if ($cekSubParent->isparent == 0){
            $issubparent = 0;
        }else{
            $issubparent = 1;
        }

        Menu::create([
            'nama' => $nama,
            'route_menu' => $route_menu,
            'parent_id' => $parent_id,
            'icon' => $icon,
            'isparent' => $isparent,
            'issubparent' => $issubparent,
        ]);

        // Menu::create($input);
        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Data Menu '.$nama.' Berhasil Ditambahkan!',
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

    public function getonemenudata($id)
    {
        $data = Menu::where('id', $id)->get();
        return response()->json($data);
    }

    public function updatemenudata(Request $request)
    {
        DB::beginTransaction();

        try {
            $route = '/masterMenu';
            $menu_id = Menu::where('route_menu', $route)->first()->id;
            $this->authorize('update', Menu::find($menu_id));

            $input_isparent = $request->input('editParent');

            // Cek Apakah Parent
            if ($input_isparent == NULL){
                $parent_id = 0;
            }else{
                $parent_id = $request->input('editParent');
            }

            // isParent = true or false
            if ($parent_id == 0){
                $isparent = 1;
            }else{
                $isparent = 0;
            }

            // Cek apakah menu baru merupakan subParent
            $cekSubParent = Menu::where('id', '=',$parent_id)->first();
            if($cekSubParent == NULL){
                $issubparent = 0;
            }else if ($cekSubParent->isparent == 0){
                $issubparent = 0;
            }else{
                $issubparent = 1;
            }

            $dataupdate = Menu::where('id',$request->input('editID'))->update([
                'nama' => $request->input('editNama'),
                'route_menu' => $request->input('editRoute'),
                'parent_id' => $parent_id,
                'icon' => $request->input('editIcon'),
                'isparent' => $isparent,
                'issubparent' => $issubparent,
            ]);

            //add log
            // $this->addLog("users", session()->get('username'), $user->id, "", "Update", "Updated Data User ".$request->input('editUsername'));
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data Menu '.$request->input('editNama').' Berhasil Update!',
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

    public function deletemenu($id)
    {
        DB::beginTransaction();

        try {
            $route = '/masterMenu';
            $menu_id = Menu::where('route_menu', $route)->first()->id;
            $this->authorize('delete', Menu::find($menu_id));

            $nama_menu = Menu::where('id', $id)->value('nama');
            $delete_data = Menu::where('id', $id)->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data Menu '.$nama_menu.' Berhasil Dihapus!',
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
