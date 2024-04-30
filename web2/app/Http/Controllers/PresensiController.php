<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HRISGlobalLock;
use App\Models\HRISPresensi;
use App\Models\SystemParameter;
use App\Models\Menu;
use App\Models\User;
use App\Traits\loggingTrait;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PresensiController extends Controller
{
    use loggingTrait;

    public function index(Request $request)
    {
        // $route = '/masterSchedule';
        // $menu_id = Menu::where('route_menu', $route)->first()->id;
        // $this->authorize('view', Menu::find($menu_id));

        // ##DATA PERMISSION
        // $user_id = session()->get('id');
        // $user_data = User::Where('id',$user_id)->first();

        // $listpresensi = HRISPresensi::where('nomor_user', $user_data->nomor)->get();

        return view('hris.presensi.presensi');
    }

    public function getpresensidata(Request $request){
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
        $totalRecords = HRISPresensi::select('count(*) as allcount')->where('nomor_user', $user_data->nomor)->count();
        $totalRecordswithFilter = HRISPresensi::select('count(*) as allcount')
        ->join('beone_users', 'beone_users.nomor', '=', 'hris_presensi.nomor_user')
        ->where(function($query) use ($request)
            {
                if ($request->has('tanggal')  &&  $request->input('tanggal') != '') {
                    $query->where('tanggal','like', '%'.  $request->input('tanggal').'%');
                }
            })
        ->where('nomor_user', $user_data->nomor)
        ->select('hris_presensi.*','beone_users.nama')
        ->count();
   
   
        // Fetch records
        $records = HRISPresensi::orderBy('tanggal',$columnSortOrder)
        ->join('beone_users', 'beone_users.nomor', '=', 'hris_presensi.nomor_user')
        ->where(function($query) use ($request)
               {
                   if ($request->has('tanggal')  &&  $request->input('tanggal') != '') {
                       $query->where('tanggal','like', '%'.  $request->input('tanggal').'%');
                   }
               })
        ->where('nomor_user', $user_data->nomor)
        ->select('hris_presensi.*', 'beone_users.nama')
        ->skip($start)
        ->take($rowperpage)
        ->get();
          
        //   $records = User::all();
        //   $totalRecords = 1;
        //   $totalRecordswithFilter = 1;
   
       $data = [
           'data' => $records,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalRecordswithFilter,
       ];
       return response()->json($data, 200);
       }


       public function insertpresensidata(Request $request){
                DB::beginTransaction();
                try {
                    // $route = '/masterSchedule';
                    // $menu_id = Menu::where('route_menu', $route)->first()->id;
                    // $this->authorize('create', Menu::find($menu_id));

                    $user_id = session()->get('id');
                    $user_data = User::Where('id',$user_id)->first();

                    $lokasi_presensi = $request->input('lokasi_presensi');
                    $keterangan = $request->input('keterangan');
                    $nomor_users = $user_data->nomor;
                    $tanggals = $request->input('tanggal');
                    $tanggal_exp = explode(", ", $tanggals);
                    $clock_in = $request->input('clock_in');
                    $clock_out = $request->input('clock_out');
                    $latitude = $request->input('latitude');
                    $longitude = $request->input('longitude');
                    $hardware_id = $request->input('hardware_id');

                    $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();

                    foreach ($tanggal_exp as $tanggal) {

                        $dateAction = $tanggal;
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
                            DB::table('hris_presensi')->insert([
                                'nomor_user' => $nomor_users,
                                'tanggal' => $tanggal,
                                'clock_in' => $clock_in,
                                'clock_out' => $clock_out,
                                'latitude' => $latitude,
                                'longitude' => $longitude,
                                'hardware_id' => $hardware_id,
                                'lokasi_presensi' => $lokasi_presensi,
                                'keterangan' => $keterangan,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);

                            //last insert id menu
                            // $scheduleID = $scheduleCreate->id;

                            //add log
                            $islogactive = SystemParameter::first()->islogactive;
                            if ($islogactive){
                                $this->addLog("hris_presensi", session()->get('username'), "", $nomor_users, "Create", "Create Presensi ".$nomor_users.' tanggal '.$tanggal);
                            }
                        }
                    }

                    DB::commit();

                    return response()->json([
                        'success' => true,
                        'message' => 'Data Schedule Berhasil Ditambahkan!',
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
