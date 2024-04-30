<?php

namespace App\Http\Controllers;

use App\Models\HRISGlobalLock;
use App\Models\HRISLembur;
use App\Models\SystemParameter;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\loggingTrait;
use Carbon\Carbon;

class LemburController extends Controller
{
    use loggingTrait;

    public function index(Request $request)
    {
        // $route = '/lembur';
        // $menu_id = Menu::where('route_menu', $route)->first()->id;
        // $this->authorize('view', Menu::find($menu_id));

        return view('hris.pengajuan.lembur');
    }

    public function getlemburdata(Request $request){
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
       $totalRecords = HRISLembur::select('count(*) as allcount')->where('nomor_user', $user_data->nomor)->count();
       $totalRecordswithFilter = HRISLembur::select('count(*) as allcount')
       ->join('beone_users', 'beone_users.nomor', '=', 'hris_lembur.nomor_user')
       ->where(function($query) use ($request)
           {
               if ($request->has('tanggal')  &&  $request->input('tanggal') != '') {
                   $query->where('tanggal','like', '%'.  $request->input('tanggal').'%');
               }
           })
       ->where('nomor_user', $user_data->nomor)
       ->select('hris_lembur.*', 'beone_users.nama as nama')
       ->count();
  
  
       // Fetch records
       $records = HRISLembur::orderBy('tanggal',$columnSortOrder)
       ->join('beone_users', 'beone_users.nomor', '=', 'hris_lembur.nomor_user')
          ->where(function($query) use ($request)
              {
                  if ($request->has('tanggal')  &&  $request->input('tanggal') != '') {
                      $query->where('tanggal','like', '%'.  $request->input('tanggal').'%');
                  }
              })
         ->where('nomor_user', $user_data->nomor)
         ->select('hris_lembur.*', 'beone_users.nama as nama')
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

    public function insertlemburdata(Request $request){
            DB::beginTransaction();
            try {
                // $route = '/lembur';
                // $menu_id = Menu::where('route_menu', $route)->first()->id;
                // $this->authorize('create', Menu::find($menu_id));

                $user_id = session()->get('id');
                $user_data = User::Where('id',$user_id)->first();

                $jenis_pengajuan = 'LEMBUR';
                $jenis_lembur = $request->input('jenis_lembur');
                $tanggal = $request->input('tanggal');
                $waktu = $request->input('dari_jam');
                $waktu2 = $request->input('sampai_jam');
                $keterangan = $request->input('keterangan');

                $carbonWaktu1 = Carbon::createFromFormat('H:i', $waktu);
                $carbonWaktu2 = Carbon::createFromFormat('H:i', $waktu2);
                $selisihDetik = $carbonWaktu1->diffInSeconds($carbonWaktu2);
                $total_jam_lembur = $selisihDetik / 3600;

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
                    DB::table('hris_lembur')->insert([
                        'nomor_user' => $user_data->nomor,
                        'jenis_pengajuan' => $jenis_pengajuan,
                        'jenis_lembur' => $jenis_lembur,
                        'tanggal' => $tanggal,
                        'waktu' => $waktu,
                        'waktu2' => $waktu2,
                        'keterangan' => $keterangan,
                        'status_approve' => 0,
                        'total_jam_lembur' => $total_jam_lembur,
                    ]);

                    $pkid = DB::connection()->getPdo()->lastInsertId();

                    //add log
                    $islogactive = SystemParameter::first()->islogactive;
                    if ($islogactive){
                        $this->addLog("hris_lembur", session()->get('username'), $pkid, "", "Create", "Create Lembur tanggal ".$tanggal);
                    }
                }


                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Data Lembur Berhasil Ditambahkan!',
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

    public function getonelemburdata($id)
    {
        $data = HRISLembur::where('hris_lembur.id', $id)
                            ->join('beone_users', 'beone_users.nomor', '=', 'hris_lembur.nomor_user')
                            ->select('hris_lembur.*', 'beone_users.nama')
                            ->get();
        return response()->json($data);
    }

    public function updatelemburdata(Request $request)
    {
        DB::beginTransaction();

        try {
            // $route = '/lembur';
            // $menu_id = Menu::where('route_menu', $route)->first()->id;
            // $this->authorize('update', Menu::find($menu_id));

            $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();
            $dateAction = HRISLembur::where('id', $request->input('editID'))->value('tanggal'); //tanggal awal sebelum edit harus dipastikan
            $status_approve = HRISLembur::where('id', $request->input('editID'))->value('status_approve');

            $dari_jam = $request->input('editDariJam');
            $sampai_jam = $request->input('editSampaiJam');
            
            $carbonWaktu1 = Carbon::createFromFormat('H:i', $dari_jam);
            $carbonWaktu2 = Carbon::createFromFormat('H:i', $sampai_jam);
            $selisihDetik = $carbonWaktu1->diffInSeconds($carbonWaktu2);
            $total_jam_lembur = $selisihDetik / 3600;

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
                    $dataupdate = HRISLembur::where('id',$request->input('editID'))->update([
                        'jenis_lembur' => $request->input('editJenisLembur'),
                        'tanggal' => $request->input('editTanggal'),
                        'waktu' => $request->input('editDariJam'),
                        'waktu2' => $request->input('editSampaiJam'),
                        'keterangan' => $request->input('editKeterangan'),
                        'total_jam_lembur' => $total_jam_lembur,
                    ]);
        
                    //add log
                    $islogactive = SystemParameter::first()->islogactive;
                    if ($islogactive){
                        $this->addLog("hris_lembur", session()->get('username'), $request->input('editID'), "", "Update", "Updated Lembur tanggal ".$request->input('editTanggal'));
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

    public function deletelembur($id)
    {
        DB::beginTransaction();

        try {
            // $route = '/lembur';
            // $menu_id = Menu::where('route_menu', $route)->first()->id;
            // $this->authorize('delete', Menu::find($menu_id));

            $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();
            $dateAction = HRISLembur::where('id', $id)->value('tanggal');

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
                    $this->addLog("hris_lembur", session()->get('username'), $id, "", "Delete", "Delete Lembur tanggal ".$dateAction);
                }
                
                $data_pengajuan = HRISLembur::where('id',$id)->first();
                if ($data_pengajuan->status_approve <> 0){
                    $message = 'Status Lembur Sudah Diproses';
                    return response()->json([
                        'success' => false,
                        'message' => $message,
                        'code'    => 400 ,
                        'icon'    => 'error' 
                    ]);
                }
                
                $delete_data = HRISLembur::where('id', $id)->delete();
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Data Lembur Berhasil Dihapus!',
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
