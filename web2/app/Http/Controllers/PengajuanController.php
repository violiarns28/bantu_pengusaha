<?php

namespace App\Http\Controllers;

use App\Models\HRISGlobalLock;
use App\Models\HRISPengajuan;
use App\Models\SystemParameter;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\loggingTrait;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    use loggingTrait;

    public function index(Request $request)
    {
        $route = '/pengajuan';
        $menu_id = Menu::where('route_menu', $route)->first()->id;
        $this->authorize('view', Menu::find($menu_id));

        return view('hris.pengajuan.pengajuan');
    }

    public function getpengajuandata    (Request $request){
        $user_id = session()->get('id');
        $user_data = User::Where('id',$user_id)->first();


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

       $tanggal = $request->get('tanggal');
  
       // Total records
       $totalRecords = HRISPengajuan::select('count(*) as allcount')->where('nomor_user', $user_data->nomor)->count();
       $totalRecordswithFilter = HRISPengajuan::select('count(*) as allcount')
       ->join('beone_users', 'beone_users.nomor', '=', 'hris_pengajuan.nomor_user')
       ->where(function($query) use ($request)
           {
               if ($request->has('tanggal')  &&  $request->input('tanggal') != '') {
                   $query->where('tanggal','like', '%'.  $request->input('tanggal').'%');
               }
           })
       ->where('nomor_user', $user_data->nomor)
       ->select('hris_pengajuan.*', 'beone_users.nama as nama')
       ->count();
  
  
       // Fetch records
       $records = HRISPengajuan::orderBy('tanggal',$columnSortOrder)
       ->join('beone_users', 'beone_users.nomor', '=', 'hris_pengajuan.nomor_user')
          ->where(function($query) use ($request)
              {
                  if ($request->has('tanggal')  &&  $request->input('tanggal') != '') {
                      $query->where('tanggal','like', '%'.  $request->input('tanggal').'%');
                  }
              })
         ->where('nomor_user', $user_data->nomor)
         ->select('hris_pengajuan.*', 'beone_users.nama as nama')
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

    public function insertpengajuandata(Request $request){
            DB::beginTransaction();
            try {
                $route = '/pengajuan';
                $menu_id = Menu::where('route_menu', $route)->first()->id;
                $this->authorize('create', Menu::find($menu_id));

                $user_id = session()->get('id');
                $user_data = User::Where('id',$user_id)->first();

                $jenis_pengajuan = $request->input('jenis_pengajuan');
                $tanggal = $request->input('tanggal');
                $tanggal2 = $request->input('tanggal2');
                $waktu = $request->input('waktu');
                $keterangan = $request->input('keterangan');

                $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();

                if ($lockDate->tanggal_lock >= $tanggal){
                    //kondisi sudah lock
                    $message = 'Sudah Ada Periode Closing '.$lockDate->tanggal_lock;
                    return response()->json([
                        'success' => false,
                        'message' => $message,
                        'code'    => 400 ,
                        'icon'    => 'error' 
                    ]);
                }else{
                    DB::table('hris_pengajuan')->insert([
                        'nomor_user' => $user_data->nomor,
                        'jenis_pengajuan' => $jenis_pengajuan,
                        'tanggal' => $tanggal,
                        'tanggal2' => $tanggal2,
                        'waktu' => $waktu,
                        'keterangan' => $keterangan,
                        'status_approve' => 0,
                    ]);

                    $pkid = DB::connection()->getPdo()->lastInsertId();

                    //add log
                    $islogactive = SystemParameter::first()->islogactive;
                    if ($islogactive){
                        $this->addLog("hris_pengajuan", session()->get('username'), $pkid, "", "Create", "Create Pengajuan tanggal ".$tanggal);
                    }
                }


                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Data Pengajuan Berhasil Ditambahkan!',
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

    public function getonepengajuandata($id)
    {
        $data = HRISPengajuan::where('hris_pengajuan.id', $id)
                            ->join('beone_users', 'beone_users.nomor', '=', 'hris_pengajuan.nomor_user')
                            ->select('hris_pengajuan.*', 'beone_users.nama')
                            ->get();
        return response()->json($data);
    }

    public function updatepengajuandata(Request $request)
    {
        DB::beginTransaction();

        try {
            $route = '/pengajuan';
            $menu_id = Menu::where('route_menu', $route)->first()->id;
            $this->authorize('update', Menu::find($menu_id));

            $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();
            $dateAction = HRISPengajuan::where('id', $request->input('editID'))->value('tanggal'); //tanggal awal sebelum edit harus dipastikan
            $status_approve = HRISPengajuan::where('id', $request->input('editID'))->value('status_approve');

            if($status_approve <> 0){
                //kondisi sudah lock
                $message = 'Pengajuan Tidak Dapat Diupdate Karena Sudah Diproses!';
                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'code'    => 400 ,
                    'icon'    => 'error' 
                ]);
            }else{
                if ($lockDate->tanggal_lock >= $request->input('editTanggal')){
                    //kondisi sudah lock
                    $message = 'Sudah Ada Periode Closing '.$lockDate->tanggal_lock;
                    return response()->json([
                        'success' => false,
                        'message' => $message,
                        'code'    => 400 ,
                        'icon'    => 'error' 
                    ]);
                }else{
                    $dataupdate = HRISPengajuan::where('id',$request->input('editID'))->update([
                        'jenis_pengajuan' => $request->input('editJenisPengajuan'),
                        'tanggal' => $request->input('editTanggal'),
                        'tanggal2' => $request->input('editTanggal2'),
                        'waktu' => $request->input('editWaktu'),
                        'keterangan' => $request->input('editKeterangan'),
                    ]);
        
                    //add log
                    $islogactive = SystemParameter::first()->islogactive;
                    if ($islogactive){
                        $this->addLog("hris_pengajuan", session()->get('username'), $request->input('editID'), "", "Update", "Updated Pengajuan tanggal ".$request->input('editTanggal'));
                    }
                    
                    DB::commit();
        
                    return response()->json([
                        'success' => true,
                        'message' => 'Data Pengajuan Berhasil Update!',
                        'code'    => 200,
                        'icon'    => 'success'  
                    ]);
                }
            }
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

    public function deletepengajuan($id)
    {
        DB::beginTransaction();

        try {
            $route = '/pengajuan';
            $menu_id = Menu::where('route_menu', $route)->first()->id;
            $this->authorize('delete', Menu::find($menu_id));

            $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();
            $dateAction = HRISPengajuan::where('id', $id)->value('tanggal');

            if ($lockDate->tanggal_lock >= $dateAction){
                //kondisi sudah lock
                $message = 'Sudah Ada Periode Closing '.$lockDate->tanggal_lock;
                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'code'    => 400 ,
                    'icon'    => 'error' 
                ]);
            }else{
                //add log
                $islogactive = SystemParameter::first()->islogactive;
                if ($islogactive){
                    $this->addLog("hris_pengajuan", session()->get('username'), $id, "", "Delete", "Delete Pengajuan tanggal ".$dateAction);
                }
                
                $data_pengajuan = HRISPengajuan::where('id',$id)->first();
                if ($data_pengajuan->status_approve <> 0){
                    $message = 'Status Pengajuan Sudah Diproses';
                    return response()->json([
                        'success' => false,
                        'message' => $message,
                        'code'    => 400 ,
                        'icon'    => 'error' 
                    ]);
                }
                
                $delete_data = HRISPengajuan::where('id', $id)->delete();
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Data Pengajuan Berhasil Dihapus!',
                    'code'    => 200,
                    'icon'    => 'success'  
                ]);
            }
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