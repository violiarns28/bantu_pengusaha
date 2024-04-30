<?php

namespace App\Http\Controllers;

use App\Models\HRISSchedule;
use App\Models\HRISRekapPresensi;
use App\Models\HRISKodePresensi;
use App\Models\HRISGlobalLock;
use App\Models\SiteAccess;
use App\Models\SystemParameter;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\loggingTrait;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    use loggingTrait;

    public function index(Request $request)
    {
        $route = '/masterSchedule';
        $menu_id = Menu::where('route_menu', $route)->first()->id;
        $this->authorize('view', Menu::find($menu_id));

        // ##DATA PERMISSION
        $user_id = session()->get('id');
        $access_site = SiteAccess::Where('user_id',$user_id)->select('site_id')->get();

        $list_site_id = array();

        foreach($access_site as $as){
            array_push($list_site_id, $as->site_id);
        }
        // ##END DATA PERMISSION

        $listrekap = HRISRekapPresensi::all();
        $listschedule = HRISSchedule::all();
        $listkodepresensi = HRISKodePresensi::all();
        $listuser = User::whereIn('site_id', $list_site_id)->get();

        return view('master.schedule')
        ->with(compact('listuser'))
        ->with(compact('listrekap'))
        ->with(compact('listkodepresensi'));
    }

    public function insertscheduledata(Request $request){
            DB::beginTransaction();
            try {
                $route = '/masterSchedule';
                $menu_id = Menu::where('route_menu', $route)->first()->id;
                $this->authorize('create', Menu::find($menu_id));

                $tipe_schedule = $request->input('tipe_schedule');
                $nomor_users = $request->input('nomor');
                $tanggals = $request->input('tanggal');
                $tanggal_exp = explode(", ", $tanggals);
                $clock_in = $request->input('schedule_clock_in');
                $clock_out = $request->input('schedule_clock_out');

                $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();

                foreach ($nomor_users as $key => $nomor_user) {
                    foreach ($tanggal_exp as $key2 => $tanggal) {

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
                            DB::table('hris_schedule')->insert([
                                'tipe_schedule' => $tipe_schedule,
                                'nomor_user' => $nomor_user,
                                'tanggal' => $tanggal,
                                'clock_in' => $clock_in,
                                'clock_out' => $clock_out,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);

                            //last insert id menu
                            // $scheduleID = $scheduleCreate->id;

                            //add log
                            $islogactive = SystemParameter::first()->islogactive;
                            if ($islogactive){
                                $this->addLog("hris_schedule", session()->get('username'), "", $nomor_user, "Create", "Create Schedule ".$nomor_user.' tanggal '.$tanggal);
                            }
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

    public function getscheduledata(Request $request){
         // ##DATA PERMISSION
         $user_id = session()->get('id');
         $access_site = SiteAccess::Where('user_id',$user_id)->select('site_id')->get();
 
         $list_site_id = array();
 
         foreach($access_site as $as){
             array_push($list_site_id, $as->site_id);
         }
         // ##END DATA PERMISSION

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

        $nomor_user = $request->get('nomor_user');
   
        // Total records
        $totalRecords = HRISSchedule::select('count(*) as allcount')->count();
        $totalRecordswithFilter = HRISSchedule::select('count(*) as allcount')
        ->join('beone_users', 'beone_users.nomor', '=', 'hris_schedule.nomor_user')
        ->where(function($query) use ($request)
            {
                if ($request->has('nomor_user')  &&  $request->input('nomor_user') != '') {
                    $query->where('nomor_user','like', '%'.  $request->input('nomor_user').'%');
                }
            })
        ->whereIn('beone_users.site_id', $list_site_id)
        ->select('hris_schedule.*', 'beone_users.nama as nama', 'beone_users.site_id')
        ->count();
   
        // Fetch records
        $records = HRISSchedule::orderBy('nomor_user',$columnSortOrder)
        ->join('beone_users', 'beone_users.nomor', '=', 'hris_schedule.nomor_user')
           ->where(function($query) use ($request)
               {
                   if ($request->has('nomor_user')  &&  $request->input('nomor_user') != '') {
                       $query->where('nomor_user','like', '%'.  $request->input('nomor_user').'%');
                   }
               })
          ->whereIn('beone_users.site_id', $list_site_id)
          ->select('hris_schedule.*', 'beone_users.nama as nama', 'beone_users.site_id')
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

       public function getonescheduledata($id)
    {
        // $data = HRISSchedule::where('id', $id)->get();
        $data = HRISSchedule::where('hris_schedule.id', $id)
                            ->join('beone_users', 'beone_users.nomor', '=', 'hris_schedule.nomor_user')
                            ->select('hris_schedule.*', 'beone_users.nama')
                            ->get();
        return response()->json($data);
    }


    public function updatescheduledata(Request $request)
    {
        DB::beginTransaction();

        try {
            $route = '/masterSchedule';
            $menu_id = Menu::where('route_menu', $route)->first()->id;
            $this->authorize('update', Menu::find($menu_id));

            $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();
            $dateAction = HRISSchedule::where('id', $request->input('editID'))->value('tanggal'); //tanggal awal sebelum edit harus dipastikan

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
                $dataupdate = HRISSchedule::where('id',$request->input('editID'))->update([
                    'nomor_user' => $request->input('editNomor'),
                    'tipe_schedule' => $request->input('editTipeSchedule'),
                    'tanggal' => $request->input('editTanggal'),
                    'clock_in' => $request->input('editClockIn'),
                    'clock_out' => $request->input('editClockOut'),
                    'updated_at' => Carbon::now(),
                ]);
    
                //add log
                $this->addLog("hris_schedule", session()->get('username'), $request->input('editID'), "", "Update", "Updated Data Schedule ".$request->input('editNomor'));
                
                DB::commit();
    
                return response()->json([
                    'success' => true,
                    'message' => 'Data Schedule '.$request->input('nomor_user').' Tanggal '.$request->input('editTanggal').' Berhasil Update!',
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


    public function deleteschedule($id)
    {
        DB::beginTransaction();

        try {
            $route = '/masterSchedule';
            $menu_id = Menu::where('route_menu', $route)->first()->id;
            $this->authorize('delete', Menu::find($menu_id));

            $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();
            $dateAction = HRISSchedule::where('id', $id)->value('tanggal');

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
                //return true
                $nomor_user = HRISSchedule::where('id', $id)->value('nomor_user');
                $tanggal_schedule = HRISSchedule::where('id', $id)->value('tanggal');

                //add log
                $islogactive = SystemParameter::first()->islogactive;
                if ($islogactive){
                    $this->addLog("hris_schedule", session()->get('username'), $id, "", "Delete", "Delete Schedule ".$nomor_user.' tanggal '.$tanggal_schedule);
                }

                $data_schedule = HRISSchedule::where('id', $id)->first();
                $delete_data_rekap = HRISRekapPresensi::where('nomor_user',$data_schedule->nomor_user)
                                                        ->where('tanggal', $data_schedule->tanggal)->delete();
                
                $delete_data = HRISSchedule::where('id', $id)->delete();
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Data Schedule User Nomor '.$nomor_user.' tanggal '.$tanggal_schedule.' Berhasil Dihapus!',
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


    public function deletebatchschedule($id)
    {
        DB::beginTransaction();

        try {
            $route = '/masterSchedule';
            $menu_id = Menu::where('route_menu', $route)->first()->id;
            $this->authorize('delete', Menu::find($menu_id));

            $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();
            $created_at = HRISSchedule::where('id', $id)->value('created_at');
            $nomor_user = HRISSchedule::where('id', $id)->value('nomor_user');
            
            $results = HRISSchedule::where('nomor_user', $nomor_user)
                       ->where('created_at', $created_at)
                       ->select('tanggal')
                       ->get();
            
            
            foreach ($results as $result) {
            $tanggal = $result->tanggal;
                if ($lockDate->tanggal_lock >= $tanggal) {
                    //kondisi sudah lock
                    $message = 'Sudah Ada Periode Closing '.$lockDate->tanggal_lock;
                    return response()->json([
                        'success' => false,
                        'message' => $message,
                        'code'    => 400 ,
                        'icon'    => 'error' 
                    ]);
                }
            }


            $dataDeletes = HRISSchedule::where('created_at', $created_at)
                       ->select('id','nomor_user','tanggal')
                       ->get();

            foreach ($dataDeletes as $dataDell) {
                $schedule_id = $dataDell->id;
                $nomor_user = $dataDell->nomor_user;
                $schedule_tanggal = $dataDell->tanggal;

                $delete_data_rekap = HRISRekapPresensi::where('nomor_user',$dataDell->nomor_user)
                                                        ->where('tanggal', $dataDell->tanggal)->delete();

                //add log
                $islogactive = SystemParameter::first()->islogactive;
                if ($islogactive){
                    $this->addLog("hris_schedule", session()->get('username'), $schedule_id, "", "Delete", "Delete Schedule ".$nomor_user.' tanggal '.$schedule_tanggal);
                }
            }

            $delete_data = HRISSchedule::where('created_at', $created_at)->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data Batch Schedule Berhasil Dihapus!',
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

    public function deleteschedulesummary(Request $request)
    {
        DB::beginTransaction();

        try {
            $route = '/masterSchedule';
            $menu_id = Menu::where('route_menu', $route)->first()->id;
            $this->authorize('delete', Menu::find($menu_id));

            $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();
            $dateAction = HRISSchedule::where('id', $request->input('schedule_id'))->value('tanggal');

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
                //return true
                $nomor_user = HRISSchedule::where('id', $request->input('schedule_id'))->value('nomor_user');
                $tanggal_schedule = HRISSchedule::where('id', $request->input('schedule_id'))->value('tanggal');

                //add log
                $islogactive = SystemParameter::first()->islogactive;
                if ($islogactive){
                    $this->addLog("hris_schedule", session()->get('username'), $request->input('schedule_id'), "", "Delete", "Delete Schedule ".$nomor_user.' tanggal '.$tanggal_schedule);
                }

                $delete_data = HRISSchedule::where('id', $request->input('schedule_id'))->delete();
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Data Schedule User Nomor '.$nomor_user.' tanggal '.$tanggal_schedule.' Berhasil Dihapus!',
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

    public function indexSummarySchedule(Request $request)
    {
        // $route = '/summarySchedule';
        // $menu_id = Menu::where('route_menu', $route)->first()->id;
        // $this->authorize('view', Menu::find($menu_id));

        // ##DATA PERMISSION
        $user_id = session()->get('id');
        $access_site = SiteAccess::Where('user_id',$user_id)->select('site_id')->get();

        $list_site_id = array();

        foreach($access_site as $as){
            array_push($list_site_id, $as->site_id);
        }
        // ##END DATA PERMISSION

        $listschedule = HRISSchedule::all();
        // $listuser = User::all();
        $listuser = User::whereIn('site_id', $list_site_id)->get();
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Membuat objek Carbon untuk tanggal 1 bulan ini
        $date = Carbon::create($currentYear, $currentMonth, 1, 0, 0, 0);

        // Mendapatkan tanggal awal bulan
        $firstDay = $currentYear.'-'.$currentMonth.'-01';

        // Mendapatkan tanggal akhir bulan
        $lastDay = $date->endOfMonth();

        if ($from_date == null){
            $from_date = $firstDay;
        }

        if ($to_date == null){
            $to_date = $lastDay->format('Y-m-d');
        }

        return view('hris.schedule.summary')
        ->with(compact('listuser'))
        ->with(compact('listschedule'))
        ->with(compact('from_date'))
        ->with(compact('to_date'));
    }
}